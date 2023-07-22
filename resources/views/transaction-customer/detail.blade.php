<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5 mb-5">
        <h1 class="display-4">
            Detail Transaksi
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
                        <form>
                            @csrf
                            @method('PUT')
                            <div class="">
                                <h3>ID {{$transaction->transaction_list_id}}</h3>
                                <label for="">List Produk</label><br>
                                <table class="table table-bordered mt-1">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Produk</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">File Cetak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @forelse ($transaction_product_lists as $transaction_product)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>
                                                    {{ $transaction_product->product->product_name }}
                                                    @if ($transaction_product->satuan != 'PCS')
                                                        - {{ $transaction_product->panjang }} x
                                                        {{ $transaction_product->lebar }}
                                                        {{ $transaction_product->satuan }}
                                                    @endif
                                                    <br>
                                                    @if (isset($transaction_product->finishing_id))
                                                        <br><b>Finishing</b><br>{{ $transaction_product->finishing->finishing }}
                                                        - Rp. {{ number_format($transaction_product->finishing_price) }}
                                                    @endif
                                                    @if (isset($transaction_product->cutting_id))
                                                        <br><b>Cutting</b><br>{{ $transaction_product->cutting->cutting }}
                                                        - Rp. {{ number_format($transaction_product->cutting_price) }}
                                                    @endif
                                                </td>
                                                <td>{{ $transaction_product->qty }}</td>
                                                <td>Rp. {{ number_format($transaction_product->price) }}</td>
                                                <td>Rp. {{ number_format($transaction_product->total_price) }}</td>
                                                <td>
                                                    @if ($transaction_product->file)
                                                        <a href="{{ route('download', 'file=' . $transaction_product->file) }}"
                                                            download target="blank"
                                                            class="btn btn-sm btn-danger">Download</a>
                                                        {{ $transaction_product->file }}
                                                    @else
                                                        <p>File Tidak Ada</p>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $no++;
                                            @endphp
                                        @empty
                                            <tr>
                                                <td class="text-center text-mute" colspan="4">Data tidak tersedia
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="transaction_type_id">Tipe Transaksi</label>
                                    <input type="text" class="form-control"
                                        value="{{ $transaction->transaction_type->transaction_type }}" readonly>
                                </div>

                                @if ($transaction->transaction_type_id == 1)
                                    <div class="form-group col-6">
                                        <label for="transaction_type_id">Toko</label>
                                        <input type="text" class="form-control"
                                            value="{{ $transaction->store->store_name }}" readonly>
                                    </div>
                                @else
                                    <div class="form-group col-6">
                                        <label for="">Alamat</label>
                                        <input type="text" class="form-control"
                                            value="{{ $transaction->address->name }} - {{$transaction->address->address}}" readonly>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Kurir</label>
                                        <input type="text" class="form-control"
                                            value="{{ $transaction->courier->courier_name }} - {{$transaction->courier->courier_service_name}}" readonly>
                                    </div>
                                @endif


                                <div class="form-group col-6">
                                    <label for="transaction_status_id">Status Transaksi</label>
                                    <input type="text" class="form-control"
                                        value="{{ $transaction->transaction_status->transaction_status }}" readonly>
                                </div>

                                <div class="form-group col-6">
                                    <label for="payment_method_id">Pembayaran</label>
                                    <input type="text" class="form-control"
                                        value="{{ $transaction->payment->payment_method }}" readonly>
                                </div>
                                <div class="form-group col-6">
                                    <label for="payment_status_id">Status Pembayaran</label>
                                    <input type="text" class="form-control"
                                        value="{{ $transaction->payment_status->payment_status }}" readonly>
                                </div>
                                <div class="form-group col-6">
                                    <label for="final_price">Total Harga</label>
                                    <input type="hidden" name="final_price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('final_price', $total_harga) }}" readonly>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                    value="Rp. {{ old('final_price', number_format($total_harga)) }}" readonly>
                                    <!-- error message untuk role -->
                                    @error('final_price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                @if ($transaction->bukti_pembayaran != null)
                                    <div class="form-group col-6">
                                        <label for="">Bukti Pembayaran</label>
                                        <img src="{{ asset('bukti-pembayaran/' . $transaction->bukti_pembayaran) }}"
                                            alt="" sizes="" width="100%" srcset="">
                                    </div>
                                @endif
                            </div>



                            <br>

                            <a href="{{ route('transaction.customer.index') }}"
                                class="btn btn-md btn-secondary">Kembali</a>

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
