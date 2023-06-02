<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Produk</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="display-4">
            Produk
        </h1>
        <a href="/" class="btn btn-success" >Home</a>
        <a href="/cart-list" class="btn btn-warning">List Keranjang</a>
        <a href="/transaction-list" class="btn btn-warning">List Transaksi</a>
        
    </div>
    <br>
    <br>

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
            </div>
            @forelse ($products as $product)
                <div class="card border-0 shadow rounded col-md-4 col-sm-6">
                    <div class="card-body">
                        <div class="product-item">
                            <img src="uploads/{{$product->photo}}" alt="{{$product->product_name}}" class="product-image img-fluid">
                            <h3 class="product-name">{{$product->product_name}}</h3>
                            <p class="product-price">Rp. {{number_format($product->price)}}</p>
                            <a href="{{route('add.to.cart', $product->product_id)}}" class="btn btn-primary">Tambah ke Keranjang</a>
                        </div>
                    </div>
                </div>
            @empty
            <h2>Data tidak tersedia</h2>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>