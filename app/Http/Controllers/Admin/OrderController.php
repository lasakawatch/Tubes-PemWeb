<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('shipping_name', 'like', "%{$search}%")
                  ->orWhere('shipping_phone', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->latest()->paginate(15);

        // Statistics
        $stats = [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::whereIn('status', ['confirmed', 'processing'])->count(),
            'completed' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
        ];

        $statuses = Order::statuses();
        $paymentMethods = Order::paymentMethods();

        return view('admin.orders.index', compact('orders', 'stats', 'statuses', 'paymentMethods'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled,refunded',
        ]);

        $order->status = $validated['status'];

        // Update timestamps based on status
        if ($validated['status'] === 'shipped') {
            $order->shipped_at = now();
        } elseif ($validated['status'] === 'delivered') {
            $order->delivered_at = now();
        }

        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $order->payment_status = $validated['payment_status'];

        if ($validated['payment_status'] === 'paid') {
            $order->paid_at = now();
        }

        $order->save();

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui!');
    }

    /**
     * Add admin notes to order
     */
    public function addNotes(Request $request, Order $order)
    {
        $validated = $request->validate([
            'notes' => 'required|string',
        ]);

        $order->notes = $validated['notes'];
        $order->save();

        return redirect()->back()->with('success', 'Catatan berhasil ditambahkan!');
    }

    /**
     * Cancel an order
     */
    public function cancel(Order $order)
    {
        if (!in_array($order->status, ['pending', 'confirmed'])) {
            return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan!');
        }

        $order->status = 'cancelled';
        $order->save();

        // Restore product stock
        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan!');
    }

    /**
     * Print order invoice
     */
    public function printInvoice(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.invoice', compact('order'));
    }

    /**
     * Export orders to CSV
     */
    public function export(Request $request)
    {
        $query = Order::with(['user', 'items']);

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->get();

        $filename = 'orders_' . now()->format('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, ['Order Number', 'Customer', 'Email', 'Total', 'Status', 'Payment Status', 'Payment Method', 'Date']);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->order_number,
                    $order->shipping_name,
                    $order->user->email ?? 'N/A',
                    $order->total,
                    $order->status,
                    $order->payment_status,
                    $order->payment_method,
                    $order->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
