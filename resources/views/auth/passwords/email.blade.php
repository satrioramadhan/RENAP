<x-login.app>
    <div class="auth-container">
        <div>
            <img src="https://i.pinimg.com/564x/fd/84/d4/fd84d4d8f5ba8f89638bbf309e986682.jpg" alt="Forgot Password Image">
        </div>
        <div class="auth-form">
            <h2 class="form-title">Lupa Password</h2>
            <p>Masukan email yang terdaftar pada akun kamu untuk menerima verifikasi reset password</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="form-button">
                    <input type="submit" value="Kirim Link Reset Password" class="btn btn-primary">
                </div>
            </form>
            <div class="back-to-login">
                <span>Udah ingat password kamu? <a href="{{ route('login') }}">Login</a></span>
            </div>
        </div>
    </div>
</x-login.app>
