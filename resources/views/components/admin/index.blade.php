<!-- resources/views/components/admin/x-admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2"></script>
    <link rel="icon" href="{{ asset('images/logoo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <style>
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            max-width: 90%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .popup-content h2 {
            margin-top: 0;
        }

        .popup-content button {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup-content button:hover {
            background-color: #0056b3;
        }
    </style>

    <title>Admin Renap</title>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand" style="margin-left:50px; margin-top:10px">
            <img src="{{ asset('images/logoo.png') }}" style="width: 40px;" alt="">
            <span class="text" style="margin-top: 20px">Admin Renap</span>
        </a>
        <ul class="side-menu top">
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.accommodations.*') ? 'active' : '' }}">
                <a href="{{ route('admin.accommodations.index') }}">
                    <i class='bx bxs-hotel'></i>
                    <span class="text">Tempat Inap</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.users.*') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}">
                    <i class='bx bxs-group'></i>
                    <span class="text">User</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="/" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Kembali</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <!-- Your Navbar content -->
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            {{ $slot }}
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <!-- POPUP -->
    <div class="popup-overlay" id="mobile-popup" style="display: none;">
        <div class="popup-content">
            <h2>Hai, kamu masuk kesini pake hp ya?</h2><br>
            <p>Untuk fitur admin memang tidak mendukung tampilan mobile, kamu bakal temuin tampilan yang aneh kalo kamu membukanya di layar ukuran mobile. Karena di halaman ini banyak menyajikan data dan disini tempat untuk mengelola data. Jadi tidak disarankan untuk masuk dengan ukuran layar mobile. Lagian juga yang namanya admin itu harusnya pake ukuran layar desktop atau laptop wkwkwk</p>
            <h6>(👉ﾟヮﾟ)👉 👈(⌒▽⌒)👉 👈(ﾟヮﾟ👈)</h6>
            <button onclick="closePopup()">Tutup</button>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                title: 'Sukses!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        function closePopup() {
            document.getElementById('mobile-popup').style.display = 'none';
        }

        // Check if user is using a mobile device
        if (window.innerWidth <= 768) {
            document.getElementById('mobile-popup').style.display = 'flex';
        }
    </script>

</body>
</html>
