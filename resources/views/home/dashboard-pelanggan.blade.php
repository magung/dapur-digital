<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 
    <title>Dashboard</title>
</head>
 
<body>
    <div class="container mt-5">
        <h1 class="display-4">
            Welcome {{ auth()->user()->name }}
        </h1>
        
        <a href="{{route('product-list.index')}}" class="btn btn-warning">List Produk</a>
        <a href="/cart-list" class="btn btn-warning">List Keranjang</a>
        <a href="/transaction-list" class="btn btn-warning">List Transaksi</a>
        <a href="/profile" class="btn btn-warning">Profile</a>
        <br>
        <br>
        <form action="/logout" method="POST">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>
 
</html>