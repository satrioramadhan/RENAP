<x-login.app>
    <div class="auth-container">
        <div class="back-button">
            <a href="/" class="btn-back"><i class="bi bi-arrow-return-left"></i> Back</a>
        </div>
        <div>
            <img src="https://newoldstamp.com/system/posts/twitter_images/000/000/298/original/Images_in_Email_Everything_You_Need_to_Know_and_Even_More_-_Twitter.png?1592831717" alt="Verify Image">
        </div>
        <div class="verification-container">
            <h1>Email Verifikasi</h1>
            <p>Silahkan verifikasi email anda dengan mengklik link yang telah kami kirimkan ke email anda. Jika belum menerima email, klik tombol di bawah ini untuk mengirim ulang email verifikasi.</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary" id="resend-button" disabled>Kirim Ulang Verifikasi Email</button>
            </form>

            <script>
                let resendButton = document.getElementById('resend-button');
                let countdown = 30;

                let interval = setInterval(function() {
                    if (countdown > 0) {
                        resendButton.innerText = `Kirim Ulang Verifikasi Email (${countdown--} detik)`;
                    } else {
                        clearInterval(interval);
                        resendButton.removeAttribute('disabled');
                        resendButton.innerText = "Kirim Ulang Verifikasi Email";
                    }
                }, 1000);
            </script>
        </div>
    </div>
</x-login.app>
