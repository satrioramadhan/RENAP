<x-login.app>
    <div class="auth-container">
        <div>
            <img src="https://jurnal.iicet.org/plugins/themes/titanTheme/images/login.webp" alt="Register Image">
        </div>
        <div class="auth-form">
            <h2 class="form-title">Register</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="form-group position-relative">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    <i class="bi bi-eye-slash position-absolute" id="togglePassword" style="cursor: pointer; right: 10px; top: 38px;"></i>
                </div>
                <div class="form-group position-relative">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    <i class="bi bi-eye-slash position-absolute" id="toggleConfirmPassword" style="cursor: pointer; right: 10px; top: 38px;"></i>
                </div>
                <div class="form-button">
                    <input type="submit" value="Register" class="btn btn-primary">
                </div>
                <div class="signup-link">
                    <span>Already have an account? <a href="{{ route('login') }}">Login</a></span>
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

        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            var passwordInput = document.getElementById('password_confirmation');
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
