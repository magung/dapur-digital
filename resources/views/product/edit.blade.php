<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5 mb-5">
        <h1 class="display-4">
            Edit Produk
        </h1>
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
                        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="product_name">Nama Produk</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                    name="product_name" value="{{ old('product_name', $product->product_name) }}" required>

                                <!-- error message untuk product_name -->
                                @error('product_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category">Kategori</label>
                                <select name="category" class="form-control" required>
                                    <option value="" >-- kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected':'' }} >{{$category->category_name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="store">Toko</label>
                                <select name="store" class="form-control" required>
                                    <option value="" >-- toko --</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}" {{ $product->store_id == $store->id ? 'selected':'' }}>{{$store->branch_name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="stock">Stok</label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                    name="stock" value="{{ old('stock', $product->stock) }}" required>

                                <!-- error message untuk stock -->
                                @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    name="price" value="{{ old('price', $product->price) }}" required>

                                <!-- error message untuk price -->
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="photo">Foto Produk</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                    name="photo" value="{{ old('photo') }}" >

                                <!-- error message untuk photo -->
                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <img src="{{ route('image', $product->photo) }}" alt="" width="200">
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Update</button>
                            <a href="{{ route('product.index') }}" class="btn btn-md btn-secondary">back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- include summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 250, //set editable area's height
            });
        })
    </script>
</body>

</html>