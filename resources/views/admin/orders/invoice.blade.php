<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->order_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            background: #f8f9fa;
            padding: 20px;
        }
        .invoice {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #10b981;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo-icon {
            font-size: 40px;
            margin-right: 10px;
        }
        .logo-text h1 {
            font-size: 24px;
            color: #10b981;
            margin-bottom: 5px;
        }
        .logo-text p {
            font-size: 12px;
            color: #666;
        }
        .invoice-title {
            text-align: right;
        }
        .invoice-title h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 5px;
        }
        .invoice-title p {
            color: #666;
        }
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }
        .info-box {
            width: 48%;
        }
        .info-box h3 {
            font-size: 12px;
            color: #10b981;
            text-transform: uppercase;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        .info-box p {
            margin-bottom: 5px;
        }
        .info-box .name {
            font-weight: bold;
            font-size: 16px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-paid {
            background: #d1fae5;
            color: #059669;
        }
        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background: #f3f4f6;
            padding: 12px 15px;
            text-align: left;
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .items-table td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
        }
        .items-table .item-name {
            font-weight: 500;
        }
        .items-table .item-sku {
            font-size: 12px;
            color: #666;
        }
        .items-table .text-right {
            text-align: right;
        }
        .totals {
            width: 300px;
            margin-left: auto;
        }
        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .totals-row.total {
            border-bottom: none;
            border-top: 2px solid #333;
            padding-top: 15px;
            font-size: 18px;
            font-weight: bold;
        }
        .totals-row.total .amount {
            color: #10b981;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        .footer p {
            margin-bottom: 5px;
        }
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #10b981;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .print-btn:hover {
            background: #059669;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .invoice {
                box-shadow: none;
                padding: 20px;
            }
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="print-btn">🖨️ Print Invoice</button>
    
    <div class="invoice">
        <div class="header">
            <div class="logo">
                <span class="logo-icon">🏥</span>
                <div class="logo-text">
                    <h1>HealthFirst</h1>
                    <p>Medical Healthcare</p>
                </div>
            </div>
            <div class="invoice-title">
                <h2>INVOICE</h2>
                <p>{{ $order->order_number }}</p>
            </div>
        </div>

        <div class="invoice-info">
            <div class="info-box">
                <h3>Tagihan Untuk</h3>
                <p class="name">{{ $order->shipping_name }}</p>
                <p>{{ $order->shipping_address }}</p>
                <p>{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                <p>Tel: {{ $order->shipping_phone }}</p>
            </div>
            <div class="info-box" style="text-align: right;">
                <h3>Informasi Invoice</h3>
                <p><strong>Tanggal:</strong> {{ $order->created_at->format('d F Y') }}</p>
                <p><strong>Jatuh Tempo:</strong> {{ $order->created_at->addDays(7)->format('d F Y') }}</p>
                <p style="margin-top: 10px;">
                    <span class="status-badge {{ $order->payment_status == 'paid' ? 'status-paid' : 'status-pending' }}">
                        {{ $order->payment_status == 'paid' ? 'LUNAS' : 'BELUM BAYAR' }}
                    </span>
                </p>
            </div>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%">Item</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>
                        <div class="item-name">{{ $item->product_name }}</div>
                        <div class="item-sku">SKU: {{ $item->product_sku }}</div>
                    </td>
                    <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <div class="totals-row">
                <span>Subtotal</span>
                <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
            </div>
            @if($order->discount_amount > 0)
            <div class="totals-row">
                <span>Diskon</span>
                <span>-Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
            </div>
            @endif
            <div class="totals-row">
                <span>Ongkos Kirim</span>
                <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
            </div>
            <div class="totals-row total">
                <span>Total</span>
                <span class="amount">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer">
            <p><strong>Metode Pembayaran:</strong> {{ \App\Models\Order::PAYMENT_METHODS[$order->payment_method] ?? $order->payment_method }}</p>
            @if($order->tracking_number)
            <p><strong>No. Resi:</strong> {{ $order->tracking_number }}</p>
            @endif
            <br>
            <p>Terima kasih telah berbelanja di HealthFirst Medical</p>
            <p>Jl. Kesehatan No. 123, Jakarta Selatan | Tel: (021) 1234-5678</p>
            <p>Email: support@healthfirst.com | www.healthfirst.com</p>
        </div>
    </div>
</body>
</html>
