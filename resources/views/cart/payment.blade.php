@php
    $title = 'Pembayaran';
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
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card border-0 shadow rounded">
                <div class="card-body">

                    <form action="{{ route('transaction.customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="">
                            <label for="">List Produk di Keranjang</label>

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
                            <label for="transaction_type_id">Tipe Transaksi</label>
                            <input type="hidden" name="transaction_type_id" value="{{ $transaction_type_id }}">
                            <input type="text" class="form-control"
                                value="{{ $transaction_type->transaction_type }}" readonly>
                        </div>

                        @if ($transaction_type_id == 1)
                            <div class="form-group" id="toko">
                                <label for="store_id">Toko</label>
                                <input type="hidden" name="store_id" value="{{ $store_id }}">
                                <input type="text" class="form-control" value="{{ $store->store_name }}" readonly>
                            </div>
                        @else
                            <div class="form-group" id="alamat">
                                <label for="address_id">Alamat</label>
                                <input type="hidden" name="address_id" value="{{ $address_id }}">
                                <input type="text" class="form-control" value="{{ $address->name }} ( {{$address->address}} )" readonly>
                            </div>

                            <div class="form-group" id="kurir">
                                <label for="courier_id">Kurir</label>
                                <input type="hidden" name="courier_id" value="{{ $courier_id }}">
                                <input type="text" class="form-control" value="{{ $courier->courier_name }} ( {{$courier->courier_service_name}} - {{$courier->description}} )" readonly>
                            </div>

                            <div class="form-group">
                                <label for="courir_id">Ongkos Kirim</label>
                                <input type="hidden" name="courier_price" value="{{ $courier_price }}" >
                                <input type="text" class="form-control"
                                    value="Rp. {{ old('final_price', number_format($courier_price)) }}" required readonly>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="payment_method_id">Pembayaran</label>
                            <input type="hidden" name="payment_method_id" value="{{ $payment_method_id }}">
                                <input type="text" class="form-control" value="{{ $payment->payment_method }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="final_price">Total Harga</label>
                            <input type="hidden" name="final_price" value="{{ old('final_price', $total_harga) }}"
                                required readonly>
                            <input type="text" class="form-control"
                                value="Rp. {{ old('final_price', number_format($total_harga)) }}" required readonly>
                        </div>

                        <br>
                        <div class="row ">
                            <div class="col text-end">
                                <button type="submit" class="btn btn-md btn-primary">Beli</button>
                                <a href="{{ url()->previous() }}" class="btn btn-md btn-secondary">Kembali</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@include('template.footer')
<script>
    $(document).ready(function() {
        
    })
</script>
