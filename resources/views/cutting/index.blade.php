@php
    $title = 'Cutting';
    $user = Auth::user();
@endphp
@include('template.header')

<div class="container mt-5">
    <h1 class="display-4">
        Cutting
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
                    <a href="{{ route('cutting.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah
                        Cutting</a>

                    <table class="table table-bordered mt-1">
                        <thead>
                            <tr>
                                <th scope="col">Cutting</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cuttings as $cutting)
                                <tr>
                                    <td>{{ $cutting->cutting }}</td>
                                    <td>{{ $cutting->cutting_price }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('cutting.destroy', $cutting->id) }}" method="POST">
                                            <a href="{{ route('cutting.edit', $cutting->id) }}"
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
