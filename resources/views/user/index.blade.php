@php
    $title = 'User';
    $user = Auth::user();
@endphp
@include('template.header')

    <div class="container mt-5">
        <h1 class="display-4">
            User
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
                        <a href="{{ route('user.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah User</a>
                        <table id="myTable" class="table table-bordered mt-1">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email / Username</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">No HP</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Toko</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->user_id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role_name }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->store_name }}</td>
                                    <td><span class="badge {{ $user->status == "1" ? "bg-success" : "bg-danger" }}">{{ $user->status == "1" ? "Aktif" : "Tidak Aktif" }}</span></td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('user.destroy', $user->user_id) }}" method="POST">
                                            <a href="{{ route('user.edit', $user->user_id) }}"
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