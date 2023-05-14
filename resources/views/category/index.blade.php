@php
    $title = 'Kategori';
    $user = Auth::user();
@endphp

@include('template.header')

{{-- ISI --}}
<div class="container mt-5">
    <h1 class="display-4">
        Kategori
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
                    <a href="{{ route('category.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah
                        Kategori</a>

                    <table class="table table-bordered mt-1">
                        <thead>
                            <tr>
                                <th scope="col">Kategori</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->satuan }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('category.destroy', $category->id) }}" method="POST">
                                            <a href="{{ route('category.edit', $category->id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-mute" colspan="4">Data tidak tersedia
                                    </td>
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
