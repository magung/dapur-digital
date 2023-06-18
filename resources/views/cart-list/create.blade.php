@php
    $title = 'Keranjang';
    $user = Auth::guard('customer')->user();
@endphp
@include('template.header-pelanggan')

    <div class="container mt-5 mb-5">
        <br>
        <h1 class="display-4 text-center">
            {{$title}}
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
                                <label for="">List Produk di Keranjang</label><br>
                                <a href="{{route('product-list')}}" class="btn btn-md btn-success mb-3 ">+ Produk</a>
                                <table class="table table-bordered mt-1">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Produk</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no = 1
                                        @endphp
                                        @forelse ($carts as $cart)
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>
                                                    {{$cart->product_name}}
                                                    @if ($cart->satuan != 'PCS')
                                                        - {{$cart->panjang}} x {{$cart->lebar}} {{$cart->satuan}}
                                                    @endif
                                                    <br>
                                                    @if (isset($cart->finishing_id))
                                                        <br><b>Finishing</b><br>{{$cart->finishing}} - Rp. {{number_format($cart->finishing_price)}}
                                                    @endif
                                                    @if (isset($cart->cutting_id))
                                                        <br><b>Cutting</b><br>{{$cart->cutting}} - Rp. {{number_format($cart->cutting_price)}}
                                                    @endif
                                                </td>
                                                <td>{{$cart->qty}}</td>
                                                <td>Rp. {{number_format($cart->price)}}</td>
                                                <td>Rp. {{number_format($cart->total_price)}}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('cart.edit', $cart->cart_id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                    <a href="{{route('cart.destroy', $cart->cart_id) }}" class="btn btn-sm btn-danger">HAPUS</a>
                                                </td>
                                            </tr>
                                            @php
                                            $no++
                                            @endphp
                                        @empty
                                        <tr>
                                            <td class="text-center text-mute" colspan="4">Data tidak tersedia</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <label for="store_id">Toko</label>
                                <select name="store_id" class="form-control" required>
                                    <option value="" >-- Toko --</option>
                                    @foreach ($stores as $store)
                                        <option value="{{$store->store_id}}"  >{{$store->store_name}}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk role -->
                                @error('store_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="transaction_type_id">Tipe Transaksi</label>
                                <select name="transaction_type_id" class="form-control" required>
                                    @foreach ($types as $type)
                                        <option value="{{$type->transaction_type_id}}" >{{$type->transaction_type}}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk role -->
                                @error('transaction_type_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="payment_method_id">Pembayaran</label>
                                <select name="payment_method_id" class="form-control" required>
                                    @foreach ($payments as $payment)
                                        <option value="{{$payment->payment_id}}" >{{$payment->payment_method}}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk role -->
                                @error('payment_method_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="final_price">Total Harga</label>
                                <input type="hidden" name="final_price" class="form-control @error('price') is-invalid @enderror" value="{{ old('final_price', $total_harga) }}" required readonly>
                                <input type="text"  class="form-control @error('price') is-invalid @enderror" value="Rp. {{ old('final_price', number_format($total_harga)) }}" required readonly>
                                <!-- error message untuk role -->
                                @error('final_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <br>
                            <div>
                                <button type="submit" class="btn btn-md btn-primary">Beli</button>
                                <a href="{{route('dashboard')}}" class="btn btn-md btn-secondary">Home</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('template.footer')