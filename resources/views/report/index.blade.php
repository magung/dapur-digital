@php
    $title = 'Laporan';
    $user = Auth::user();
@endphp
@include('template.header')

    <div class="container mt-5">
        <h1 class="display-4">
            Laporan
        </h1>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h3>Laporan Transaksi</h3>

                        <table class="table table-bordered mt-1">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->transaction_list_id }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->user_id == 0 ? 'Umum' : $transaction->name }} <br>{{ $transaction->email }} </td>
                                    <td>
                                        
                                        @forelse ($transaction->products as $product)
                                        {{$product->product_name}} {{ isset($product->panjang) ? $product->panjang . " x " . $product->lebar : '' }}  {{$product->satuan}} <br>
                                        @empty
                                        Data tidak tersedia
                                        @endforelse
                                        
                                    </td>
                                    <td>{{ $transaction->final_price }}</td>
                                    <td>{{ $transaction->status }}</td>
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h3>Laporan Stok Produk</h3>
                        <table class="table table-bordered mt-1">
                            <thead>
                                <tr>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Toko</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->category_name }}</td>
                                    <td>{{ $product->store_name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->satuan }}</td>
                                    <td>{{ $product->stock }}</td>
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
@include('template.end')