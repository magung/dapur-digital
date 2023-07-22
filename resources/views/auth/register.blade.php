<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
    <link rel='icon' href='logo.png'>
    <title>Register</title>
</head>

<body>
    <div class="container mt-5 mb-5">

        <div class="row justify-content-center" style="margin-top: 150px">
            <div class="col-lg-6">
                <main class="form-registration">
                    <h1 class="h3 mb-3 fw-normal text-center">Register</h1>
                    <form action="/register" method="POST" enctype="multipart/form-data">
                        @csrf
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
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input id="nama" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" placeholder="name" required>

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
                                name="email" id="email" required value="{{ old('email') }}"
                                placeholder="name@example.com">
                            <!-- error message untuk email -->
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Nomor Hp / WA</label>
                            <input id="phone_number" type="text"
                                class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                value="{{ old('phone_number') }}" placeholder="62888888" required>

                            <!-- error message untuk phone_number -->
                            @error('phone_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select id="gender" name="gender"
                                class="form-control @error('gender') is-invalid @enderror" required>
                                <option value="Laki - Laki">Laki - Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>

                            <!-- error message untuk role -->
                            @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="store">Toko</label>
                            <select name="store" class="form-control" >
                                <option value="" >-- Toko --</option>
                                @foreach ($stores as $store)
                                    <option value="{{$store->store_id}}"  >{{$store->store_name}}</option>
                                @endforeach
                            </select>

                            <!-- error message untuk role -->
                            @error('store')
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
                        </div>

                        <div class="form-group">
                            <label for="birthday">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('birthday') is-invalid @enderror"
                                name="birthday" >
                            <!-- error message untuk role -->
                            @error('birthday')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"
                                class="form-control rounded-bottom @error('password') is-invalid @enderror"
                                name="password" id="password" required placeholder="Password">
                            <!-- error message untuk email -->
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <button class="w-100 btn btn-lg btn-danger mt-3" type="submit">Register</button>
                    </form>
                    <small class="d-block mt-3">Sudah memiliki akun? <a class="text-danger" href="/login">
                            Login
                            disini!</a></small>
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
