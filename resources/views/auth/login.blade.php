<x-login.app>
    <div class="auth-container">
        <div class="back-button">
            <a href="/" class="btn-back"><i class="bi bi-arrow-return-left"></i> Kembali</a>
        </div>
        <div>
            <img src="https://media.istockphoto.com/id/1281150061/id/vektor/daftar-akun-kirimkan-akses-login-password-username-internet-online-situs-web-konsep-vektor.jpg?s=612x612&w=0&k=20&c=eb9xHZN7_UyP9jJTLL4bc0OvYDFdkERf5RTBtIY6_0w=" alt="Login Image">
        </div>
        <div class="auth-form">
            <h2 class="form-title">Login</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="form-group position-relative">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    <i class="bi bi-eye-slash position-absolute" id="togglePassword" style="cursor: pointer; right: 10px; top: 38px;"></i>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <a href="{{ route('password.request') }}" class="forgot-password">Lupa Password?</a>
                </div>
                <div class="form-button">
                    <input type="submit" value="Login" class="btn btn-primary">
                </div>
                <div class="social-login">
                    <span class="social-label">Atau login dengan</span>
                    <ul class="socials">
                        <li><a href=""><i class="bi bi-google"></i></a></li>
                        <!-- Add other social login icons here -->
                    </ul>
                </div>
                <div class="signup-link">
                    <span>Belum punya akun? <a href="{{ route('register') }}">Buat akun</a></span>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            var passwordInput = document.getElementById('password');
            var icon = this;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    </script>
</x-login.app>
