<!doctype html>
<html lang="en">
@php
    $title = 'Tambah Transaksi';
    $user = Auth::user();
@endphp
@include('template.header')

<div class="container mt-5 mb-5">
    <h1 class="display-4">
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

                    <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="">
                            <label for="">List Produk</label><br>
                            <a href="{{ route('product-list-admin') }}" class="btn btn-md btn-success mb-3 ">+
                                Produk</a>
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
                                        $no = 1;
                                    @endphp
                                    @forelse ($carts as $cart)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>
                                                {{ $cart->product->product_name }}
                                                @if ($cart->satuan != 'PCS')
                                                    - {{ $cart->panjang }} x {{ $cart->lebar }} {{ $cart->satuan }}
                                                @endif
                                                <br>
                                                @if (isset($cart->finishing_id))
                                                    <br><b>Finishing</b><br>{{ $cart->finishing->finishing }} - Rp.
                                                    {{ number_format($cart->finishing_price) }}
                                                @endif
                                                @if (isset($cart->cutting_id))
                                                    <br><b>Cutting</b><br>{{ $cart->cutting->cutting }} - Rp.
                                                    {{ number_format($cart->cutting_price) }}
                                                @endif
                                            </td>
                                            <td>{{ $cart->qty }}</td>
                                            <td>Rp. {{ number_format($cart->price) }}</td>
                                            <td>Rp. {{ number_format($cart->total_price) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.cart.edit', $cart->cart_id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                <a href="{{ route('admin.cart.destroy', $cart->cart_id) }}"
                                                    class="btn btn-sm btn-danger">HAPUS</a>
                                            </td>
                                        </tr>
                                        @php
                                            $no++;
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
                            <label for="customer">Pelanggan</label>
                            <select name="customer" class="form-control" required id="customer">
                                <option value="0">Umum</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->customer_id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            <!-- error message untuk role -->
                            @error('customer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                            <select name="store" class="form-control">
                                <option value="">-- Toko --</option>
                                @foreach ($stores as $store)
                                    <option value="{{ $store->store_id }}"
                                        {{ $store_id == $store->store_id ? 'selected' : '' }}>{{ $store->store_name }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- error message untuk role -->
                            @error('store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div id="dikirim">
                            

                            <div class="form-group" id="alamat">
                                <label for="address">Alamat</label>
                                <input type="text" name="address_text" class="form-control" id="address_text">
                                <select name="address" class="form-control" id="address">
                                    <option value="">-- Pilih Alamat --</option>
                                </select>
                            </div>

                            <div class="form-group" id="nama_pelanggan">
                                <label for="nama_pelanggan">Nama Penerima</label>
                                <input type="text" name="nama_pelanggan" class="form-control" id="contact_name">
                            </div>

                            <div class="form-group" id="nomor_pelanggan">
                                <label for="nomor_pelanggan">Nomor Hp Penerima</label>
                                <input type="text" name="nomor_pelanggan" class="form-control" id="contact_phone">
                            </div>

                            <div class="form-group" id="kode_pos">
                                <label for="kode_pos">Kode POS</label>
                                <input type="text" name="kode_pos" class="form-control" id="postal_code">
                            </div>

                            <div class="form-group" id="kurir">
                                <label for="courier">Kurir</label>

                                <select name="courier" class="form-control" id="courier">
                                    <option value="">-- Pilih Kurir --</option>
                                    @foreach ($couriers as $courier)
                                        <option data-courier-code="{{ $courier->courier_code }}"
                                            data-courier-service-code="{{ $courier->courier_service_code }}"
                                            value="{{ $courier->courier_id }}">{{ $courier->courier_name }}
                                            <span>({{ $courier->courier_service_name }} -
                                                {{ $courier->description }})</span>
                                        </option>
                                    @endforeach
                                </select>

                                <!-- error message untuk role -->
                                @error('courier')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group" id="ongkos_kirim">
                                <label for="courier">Ongkos Kirim</label>
                                <input type="hidden" class="form-control" value="0" name="ongkir">
                                <input type="text" class="form-control" value="0" readonly id="ongkir_text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="transaction_status">Status Transaksi</label>
                            <select name="transaction_status" class="form-control" required>
                                @foreach ($transaction_statuses as $transaction_status)
                                    <option value="{{ $transaction_status->transaction_status_id }}">
                                        {{ $transaction_status->transaction_status }}</option>
                                @endforeach
                            </select>
                            <!-- error message untuk role -->
                            @error('transaction_status')
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
                            <label for="payment_status">Status Pembayaran</label>
                            <select name="payment_status" class="form-control" required>
                                @foreach ($payment_statuses as $payment_status)
                                    <option value="{{ $payment_status->payment_status_id }}">{{ $payment_status->payment_status }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- error message untuk role -->
                            @error('payment_status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="final_price">Total Harga</label>
                            <input type="hidden" name="final_price"
                                class="form-control @error('price') is-invalid @enderror"
                                value="{{ $total_harga }}" id="final_price">
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                value="Rp. {{ number_format($total_harga) }}" required readonly
                                id="final_price_text">
                            <!-- error message untuk role -->
                            @error('final_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ route('transaction.index') }}" class="btn btn-md btn-secondary">Kembali</a>
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
        let transaction_type = $('#transaction_type').val();
        let customer = $('#customer').val();
        if (transaction_type == 1) {
            $('#toko').show();
            $('#alamat').hide();
            $('#kurir').hide();
            $('#ongkos_kirim').hide();
            $('#dikirim').hide();
        } else {
            $('#toko').hide();
            $('#alamat').show();
            $('#kurir').show();
            $('#ongkos_kirim').show();
            $('#dikirim').show();
        }
        if (customer == "0") {
            $('#address').hide()
            $('#address_text').show()
        } else {
            $('#address').show()
            $('#address_text').hide()
        }

        $('#customer').change(function() {
            let customer = $('#customer').val();
            var addressSelect = $("#address");
            addressSelect.empty();
            addressSelect.append('<option value="">Pilih Alamat Pelanggan</option>');
            $('#contact_name').val('')
            $('#contact_phone').val('')
            $('#postal_code').val('')
            $('#address').val('')
            if (customer == "0") {
                $('#address').hide()
                $('#address_text').show()
            } else {
                $('#address').show()
                $('#address_text').hide()
                $.ajax({
                    url: '/api/get-address/' + customer,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.error_code === 200) {
                            var addresses = response.addresses;
                            if (addresses.length > 0) {
                                $.each(addresses, function(index, address) {
                                    addressSelect.append('<option value="' +
                                        address.address_id + '" ' 
                                        +' data-contact-name="'+address.contact_name+'"'
                                        +' data-contact-phone="'+address.contact_phone+'"'
                                        +' data-postal-code="'+address.postal_code+'"'
                                        +'>' + address.address + '</option>');
                                });
                            } else {
                                $('#address').hide()
                                $('#address_text').show()
                                console.log('Alamat tidak ditemukan.');
                            }
                        } else {
                            console.log('Terjadi kesalahan: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Terjadi kesalahan: ' + error);
                    }
                });
            }
        })

        $('#address').change(function() {
            var selectedOption = $(this).find('option:selected');
            var contactName = selectedOption.data('contact-name');
            var contactPhone = selectedOption.data('contact-phone');
            var postalCode = selectedOption.data('postal-code');
            $('#contact_name').val(contactName)
            $('#contact_phone').val(contactPhone)
            $('#postal_code').val(postalCode)
        })

        $('#transaction_type').change(function() {
            let transaction_type = $('#transaction_type').val();
            if (transaction_type == 1) {
                $('#toko').show();
                $('#alamat').hide();
                $('#kurir').hide();
                $('#ongkos_kirim').hide();
                $('#dikirim').hide();
                let total_harga = {{$total_harga}}
                $('#final_price').val(total_harga);
                $('#final_price_text').val(total_harga.toLocaleString());
                $('#courier').val('')
                $('#ongkir').val(0)
                $('#ongkir_text').val(0)
            } else {
                $('#toko').hide();
                $('#alamat').show();
                $('#kurir').show();
                $('#ongkos_kirim').show();
                $('#dikirim').show();
            }
        })

        $('#courier').change(function() {
            // Mengambil data dari input
            var selectedOption = $(this).find('option:selected');
            var courierCode = selectedOption.data('courier-code');
            var courierServiceCode = selectedOption.data('courier-service-code');

            console.log("cek ongkir")
            var address = $('#address').find('option:selected').text();
            console.log(address)
            var customer = $('#customer').val();
            if (customer == "0") {
                address = $('#address_text').val()
            }
            var items = [];
            @foreach ($carts as $cart)
                var item = {
                    id: {{ $cart->product->product_id }},
                    name: "{{ $cart->product->product_name }}",
                    image: "",
                    description: "",
                    value: {{ $cart->product->price }},
                    quantity: {{ $cart->qty }},
                    weight: {{ $cart->qty * $cart->product->weight }}
                };
                items.push(item);
            @endforeach
            var requestData = {
                contact_name: $('#contact_name').val(),
                contact_phone: $('#contact_phone').val(),
                address: address,
                postal_code: $('#postal_code').val(),
                "note": "",
                "courier_code": courierCode,
                "courier_service_code": courierServiceCode,
                "items": items
            }

            // Mengirim permintaan ke API menggunakan AJAX
            $.ajax({
                url: '/api/cek-ongkir',
                type: 'POST',
                dataType: 'json',
                data: requestData,
                success: function(response) {
                    if (response.error_code === 200) {
                        // Memperbarui nilai input dengan harga yang diperoleh dari respons
                        $('#ongkir').val(response.price);
                        $('#ongkir_text').val(response.price.toLocaleString());
                        let total_price = parseInt(response.price) + parseInt({{$total_harga}}) 
                        $('#final_price').val(total_price);
                        $('#final_price_text').val(total_price.toLocaleString());
                    } else {
                        console.log('Terjadi kesalahan: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Terjadi kesalahan: ' + error);
                }
            });
        });
    })
</script>
