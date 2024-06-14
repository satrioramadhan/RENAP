<section class="top-bar animated-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="/">
                        <img src="../images/logoo.png" style="width: 40px; margin-top:-10;" alt="logo">
                    </a>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#works">Daftar Inap</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('spk.index') }}">SPK Renap</a>
                            </li>
                            @auth
                                @if (Auth::user()->is_admin)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Renap</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            @guest
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link"><i class="bi bi-box-arrow-right"></i> Login</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit User</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-left"></i>  Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>

                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
