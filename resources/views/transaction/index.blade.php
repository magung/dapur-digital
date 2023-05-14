<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Transaksi</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="display-4">
            Transaksi
        </h1>
        <a href="/" class="btn btn-success" >Home</a>
        @if ($user->role_id == 4)
        <a href="{{route('product-list.index')}}" class="btn btn-warning">List Produk</a>
        <a href="/cart-list" class="btn btn-warning">List Keranjang</a>
        @endif
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
                        @if ($user->role_id != 4)
                        <a href="{{ route('transaction.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah Transaksi</a>
                        @endif

                        <table class="table table-bordered mt-1">
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
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->user_id == 0 ? 'Umum' : $transaction->name }} <br>{{ $transaction->email }} </td>
                                    <td>
                                        
                                        @forelse ($transaction->products as $product)
                                        {{$product->product_name}} {{ isset($product->panjang) ? $product->panjang . " x " . $product->lebar : '' }}  {{$product->satuan}} <br>
                                        @empty
                                        Data tidak tersedia
                                        @endforelse
                                        
                                    </td>
                                    <td>Rp. {{ number_format($transaction->final_price) }}</td>
                                    <td>
                                        {{ $transaction->status }}
                                        <br>
                                        <b>Status Pembayaran</b>
                                        <br>
                                        {{$transaction->payment_status}}

                                    </td>
                                    <td class="text-center">
                                        @if ($user->role_id != 4)
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('transaction.destroy', $transaction->id) }}" method="POST">
                                            <a href="{{ route('transaction.edit', $transaction->id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a>
                                            <a href="{{ route('transaction.detail', $transaction->id) }}"
                                                class="btn btn-sm btn-warning">DETAIL</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                        @endif
                                        @if ($user->role_id == 4)
                                        <a href="{{ route('transaction.detail', $transaction->id) }}"
                                            class="btn btn-sm btn-warning">DETAIL</a>
                                            @if ($transaction->payment_status != 'LUNAS')
                                            <br>
                                            <a href="{{ route('transaction.pembayaran', $transaction->id) }}"
                                                class="btn btn-sm btn-primary">PEMBAYARAN</a>
                                            @endif
                                        @endif
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>