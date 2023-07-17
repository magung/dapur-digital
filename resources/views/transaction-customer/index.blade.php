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

                            <tbody>
                                @forelse ($transactions as $transaction)
                                <tr>
                                    <td>
                                        <b>ID {{ $transaction->transaction_list_id }}</b><br>
                                        {{ $transaction->created_at }} <br>
                                        <b>Produk</b>
                                        <br>
                                        @forelse ($transaction->products as $product)
                                        {{$product->product_name}} {{ isset($product->panjang) ? $product->panjang . " x " . $product->lebar : '' }}  {{$product->satuan}} <br>
                                        @empty
                                        Data tidak tersedia
                                        <br>
                                        @endforelse
                                        <b>Harga</b>
                                        <br>
                                        Rp. {{ number_format($transaction->final_price) }} <br>
                                        <b>Status Transaksi</b>
                                        <br>
                                        {{ $transaction->transaction_status }}
                                        <br>
                                        <b>Status Pembayaran</b>
                                        <br>
                                        {{$transaction->payment_status}}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('transaction.customer.detail', $transaction->transaction_list_id) }}"
                                            class="btn btn-sm btn-warning">DETAIL</a>
                                            @if ($transaction->payment_status != 'LUNAS' && $transaction->transaction_status_id != 4 && $transaction->transaction_status_id != 8)
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