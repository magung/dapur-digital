@php
    $title = 'Laporan Stok Produk';
    $user = Auth::user();
@endphp
@include('template.header')

    <div class="container mt-5">
        <h3 class="display-5">
            Laporan Stok Produk
        </h3>
    </div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Kategori</th>
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