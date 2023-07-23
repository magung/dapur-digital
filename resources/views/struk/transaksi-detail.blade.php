<!DOCTYPE html>
<html>

<head>
    <title>Struk Pembelian</title>
    <style>
        /* Gaya CSS khusus untuk tampilan struk */
        body {
            width: 6cm;
        }

        *{margin:0;padding:0}

        .container {
            width: 5cm;
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

        .table th,
        .table td {
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

        .details {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ public_path('logo_grey.png') }}" alt="Logo" width="100">
        </div>
        <div class="title">
            <h3>Dapur Digital</h3>
        </div>
        <div>{{Auth::user()->store->store_name}}</div>
        <div>{{Auth::user()->store->store_address}}</div>
        <div>{{Auth::user()->store->email}}</div>
        <div>-----------------------------------</div>
        <div class="details">
            <div>{{ $detail_transaction->created_at }}</div>
            <div>
                <table>
                    <tr>
                        <td>Admin</td>
                        <td> : </td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <td>Pelanggan</td>
                        <td> : </td>
                        <td>{{ $detail_transaction->customer->name }}</td>
                    </tr>
                </table>
            </div>
            <div>-----------------------------------</div>
            <div>
                <table>
                    <tr>
                        <td>ID</td>
                        <td> : </td>
                        <td>{{ $detail_transaction->transaction_list_id }}</td>
                    </tr>
                    <tr>
                        <td>Pembayaran</td>
                        <td> : </td>
                        <td>{{ $detail_transaction->payment->payment_method }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td> : </td>
                        <td><b>{{ $detail_transaction->payment_status->payment_status }}</b></td>
                    </tr>
                    <tr>
                        <td>Tipe</td>
                        <td> : </td>
                        <td>{{ $detail_transaction->transaction_type->transaction_type }}</td>
                    </tr>
                    @if ($detail_transaction->transaction_type_id == 2)
                    <tr>
                        <td>Pengiriman</td>
                        <td> : </td>
                        <td>{{ $detail_transaction->courier->courier_name }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td> : </td>
                        <td>{{ $detail_transaction->address->address }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            <div>-----------------------------------</div>
            <div>
                <span>Produk </span>
                <span style="position: absolute; left: 4cm;">Total</span>
            </div>
            <div>-----------------------------------</div>
            <div>
                <table>
                    @php
                        $no = 1;
                        $subtotal = 0;
                    @endphp
                    @foreach ($detail_transaction->transaction_product_lists as $product)
                        <tr>
                            <td>{{ $no }} {{ $product->product->product_name }} {{ $product->qty }}
                                x{{ number_format($product->price) }}</td>
                            <td>{{ number_format($product->total_price) }}</td>
                        </tr>
                        {{ $no++ }}
                        {{ $subtotal += $product->total_price }}
                    @endforeach
                </table>
            </div>
            <div>-----------------------------------</div>
            <div>
                <table>
                    <tr>
                        <td>Subtotal</td>
                        <td> : </td>
                        <td>Rp. {{ number_format($subtotal) }}</td>
                    </tr>
                    @if ($detail_transaction->transaction_type_id == 2)
                        <tr>
                            <td>Ongkir</td>
                            <td> : </td>
                            <td>Rp. {{ number_format($detail_transaction->courier_price) }}</td>
                        </tr>
                    @endif

                    <tr>
                        <td>Total Harga </td>
                        <td> : </td>
                        <td>Rp. {{ number_format($detail_transaction->final_price) }}</td>
                    </tr>
                    {{-- <tr>
                        <td>TUNAI</td>
                        <td> : </td>
                        <td>Rp. 3,200,0000</td>
                    </tr> --}}
                </table>
            </div>
            {{-- <br>
            <div>Uang Kembali Rp. 90,000</div> --}}
            <div>-----------------------------------</div>
        </div>
        <br>
        <div>TERIMA KASIH</div>
        <br>
        <div>-----------------------------------</div>

    </div>
</body>

</html>
