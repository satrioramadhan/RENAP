<x-admin>
    <div class="head-title">
        <div class="left">
            <h1>Detail Data User</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">User</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Detail Data User</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>{{ $user->name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Admin:</strong> {{ $user->is_admin ? 'Yes' : 'No' }}</p>
                <p><strong>Bergabung:</strong> {{ $user->created_at->format('d-m-Y') }}</p>
                <p><strong>Data Update:</strong> {{ $user->updated_at->format('d-m-Y') }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</x-admin>
