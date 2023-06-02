@php
    $title = 'Dashboard';
    $user = Auth::guard('customer')->user();
@endphp
@include('template.header-pelanggan')
<br>
<br>
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
    </div>
</div>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="uploads/PRODUCT-1671962003.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="uploads/PRODUCT-1671962003.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="uploads/PRODUCT-1671962003.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="conteiner mt-5 mb-5 container-fluid">
    <div class="row text-center row-cols-md-8 row-cols-sm-8 g-2">
        @foreach ($categories as $category)
            <a href="/list-product-category/{{$category->category_id}}" class="col-md-2 deco-none">
                <img src="logo.png" width="150">
                <p>{{$category->category_name}}</p>
            </a>
        @endforeach
    </div>
</div>
<div class="conteiner mt-5 mb-5 container-fluid">
    <div class="row row-cols-md-3 row-cols-sm-3 g-2">
        @foreach ($products as $product)    
            <div class="col-sm-4">
                <div class="card">
                    <img src="uploads/{{$product->photo}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->product_name}}</h5>
                        <p class="card-text">Deskripsi Produk</p>
                        <p class="card-text">Harga Rp. {{number_format($product->price)}}</p>
                        @if ($user != null)
                            <a href="{{route('add.to.cart', $product->product_id)}}" class="btn btn-primary">Tambah ke Keranjang</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('template.footer-pelanggan')
