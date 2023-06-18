<!doctype html>
<html lang="en">
    @php
    $title = 'Transaksi';
    $user = Auth::user();
@endphp
@include('template.header')

    <div class="container mt-5">
        <h1 class="display-4">
            {{$title}}
        </h1>
    </div>

    <div class="container mt-5">
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
                        {{-- <a href="{{ route('transaction.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah Transaksi</a> --}}

                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->transaction_list_id }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->user_id == 0 ? 'Umum' : $transaction->name }} <br>{{ $transaction->email }} </td>
                                    <td>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Nama Produk</td>
                                                <td>Qty</td>
                                                <td>Satuan</td>
                                            </tr>
                                            @forelse ($transaction->products as $product)
                                            <tr>
                                                <td>
                                                    {{$product->product_name}} 
                                                </td>
                                                <td>
                                                    {{$product->qty}} 
                                                </td>
                                                <td>
                                                    {{$product->satuan}} 
                                                </td>
                                            </tr>
                                            {{-- {{ isset($product->panjang) ? $product->panjang . " x " . $product->lebar : '' }}  {{$product->satuan}}  --}}
                                            <br>
                                            @empty
                                            Data tidak tersedia
                                            @endforelse
                                        </table>
                                        
                                    </td>
                                    <td>Rp. {{ number_format($transaction->final_price) }}</td>
                                    <td>
                                        {{ $transaction->transaction_status }}
                                        <br>
                                        <b>Status Pembayaran</b>
                                        <br>
                                        {{$transaction->payment_status}}

                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('transaction.destroy', $transaction->transaction_list_id) }}" method="POST">
                                            <a href="{{ route('transaction.edit', $transaction->transaction_list_id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a>
                                            <a href="{{ route('transaction.detail', $transaction->transaction_list_id) }}"
                                                class="btn btn-sm btn-warning">DETAIL</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center text-mute" colspan="4">Data tidak tersedia</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('template.footer')