@php
    $title = 'Banner';
    $user = Auth::user();
@endphp
@include('template.header')

<div class="container mt-5">
    <h1 class="display-4">
        Banner
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
                    <a href="{{ route('banner.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah
                        Banner</a>

                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Photo</th>
                                <th scope="col">Description</th>
                                <th scope="col">Link</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($banners as $banner)
                                <tr>
                                    <td><img src="{{ asset('uploads/' . $banner->photo) }}" alt="" width="200"
                                            height="100" srcset=""></td>
                                    <td>{{ $banner->description }}</td>
                                    <td>{{ $banner->link }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('banner.destroy', $banner->banner_id) }}" method="POST">
                                            <a href="{{ route('banner.edit', $banner->banner_id) }}"
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
