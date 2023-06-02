<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5 mb-5">
        <h1 class="display-4">
            Edit Transaksi
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
                        <form action="{{ route('transaction.update', $transaction->transaction_list_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="">
                                <label for="">List Produk</label><br>
                                <a href="{{ route('transaction.product.create', $transaction->transaction_list_id) }}" class="btn btn-md btn-success mb-3 ">+ Produk</a>
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
                                            $no=1;
                                        @endphp
                                        @forelse ($transaction_product_lists as $product)
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>
                                                    {{$product->product_name}}
                                                    @if ($product->satuan != 'PCS')
                                                        - {{$product->panjang}} x {{$product->lebar}} {{$product->satuan}}
                                                    @endif
                                                    <br>
                                                    @if (isset($product->finishing_id))
                                                        <br><b>Finishing</b><br>{{$product->finishing}} - Rp. {{number_format($product->finishing_price)}}
                                                    @endif
                                                    @if (isset($product->cutting_id))
                                                        <br><b>Cutting</b><br>{{$product->cutting}} - Rp. {{number_format($product->cutting_price)}}
                                                    @endif
                                                </td>
                                                <td>{{$product->qty}}</td>
                                                <td>Rp. {{number_format($product->price)}}</td>
                                                <td>Rp. {{number_format($product->total_price)}}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('transaction.product.edit', $product->product_id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                    <a href="{{route('transaction.product.destroy', $product->product_id) }}" class="btn btn-sm btn-danger">HAPUS</a>
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
                                <label for="store_id">Toko</label>
                                <select name="store_id" class="form-control" required>
                                    <option value="" >-- Toko --</option>
                                    @foreach ($stores as $store)
                                        <option value="{{$store->store_id}}" {{$store_id == $store->store_id ? 'selected' : ''}} >{{$store->store_name}}</option>
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
                                <label for="user_id">Pelanggan</label>
                                <select name="user_id" class="form-control" required>
                                    <option value="0" >Umum</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->user_id}}" {{$transaction->user_id == $user->user_id ? 'selected' : ''}}>{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk role -->
                                @error('user_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="transaction_type_id">Tipe Transaksi</label>
                                <select name="transaction_type_id" class="form-control" required>
                                    @foreach ($types as $type)
                                        <option value="{{$type->transaction_type_id}}" {{$transaction->transaction_type_id == $type->transaction_type_id ? 'selected' : ''}} >{{$type->transaction_type}}</option>
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
                                <label for="transaction_status_id">Status Transaksi</label>
                                <select name="transaction_status_id" class="form-control" required>
                                    @foreach ($statuses as $status)
                                        <option value="{{$status->id}}" {{$transaction->transaction_status_id == $status->id ? 'selected' : ''}}>{{$status->status}}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk role -->
                                @error('transaction_status_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="payment_method_id">Pembayaran</label>
                                <select name="payment_method_id" class="form-control" required>
                                    @foreach ($payments as $payment)
                                        <option value="{{$payment->payment_id}}" {{$transaction->payment_method_id == $payment->payment_id ? 'selected' : ''}} >{{$payment->payment_method}}</option>
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
                                <label for="payment_status_id">Status Pembayaran</label>
                                <select name="payment_status_id" class="form-control" required>
                                    @foreach ($payment_statuses as $payment_status)
                                        <option value="{{$payment_status->id}}" {{$transaction->payment_status_id == $payment_status->id ? 'selected' : ''}}>{{$payment_status->payment_status}}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk role -->
                                @error('payment_status_id')
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

                            <div class="form-group">
                                <label for="file">File Cetak</label>
                                <input type="file" class="form-control @error('file') is-invalid @enderror"
                                    name="file" value="{{ old('file') }}" >

                                <!-- error message untuk file -->
                                @error('file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Update</button>
                            <a href="{{ route('transaction.index') }}" class="btn btn-md btn-secondary">back</a>
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