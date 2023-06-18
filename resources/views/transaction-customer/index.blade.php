@php
    $title = 'Transaksi';
    $user = Auth::guard('customer')->user();
@endphp
@include('template.header-pelanggan')

    <div class="container mt-5">
        <br>
        <h1 class="display-4 text-center">
            {{$title}}
        </h1>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <!-- Notifikasi menggunakan flash session data -->
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
                @endif

                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        

                        <table  class="table table-bordered mt-1">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->transaction_list_id }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>
                                        
                                        @forelse ($transaction->products as $product)
                                        {{$product->product_name}} {{ isset($product->panjang) ? $product->panjang . " x " . $product->lebar : '' }}  {{$product->satuan}} <br>
                                        @empty
                                        Data tidak tersedia
                                        @endforelse
                                        
                                    </td>
                                    <td>Rp. {{ number_format($transaction->final_price) }}</td>
                                    <td>
                                        {{ $transaction->transaction_status }}
                                        <br>
                                        <b>Status Pembayaran</b>
                                        <br>
                                        {{$transaction->payment_status}}

                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('transaction.customer.detail', $transaction->transaction_list_id) }}"
                                            class="btn btn-sm btn-warning">DETAIL</a>
                                            @if ($transaction->payment_status != 'LUNAS')
                                            <br>
                                            <a href="{{ route('transaction.customer.pembayaran', $transaction->transaction_list_id) }}"
                                                class="btn btn-sm btn-primary">PEMBAYARAN</a>
                                            @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center text-mute" colspan="4">Data tidak tersedia</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('template.footer')