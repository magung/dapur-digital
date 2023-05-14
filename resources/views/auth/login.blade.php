<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
    <link rel='icon' href='logo.png'>
    <title>Login</title>
</head>

<body>
    <div class="container">

        <div class="row justify-content-center" style="margin-top: 150px">
            <div class="col-lg-6">
                <main class="form-registration">
                    <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
                    <form action="/login" method="POST">
                        @csrf
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
                        <div class="form-floating">
                            <input type="text" class="form-control " name="email" id="email" required
                                value="{{ old('email') }}" placeholder="name@example.com">
                            <label for="email">Email / Username</label>
                        </div>
                        <br>
                        <div class="form-floating">
                            <input type="password" class="form-control rounded-bottom" name="password" id="password"
                                required placeholder="Password">
                            <label for="password">Password</label>
                        </div>
    
                        <button class="w-100 btn btn-lg btn-danger mt-3" type="submit">Login</button>
                    </form>
                    <small class="d-block mt-3">Belum memiliki akun? <a class="text-danger" href="/register">
                            Register
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
