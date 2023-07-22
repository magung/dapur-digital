@php
    $title = 'Toko';
    $user = Auth::user();
@endphp
@include('template.header')

<div class="container mt-5">
    <h1 class="display-4">
        Toko
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
                    <a href="{{ route('store.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah Toko</a>

                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Toko</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Email</th>
                                <th scope="col">Sosial Media</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stores as $store)
                                <tr>
                                    <td>{{ $store->store_name }}</td>
                                    <td>{{ $store->store_address }}</td>
                                    <td>{{ $store->email }}</td>
                                    <td>{{ $store->sosial_media }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('store.destroy', $store->store_id) }}" method="POST">
                                            <a href="{{ route('store.edit', $store->store_id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a>
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
@include('template.end')
