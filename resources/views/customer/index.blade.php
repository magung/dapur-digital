@php
    $title = 'customer';
    $user = Auth::user();
@endphp
@include('template.header')

    <div class="container mt-5">
        <h1 class="display-4">
            Customer
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
                        <a href="{{ route('customer.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah customer</a>
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No HP</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->customer_id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone_number }}</td>
                                    <td>{{ $customer->gender }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td><span class="badge {{ $customer->status == "1" ? "bg-success" : "bg-danger" }}">{{ $customer->status == "1" ? "Aktif" : "Tidak Aktif" }}</span></td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('customer.destroy', $customer->customer_id) }}" method="POST">
                                            <a href="{{ route('customer.edit', $customer->customer_id) }}"
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