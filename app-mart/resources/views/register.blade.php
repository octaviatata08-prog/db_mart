<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { margin: 0; background-color: #f8f9fa; font-family: sans-serif; }
        .full-screen-container {
            min-height: 100vh; /* FULL SCREEN */
            display: flex; align-items: center; justify-content: center; padding: 20px;
        }
        .register-card {
            width: 100%; max-width: 450px; border: none; border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); background: #fff;
        }
        .btn-register { width: 100%; background-color: #343a40; border: none; padding: 12px; font-weight: bold; }
        .btn-register:hover { background-color: #212529; }
    </style>
</head>
<body>
    <div class="full-screen-container">
        <div class="card register-card">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h4 class="fw-bold">Daftar Akun Baru</h4>
                </div>

                <!-- PENTING: Action diisi dengan route('register') -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-dark btn-register">REGISTER</button>

                    <div class="text-center mt-3">
                        <small>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>