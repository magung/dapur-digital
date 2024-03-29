<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Produk Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<script>
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    function setSatuan() {
        var satuan = $('#product').find(':selected').data('satuan')
        var price = $('#product').find(':selected').data('price')
        console.log(satuan)
        $('#satuan').val(satuan);
        $('#price').val(price);
        $('#price_show').val(numberWithCommas(price));
        $('#total_price').val(price);
        $('#total_price_show').val(numberWithCommas(price))
        if(satuan == 'M') {
            $('#form-panjang').show();
            $('#form-lebar').show();
            $("#qty").attr('readonly', 'readonly');
        } else {
            $('#form-panjang').hide();
            $('#form-lebar').hide();
            $("#qty").removeAttr('readonly');
        }
    }

    function setLuas() {
        var panjang = $('#panjang').val()
        var lebar = $('#lebar').val()
        var harga = $('#price').val()
        var qty = $('#qty').val();
        if ($('#satuan').val() == 'M') {
            qty = panjang * lebar ;
        }
        var finishing_price = $('#finishings').find(':selected').data('price')
        var cutting_price = $('#cuttings').find(':selected').data('price')
        if(cutting_price == undefined ) {
            cutting_price = 0
        }
        if(finishing_price == undefined ) {
            finishing_price = 0
        }
        var total_harga = (qty * harga) + finishing_price + cutting_price;
        $('#qty').val(qty)
        $('#cutting_price').val(cutting_price)
        $('#finishing_price').val(finishing_price)
        $('#total_price').val(total_harga)
        $('#total_price_show').val(numberWithCommas(total_harga))
    }

    function setQty() {
        var qty = $('#qty').val()
        var harga = $('#price').val()
        var finishing_price = $('#finishings').find(':selected').data('price')
        var cutting_price = $('#cuttings').find(':selected').data('price')
        if(cutting_price == undefined ) {
            cutting_price = 0
        }
        if(finishing_price == undefined ) {
            finishing_price = 0
        }
        var total_harga = (qty * harga) + finishing_price + cutting_price;
        $('#total_price').val(total_harga)
        $('#total_price_show').val(numberWithCommas(total_harga))
    }

</script>

<body>

    <div class="container mt-5 mb-5">
        <h1 class="display-4">
            Edit Produk Transaksi
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
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div class="card border-0 shadow rounded">
                    <div class="card-body">

                        <form action="{{ route('transaction.product.update', $transaction_product_list->id)  }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="product_id">Produk</label>
                                <select name="product_id" id="product" class="form-control" required onchange="setSatuan()">
                                    @foreach ($products as $product)
                                        <option 
                                            value="{{$product->product_id}}" 
                                            data-satuan="{{$product->satuan}}" 
                                            data-price="{{$product->price}}" 
                                            {{$transaction_product_list->product_id == $product->product_id ? 'selected' : ''}}
                                            >{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk product_id -->
                                @error('product_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Harga Satuan</label>
                                <input type="hidden" class="form-control @error('price') is-invalid @enderror"
                                    name="price" id="price" value="{{ old('price', $transaction_product_list->price) }}" required readonly>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price_show" value="{{ old('price',  number_format($transaction_product_list->price)) }}" required readonly>
                                <!-- error message untuk price -->
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control @error('satuan') is-invalid @enderror"
                                    name="satuan" id="satuan" value="{{ old('satuan', $transaction_product_list->satuan) }}" required readonly>

                                <!-- error message untuk satuan -->
                                @error('satuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group" id="form-panjang">
                                <label for="panjang">Panjang</label>
                                <input type="number" class="form-control @error('panjang') is-invalid @enderror"
                                    name="panjang" id="panjang" value="{{ old('panjang', $transaction_product_list->panjang) }}" onchange="setLuas()" required>

                                <!-- error message untuk panjang -->
                                @error('panjang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group" id="form-lebar">
                                <label for="lebar">Lebar</label>
                                <input type="number" class="form-control @error('lebar') is-invalid @enderror"
                                    name="lebar" id="lebar" value="{{ old('lebar', $transaction_product_list->lebar) }}" onchange="setLuas()" required>

                                <!-- error message untuk lebar -->
                                @error('lebar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group" >
                                <label for="qty">Qty</label>
                                <input type="number" class="form-control @error('qty') is-invalid @enderror"
                                    name="qty" id="qty" value="{{ old('qty', $transaction_product_list->qty) }}" onchange="setQty()" required>

                                <!-- error message untuk qty -->
                                @error('qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="finishing_id">Finishing</label>
                                <input type="hidden" name="finishing_price" id="finishing_price" value="{{ old('finishing_price', $transaction_product_list->finishing_price) }}">
                                <select name="finishing_id" id="finishings" class="form-control" onchange="setLuas()" >
                                    <option value="" >-- pilih finishing --</option>
                                    @foreach ($finishings as $finishing)
                                        <option value="{{$finishing->finishing_id}}" data-price="{{$finishing->finishing_price}}" {{$transaction_product_list->finishing_id == $finishing->finishing_id ? 'selected' : ''}}>{{$finishing->finishing}} - Rp. {{ number_format($finishing->finishing_price) }}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk role -->
                                @error('finishing_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cutting_id">Cutting</label>
                                <input type="hidden" name="cutting_price" id="cutting_price" value="{{ old('cutting_price', $transaction_product_list->cutting_price) }}">
                                <select name="cutting_id" id="cuttings" class="form-control" onchange="setLuas()">
                                    <option value="" >-- pilih cutting --</option>
                                    @foreach ($cuttings as $cutting)
                                        <option value="{{$cutting->cutting_id}}" data-price="{{$cutting->cutting_price}}" {{$transaction_product_list->cutting_id == $cutting->cutting_id ? 'selected' : ''}}>{{$cutting->cutting}} - Rp. {{ number_format($cutting->cutting_price) }}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk role -->
                                @error('cutting_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="total_price">Total Harga</label>
                                <input type="hidden" class="form-control @error('total_price') is-invalid @enderror"
                                    name="total_price" id="total_price" value="{{ old('total_price', $transaction_product_list->total_price) }}" required readonly>
                                <input type="text" class="form-control @error('total_price') is-invalid @enderror" id="total_price_show" value="{{ old('total_price', number_format($transaction_product_list->total_price)) }}" required readonly>
                                <!-- error message untuk total_price -->
                                @error('total_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ route('transaction.edit', $transaction_product_list->transaction_list_id) }}" class="btn btn-md btn-secondary">Kembali</a>

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
            var satuan = $('#satuan').val();
            if(satuan != 'PCS') {
                $('#form-panjang').show();
                $('#form-lebar').show();
            } else {
                $('#form-panjang').hide();
                $('#form-lebar').hide();
            }
        })
    </script>
</body>

</html>