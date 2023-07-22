@php
    $title = 'Alamat';
    $user = Auth::guard('customer')->user();
@endphp
@include('template.header-pelanggan')

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
                    <a href="{{ route('customer.address.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah Alamat</a>

                    <table class="table table-bordered mt-1">
                       
                        <tbody>
                            @forelse ($addresses as $address)
                                <tr>
                                    <td>
                                        <b>Nama Alamat</b><br>
                                        {{$address->name}} <br>
                                        <b>Nama</b><br>
                                        {{$address->contact_name}} <br>
                                        <b>Nomor Telepon</b><br>
                                        {{$address->contact_phone}} <br>
                                        <b>Alamat</b><br>
                                        {{ $address->address }} <br>
                                        <b>Kode POS</b><br>
                                        {{$address->postal_code}} <br>
                                        <b>Catatan</b><br>
                                        {{$address->note}} <br><br>
                                        
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('customer.address.destroy', $address->address_id) }}" method="POST">
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
