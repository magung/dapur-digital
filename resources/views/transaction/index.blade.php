<!doctype html>
<html lang="en">
@php
    $title = 'Transaksi';
    $user = Auth::user();
@endphp
@include('template.header')

<div class="container mt-5">
    <h1 class="display-4">
        {{ $title }}
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
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <a href="{{ route('transaction.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah
                        Transaksi</a>

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
                                    <td>{{ $transaction->customer_id == 0 ? 'Umum' : $transaction->customer->name }}
                                        <br>{{ $transaction->email }}
                                    </td>
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
                                                        {{ $product->product_name }}
                                                    </td>
                                                    <td>
                                                        {{ $product->qty }}
                                                    </td>
                                                    <td>
                                                        {{ $product->satuan }}
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
                                        {{ $transaction->transaction_status->transaction_status }}
                                        <br>
                                        <b>Status Pembayaran</b>
                                        <br>
                                        {{ $transaction->payment_status->payment_status }}

                                    </td>
                                    <td class="text-left">
                                        <div>
                                            <a href="{{ route('transaction.edit', $transaction->transaction_list_id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a>
                                        </div>
                                        <br>
                                        <div>
                                            <a href="{{ route('transaction.detail', $transaction->transaction_list_id) }}"
                                                class="btn btn-sm btn-warning">DETAIL</a>
                                        </div>
                                        <br>
                                        @if ($transaction->transaction_status->transaction_status_id == 2)
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('transaction.update.transaction.status', $transaction->transaction_list_id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="3">
                                                <button type="submit" class="btn btn-sm btn-success">APPROVE</button>
                                            </form>
                                            <br>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('transaction.update.transaction.status', $transaction->transaction_list_id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="4">
                                                <button type="submit" class="btn btn-sm btn-danger">REJECT</button>
                                            </form>
                                            <br>
                                            
                                        @endif

                                        @if ($transaction->payment_status->payment_status_id == 2 && $transaction->transaction_status->transaction_status_id != 8 && $transaction->transaction_status->transaction_status_id != 4)
                                                <form onsubmit="return confirm('Apakah Transaksi sudah LUNAS ?');"
                                                    action="{{ route('transaction.update.payment.status', $transaction->transaction_list_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="1">
                                                    <button type="submit" class="btn btn-sm btn-success">LUNAS</button>
                                                </form>
                                                <br>
                                            @else
                                                {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('transaction.update.payment.status', $transaction->transaction_list_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="2">
                                                    <button type="submit" class="btn btn-sm btn-warning">BELUM
                                                        LUNAS</button>
                                                </form>
                                                <br> --}}
                                            @endif
                                        
                                        @if ($transaction->transaction_status->transaction_status_id == 3)
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('transaction.update.transaction.status', $transaction->transaction_list_id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="5">
                                                <button type="submit" class="btn btn-sm btn-warning">PROSES</button>
                                            </form>
                                            <br>
                                        @endif

                                        @if ($transaction->transaction_type->transaction_type_id == 2 && $transaction->transaction_status->transaction_status_id == 5)
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('transaction.update.transaction.status', $transaction->transaction_list_id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="6">
                                                <button type="submit" class="btn btn-sm btn-warning">KIRIM</button>
                                            </form>
                                            <br>
                                        @endif
                                        @if ($transaction->transaction_type->transaction_type_id == 2 && $transaction->transaction_status->transaction_status_id == 6)
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('transaction.update.transaction.status', $transaction->transaction_list_id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="7">
                                                <button type="submit" class="btn btn-sm btn-success">SELESAI</button>
                                            </form>
                                            <br>
                                        @endif
                                        @if ($transaction->transaction_type->transaction_type_id == 1 && $transaction->transaction_status->transaction_status_id == 5)
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('transaction.update.transaction.status', $transaction->transaction_list_id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="7">
                                                <button type="submit" class="btn btn-sm btn-success">SELESAI</button>
                                            </form>
                                            <br>
                                        @endif
                                        @if ($transaction->transaction_status->transaction_status_id != 8 && $transaction->transaction_status->transaction_status_id != 4 )
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('transaction.update.transaction.status', $transaction->transaction_list_id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="8">
                                                <button type="submit" class="btn btn-sm btn-danger">BATAL</button>
                                            </form>
                                            <br>
                                            
                                        @endif
                                        {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('transaction.destroy', $transaction->transaction_list_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-mute" colspan="7">Data tidak tersedia</td>
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
