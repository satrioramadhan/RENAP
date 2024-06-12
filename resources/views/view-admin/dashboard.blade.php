<x-admin>
    <div class="head-title">
        <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>

    <ul class="box-info">
        <li>
            <i class='bx bxs-user'></i>
            <span class="text">
                <h3>{{ $totalUsers }}</h3>
                <p>User</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-hotel'></i>
            <span class="text">
                <h3>{{ $totalAccommodations }}</h3>
                <p>Tempat Inap</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-user-rectangle'></i>
            <span class="text">
                <h3>{{ $totalAdmins }}</h3>
                <p>User Admin</p>
            </span>
        </li>
    </ul>

    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>User Terbaru</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Bergabung</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newUsers as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="status {{ $user->is_admin ? 'pending' : 'completed' }}">
                                {{ $user->created_at->locale('id')->diffForHumans() }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
