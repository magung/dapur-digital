@php
    $title = 'Cari Produk';
    $user = Auth::user();
@endphp
@include('template.header')
<br>


<body>
    <div class="container mt-5">
        <h3 class="">
            {{$title}}
        </h3>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-2">
                <a href="{{ route('transaction.create') }}" class="btn btn-md btn-secondary">Kembali</a>
            </div><br><br>
            <div class="row col-md-12">
                <form class="d-flex  me-2" action="{{ route('product-list-admin') }}" method="GET">
                    <div class="col-md-4">
                        <select name="category_id" id=""
                                class="btn btn-light text-left text-black text-decoration-none form-control choices-single">
                                <option value="">Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}"
                                        {{ $category_id == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}</option>
                                @endforeach
                        </select>
                    </div>
                    &nbsp;
                    <input class="form-control text-black text-decoration-none" type="search"
                        placeholder="Cari Produk" value="{{ $product_name != '' ? $product_name : '' }}"
                        name="product_name" aria-label="Search">
                    &nbsp;
                    <button class="btn btn-light" type="submit">Cari</button>
                </form>
            </div>
            <div class="col-md-12">
                <!-- Notifikasi menggunakan flash session data -->
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
            </div>
            <div class="row row-cols-md-3 row-cols-sm-3 g-2">
                @forelse ($products as $product)
                    <div class="col-sm-4">
                        <div class="card">
                            <a href="{{ route('admin.cart.create', $product->product_id) }}">
                                <img src="{{ asset('uploads/' . $product->photo) }}" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->product_name }}</h5>
                                <p class="card-text">Deskripsi Produk</p>
                                <p class="card-text">Harga Rp. {{ number_format($product->price) }}</p>
                                @if ($user != null)
                                    <a href="{{ route('admin.cart.create', $product->product_id) }}" class="btn btn-primary">Tambah
                                        ke
                                        Keranjang</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                <h2>Data tidak tersedia</h2>
                @endforelse
            </div>
        </div>
    </div>

@include('template.footer')