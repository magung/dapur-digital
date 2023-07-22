@php
    $title = 'Keranjang';
    $user = Auth::guard('customer')->user();
@endphp
@include('template.header-pelanggan')

<div class="container mt-5 mb-5">
    <br>
    <h1 class="display-4 text-center">
        {{ $title }}
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

                    <form action="{{ route('cart.payment') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="">
                            <div class="row">
                                <div class="col">
                                    <label for="">List Produk di Keranjang</label>
                                </div>
                                <div class="col text-end">
                                    <a href="{{ route('product-list') }}" class="btn btn-md btn-success mb-3 ">+
                                        Produk</a>
                                </div>
                            </div>

                            @php
                                $no = 1;
                            @endphp
                            @forelse ($carts as $cart)
                                <div class="card border-0 shadow rounded">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{ asset('uploads/' . $cart->photo) }}" height="100">
                                            </div>
                                            <div class="col">
                                                {{ $cart->product_name }}
                                                @if ($cart->satuan != 'PCS')
                                                    - {{ $cart->panjang }} x {{ $cart->lebar }} {{ $cart->satuan }}
                                                    <br>
                                                    Jumlah : {{ $cart->qty }} PCS <br>
                                                    
                                                    Berat :
                                                    {{ ($cart->qty * $cart->panjang * $cart->lebar * $cart->weight) / 1000 }}
                                                    Kg
                                                @else
                                                    <br>
                                                    Jumlah : {{ $cart->qty }} {{ $cart->satuan }} <br>
                                                    Berat : {{ ($cart->qty * $cart->weight) / 1000 }} Kg
                                                @endif

                                                @if (isset($cart->finishing_id))
                                                    <br><b>Finishing</b><br>{{ $cart->finishing }} - Rp.
                                                    {{ number_format($cart->finishing_price) }}
                                                @endif
                                                @if (isset($cart->cutting_id))
                                                    <br><b>Cutting</b><br>{{ $cart->cutting }} - Rp.
                                                    {{ number_format($cart->cutting_price) }}
                                                @endif

                                                {{-- Harga : Rp. {{ number_format($cart->price) }} <br> --}}
                                                <br>
                                                Rp. {{ number_format($cart->total_price) }}
                                            </div>
                                            <div class="col text-end">
                                                <a href="{{ route('cart.edit', $cart->cart_id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                <a href="{{ route('cart.destroy', $cart->cart_id) }}"
                                                    class="btn btn-sm btn-danger">HAPUS</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                @php
                                    $no++;
                                @endphp
                            @empty
                                <div class="card border-0 shadow rounded">
                                    <div class="card-body">
                                        <span class="text-center text-mute">Data tidak tersedia</span>
                                    </div>
                                </div><br>
                            @endforelse

                        </div>

                        <div class="form-group">
                            <label for="transaction_type">Tipe Transaksi</label>
                            <select name="transaction_type" class="form-control" required id="transaction_type">
                                @foreach ($types as $type)
                                    <option value="{{ $type->transaction_type_id }}">{{ $type->transaction_type }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- error message untuk role -->
                            @error('transaction_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group" id="toko">
                            <label for="store">Toko</label>
                            <select name="store" class="form-control" >
                                <option value="">-- Toko --</option>
                                @foreach ($stores as $store)
                                    <option value="{{ $store->store_id }}">{{ $store->store_name }}</option>
                                @endforeach
                            </select>
                            <!-- error message untuk role -->
                            @error('store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group" id="alamat">
                            <label for="address">Alamat</label>

                            <select name="address" class="form-control" >
                                <option value="">-- Pilih Alamat --</option>
                                @foreach ($addresses as $address)
                                    <option value="{{ $address->address_id }}">{{ $address->name }} <span>(
                                            {{ $address->address }} )</span></option>
                                @endforeach
                            </select>

                            <!-- error message untuk role -->
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group" id="kurir">
                            <label for="courier">Kurir</label>

                            <select name="courier" class="form-control" id="courier">
                                <option value="">-- Pilih Kurir --</option>
                                @foreach ($couriers as $courier)
                                    <option value="{{ $courier->courier_id }}">{{ $courier->courier_name }} 
                                        <span>({{ $courier->courier_service_name }} - {{ $courier->description }})</span></option>
                                @endforeach
                            </select>

                            <!-- error message untuk role -->
                            @error('courier')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="payment_method">Pembayaran</label>
                            <select name="payment_method" class="form-control" required>
                                @foreach ($payments as $payment)
                                    <option value="{{ $payment->payment_id }}">{{ $payment->payment_method }}</option>
                                @endforeach
                            </select>
                            <!-- error message untuk role -->
                            @error('payment_method')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="final_price">Total Harga</label>
                            <input type="hidden" name="final_price"
                                class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('final_price', $total_harga) }}" required readonly>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                value="Rp. {{ old('final_price', number_format($total_harga)) }}" required readonly>
                            <!-- error message untuk role -->
                            @error('final_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <br>
                        @if (count($carts))
                            <div class="row ">
                                <div class="col text-end">
                                    <button type="submit" class="btn btn-md btn-primary">Selajutnya</button>
                                </div>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@include('template.footer')
<script>
    $(document).ready(function() {
        let transaction_type = $('#transaction_type').val();
        if (transaction_type == 1) {
            $('#toko').show();
            $('#alamat').hide();
            $('#kurir').hide();
        } else {
            $('#toko').hide();
            $('#alamat').show();
            $('#kurir').show();
        }

        $('#transaction_type').change(function() {
            let transaction_type = $('#transaction_type').val();
            if (transaction_type == 1) {
                $('#toko').show();
                $('#alamat').hide();
                $('#kurir').hide();
            } else {
                $('#toko').hide();
                $('#alamat').show();
                $('#kurir').show();
            }
        })

        // $.get("/get-couriers", function(data) {
        //         var courierSelect = $("#courier");
        //         courierSelect.empty();
        //         courierSelect.append('<option value="">-- Pilih Kurir --</option>');

        //         $.each(data.couriers, function(index, courier) {
        //             courierSelect.append('<option value="' + courier.courier_code + '">' + courier.courier_name + ' - '+ courier.courier_service_name +
        //                 '</option>');
        //         });
        //     });
    })
</script>
