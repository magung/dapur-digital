@php
    $title = 'Laporan';
    $user = Auth::user();
@endphp
@include('template.header')

<div class="container mt-5">
    <h3 class="display-5">
        Laporan Transaksi
    </h3>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <div class="col-5">
                        <span>Tanggal</span>
                        <input type="text" class="form-control" name="daterange" value="" />
                    </div><br>

                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->transaction_list_id }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->customer_id == 0 ? 'Umum' : $transaction->name }}
                                        <br>{{ $transaction->email }} </td>
                                    <td>

                                        @forelse ($transaction->products as $product)
                                            {{ $product->product_name }}
                                            {{ isset($product->panjang) ? $product->panjang . ' x ' . $product->lebar : '' }}
                                            {{ $product->satuan }} <br>
                                        @empty
                                            Data tidak tersedia
                                        @endforelse

                                    </td>
                                    <td>{{ $transaction->final_price }}</td>
                                    <td>{{ $transaction->status }}</td>
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
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            // 'Today': [moment(), moment()],
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                .format('YYYY-MM-DD'));
        });
    });
</script>
@include('template.end')
