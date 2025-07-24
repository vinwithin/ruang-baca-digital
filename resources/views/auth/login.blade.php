<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Ruang Baca</title>
</head>

<body>
    <div class="wrapper  d-flex flex-column  align-items-center">

        <div class="container d-flex flex-column justify-content-center align-items-center mt-5 pt-5 gap-5">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1>
                    RUANG BACA DIGITAL
                </h1>
                <h1>
                    FAKULTAS SAINS DAN TEKNOLOGI
                </h1>
            </div>

            <div class="card shadow-lg p-5 " style="border-radius: 20px;">
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body" >
                    <h4 class="text-center fw-bold fs-2 ">Masuk ke akun anda</h4>
                    <form method="POST" class="pt-4 px-4 mx-auto w-100" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Input -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Nama Pengguna atau NIM</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Masukkan Nama Pengguna atau NIM" required>

                                <span class="input-group-text">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                            </div>
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Password Input -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Masukkan Kata Sandi" required>
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Remember Me Checkbox -->
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-custom w-100 mt-3">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="overlay-img">
            <img class="vektor-atas" src="/assets/vektor-login.svg" alt="">
            <img class="vektor-bawah" src="/assets/vektor-login1.svg" alt="">
        </div>

    </div>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"
        integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous">
    </script>
</body>

</html>
