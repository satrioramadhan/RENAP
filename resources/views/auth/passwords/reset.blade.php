<x-login.app>
    <div class="auth-container">
        <div>
            <img src="https://i.pinimg.com/564x/7b/5f/25/7b5f2558a8f6d14300e3f7190dc18a67.jpg" alt="Reset Password Image">
        </div>
        <div class="auth-form">
            <h2 class="form-title">Buat Password Baru</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request('email') }}">
                <div class="form-group position-relative">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    <i class="bi bi-eye-slash position-absolute" id="togglePassword" style="cursor: pointer; right: 10px; top: 38px;"></i>
                </div>
                <div class="form-group position-relative">
                    <label for="password_confirmation">Masukan Password Lagi</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    <i class="bi bi-eye-slash position-absolute" id="toggleConfirmPassword" style="cursor: pointer; right: 10px; top: 38px;"></i>
                </div>
                <div class="form-button">
                    <input type="submit" value="Simpan Password" class="btn btn-primary">
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
