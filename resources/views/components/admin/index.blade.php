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
    </script>

</body>
</html>
