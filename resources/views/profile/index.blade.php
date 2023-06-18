<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5 mb-5">
        <h1 class="display-4">
            Profile
        </h1>
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
                        <form action="{{ route('profile.update', $profile->user_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $profile->name) }}" required>

                                <!-- error message untuk name -->
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email / Username</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $profile->email) }}" required readonly>

                                <!-- error message untuk email -->
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone_number">Nomor Hp / WA</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                    name="phone_number" value="{{ old('phone_number', $profile->phone_number) }}" required>

                                <!-- error message untuk phone_number -->
                                @error('phone_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select name="gender" class="form-control" required>
                                    <option value="Laki - Laki" {{$profile->gender == 'Laki - Laki' ? 'selected' : ''}}>Laki - Laki</option>
                                    <option value="Perempuan" {{$profile->gender == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                                </select>

                                <!-- error message untuk role -->
                                @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select name="role_id" class="form-control" required>
                                    <option value="" >-- role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->role_id}}" {{$profile->role_id ==  $role->role_id ? 'selected' : ''}}>{{$role->role_name}}</option>
                                    @endforeach
                                </select>

                                <!-- error message untuk role -->
                                @error('role_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea
                                    name="address" id="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    rows="5"
                                    required>{{ old('address', $profile->address) }}</textarea>

                                <!-- error message untuk address -->
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="store_id">Toko</label>
                                <select name="store_id" class="form-control" required>
                                    <option value="" >-- Toko --</option>
                                    @foreach ($stores as $store)
                                        <option value="{{$store->store_id}}" {{$profile->store_id == $store->store_id ? 'selected' : ''}} >{{$store->store_name}}</option>
                                    @endforeach
                                </select>

                                <!-- error message untuk role -->
                                @error('store_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="birthday">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('birthday') is-invalid @enderror"
                                    name="birthday" value="{{ old('birthday', $profile->birthday) }}" >
                                <!-- error message untuk role -->
                                @error('birthday')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" value="{{ old('password') }}" >

                                <!-- error message untuk password -->
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="photo">Foto User</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                    name="photo" value="{{ old('photo') }}" >

                                <!-- error message untuk photo -->
                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <img src="/uploads/{{$profile->photo}}" alt="" width="200">
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Update</button>
                            <a href="/" class="btn btn-md btn-secondary">back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- include summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 250, //set editable area's height
            });
        })
    </script>
</body>

</html>