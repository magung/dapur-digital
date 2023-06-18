@php
    $title = 'Keranjang';
    $user = Auth::guard('customer')->user();
@endphp
@include('template.header-pelanggan')

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
        <br>
        <h1 class="display-4">
            {{ $product->product_name }}
        </h1>
        <div class="row">
            <div class="col-md-6">
                <img src="{{asset('uploads/'.$product->photo)}}" alt="" width="100%">
            </div>
            <div class="col-md-6">

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

                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="product_id">Produk</label>
                                <label for="product_id">Produk</label>
                                <h3>{{ $product->product_name }}</h3>
                                <input type="hidden" name="product_id" value="{{$product->product_id}}">
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
                                    name="price" id="price" value="{{ old('price', $product->price) }}" required
                                    readonly>
                                <input type="text" class="form-control @error('price') is-invalid @enderror"
                                    id="price_show" value="{{ old('price', number_format($product->price)) }}" required
                                    readonly>
                                <!-- error message untuk price -->
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            
                            <div class="row" id="form-panjang">
                                <div class="col-md-3">
                                    <div class="form-group " >
                                        <label for="panjang">Panjang</label>
                                        <input type="number" class="form-control @error('panjang') is-invalid @enderror"
                                            name="panjang" id="panjang" value="{{ old('panjang', 1) }}" onchange="setLuas()" required min="1">
        
                                        <!-- error message untuk panjang -->
                                        @error('panjang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="form-lebar">
                                        <label for="lebar">Lebar</label>
                                        <input type="number" class="form-control @error('lebar') is-invalid @enderror"
                                            name="lebar" id="lebar" value="{{ old('lebar', 1) }}" onchange="setLuas()" required min="1">
        
                                        <!-- error message untuk lebar -->
                                        @error('lebar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="satuan">Satuan</label>
                                        <input type="text" class="form-control @error('satuan') is-invalid @enderror"
                                            name="satuan" id="satuan" value="{{ $product->satuan }}" required readonly min="1">
        
                                        <!-- error message untuk satuan -->
                                        @error('satuan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="form-group" >
                                <label for="qty">Jumlah</label>
                                <input type="number" class="form-control @error('qty') is-invalid @enderror"
                                    name="qty" id="qty" value="{{ old('qty', 1) }}" onchange="setQty()" required min="1">

                                <!-- error message untuk qty -->
                                @error('qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="finishing_id">Finishing</label>
                                <input type="hidden" name="finishing_price" id="finishing_price" value="{{ old('finishing_price') }}">
                                <select name="finishing_id" id="finishings" class="form-control" onchange="setLuas()" >
                                    <option value="" >-- pilih finishing --</option>
                                    @foreach ($finishings as $finishing)
                                        <option value="{{$finishing->finishing_id}}" data-price="{{$finishing->finishing_price}}">{{$finishing->finishing}} - Rp. {{ number_format($finishing->finishing_price) }}</option>
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
                                <input type="hidden" name="cutting_price" id="cutting_price" value="{{ old('cutting_price') }}">
                                <select name="cutting_id" id="cuttings" class="form-control" onchange="setLuas()">
                                    <option value="" >-- pilih cutting --</option>
                                    @foreach ($cuttings as $cutting)
                                        <option value="{{$cutting->cutting_id}}" data-price="{{$cutting->cutting_price}}" >{{$cutting->cutting}} - Rp. {{ number_format($cutting->cutting_price) }}</option>
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
                                <input type="hidden" name="total_price" id="total_price" value="{{ old('total_price') }}" required readonly>
                                <input type="text" class="form-control @error('total_price') is-invalid @enderror" id="total_price_show" value="{{ old('total_price') }}" required readonly>
                                <!-- error message untuk total_price -->
                                @error('total_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="file">File Cetak</label>
                                <input type="file" class="form-control @error('file') is-invalid @enderror"
                                    name="file"  >

                                <!-- error message untuk file -->
                                @error('file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-md btn-primary">Beli</button>
                                <a  href="{{ url()->previous() }}" class="btn btn-md btn-secondary">back</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('template.footer-pelanggan')