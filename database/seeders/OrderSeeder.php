<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = User::where('role', 'patient')->get();
        $products = Product::all();

        if ($patients->isEmpty() || $products->isEmpty()) {
            $this->command->warn('Please run UserSeeder and ProductSeeder first!');
            return;
        }

        $statuses = ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'];
        $paymentStatuses = ['pending', 'paid', 'failed'];
        $paymentMethods = ['bank_transfer', 'credit_card', 'e_wallet', 'cod'];
        $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang', 'Yogyakarta', 'Makassar', 'Palembang', 'Denpasar', 'Malang'];

        // Generate 50 orders
        for ($i = 0; $i < 50; $i++) {
            $user = $patients->random();
            $orderDate = now()->subDays(rand(0, 90));
            $status = $statuses[array_rand($statuses)];
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];
            
            // Determine payment status based on order status
            if (in_array($status, ['delivered', 'shipped', 'processing'])) {
                $paymentStatus = 'paid';
            } elseif ($status === 'cancelled') {
                $paymentStatus = rand(0, 1) ? 'failed' : 'pending';
            } else {
                $paymentStatus = $paymentStatuses[array_rand($paymentStatuses)];
            }

            $subtotal = 0;
            $shippingCost = rand(1, 5) * 10000;
            $discount = rand(0, 3) * 25000;

            // Create order
            $order = Order::create([
                'order_number' => 'ORD' . $orderDate->format('Ymd') . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'user_id' => $user->id,
                'status' => $status,
                'subtotal' => 0, // Will update after items
                'tax' => 0,
                'shipping_cost' => $shippingCost,
                'discount' => $discount,
                'total' => 0, // Will update after items
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentStatus,
                'shipping_name' => $user->name,
                'shipping_phone' => '08' . rand(10, 99) . rand(1000000, 9999999),
                'shipping_address' => 'Jl. ' . ['Sudirman', 'Gatot Subroto', 'MH Thamrin', 'Rasuna Said', 'Kuningan', 'Menteng', 'Kemang'][array_rand(['Sudirman', 'Gatot Subroto', 'MH Thamrin', 'Rasuna Said', 'Kuningan', 'Menteng', 'Kemang'])] . ' No. ' . rand(1, 200),
                'shipping_city' => $cities[array_rand($cities)],
                'shipping_postal_code' => rand(10000, 99999),
                'notes' => rand(0, 3) === 0 ? 'Mohon dikirim secepatnya' : null,
                'paid_at' => $paymentStatus === 'paid' ? $orderDate->addHours(rand(1, 24)) : null,
                'shipped_at' => in_array($status, ['shipped', 'delivered']) ? $orderDate->addDays(rand(1, 3)) : null,
                'delivered_at' => $status === 'delivered' ? $orderDate->addDays(rand(3, 7)) : null,
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ]);

            // Add 1-5 items to order
            $numItems = rand(1, 5);
            $orderProducts = $products->random($numItems);

            foreach ($orderProducts as $product) {
                $quantity = rand(1, 5);
                $itemSubtotal = $product->price * $quantity;
                $subtotal += $itemSubtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            // Update order totals
            $tax = $subtotal * 0.11; // 11% PPN
            $total = $subtotal + $tax + $shippingCost - $discount;
            
            $order->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => max(0, $total),
            ]);
        }
    }
}
