<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembelian</title>
    <style>
        /* Gaya CSS khusus untuk tampilan struk */
        .container {
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        .logo {
            margin-top: 20px;
        }

        .title {
            margin-top: 10px;
        }

        .table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 5px;
            border-bottom: 1px solid #000;
        }

        .table th {
            text-align: left;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }

        .total strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ public_path('logo.png') }}" alt="Logo" width="100">
        </div>
        <div class="title">
            <h2>Dapur Digital</h2>
        </div>
        <div class="details">
            <p>Nama Pelanggan: {{ $detail_transaction->customer->name }}</p>
            <p>Pembayaran: {{ $detail_transaction->payment->payment_method }}</p>
            <p>Status Pembayaran: {{ $detail_transaction->payment_status->payment_status }}</p>
            <p>Status Transaksi: {{ $detail_transaction->transaction_status->transaction_status }}</p>
            <p>Tipe Transaksi: {{ $detail_transaction->transaction_type->transaction_type }}</p>
            @if ($detail_transaction->transaction_type_id == 2)
            <p>Alamat Pelanggan: {{ $detail_transaction->address->address }}</p>
            <p>Kurir: {{ $detail_transaction->courier->courier_name }} -  {{ $detail_transaction->courier->courier_service_name }}</p>
            <p>Ongkir: {{ $detail_transaction->courier_price }}</p>
            @endif
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($detail_transaction->transaction_product_lists as $product)
                    <tr>
                        <td>{{ $no}}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->total_price }}</td>
                    </tr>
                    {{$no++}}
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <strong>Total Harga: {{ $detail_transaction->final_price }}</strong>
        </div>
    </div>
</body>
</html>
