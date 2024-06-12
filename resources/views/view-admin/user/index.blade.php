<x-admin>
    <div class="head-title">
        <div class="left">
            <h1>Users</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Home</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Data User</h3>
                <form action="{{ route('admin.users.index') }}" method="GET">
                    <div class="form-input" style="display: flex; align-items: center;">
                        <input type="search" name="search" placeholder="Search..." value="{{ $search ?? '' }}" style="padding: 10px; border: 1px solid #ccc; border-radius: 5px 0 0 5px; outline: none; flex: 1;">
                        <button type="submit" class="search-btn" style="background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 0 5px 5px 0; cursor: pointer;">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form>
            </div>

            <form action="{{ route('admin.users.index') }}" method="GET" style="margin-bottom: 20px; display: flex; align-items: center;">
                <label for="pagesize" style="margin-right: 10px;">Page Size:</label>
                <select name="pagesize" id="pagesize" style="margin-right: 10px;  border-radius:10px;">
                    <option value="10" {{ $pagesize == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $pagesize == 20 ? 'selected' : '' }}>20</option>
                    <option value="30" {{ $pagesize == 30 ? 'selected' : '' }}>30</option>
                </select>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Tanggal Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}.</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($user->email, 10)}}</td>
                        <td >{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                        <td>{{ $user->created_at->locale('id')->diffForHumans() }}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-sm btn-toggle-admin" data-user-id="{{ $user->id }}" style="background-color: {{ $user->is_admin ? '#ff0000' : '#007bff' }}; color: white; min-width:150px;">
                                    {{ $user->is_admin ? 'Hapus Admin' : 'Tambah Admin' }}
                                </button>
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="delete-form" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger delete-btn">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="display: flex; justify-content: center; margin-top:30px;">
                <ul class="pagination">
                    <!-- Tautan "Previous" -->
                    @if ($users->previousPageUrl())
                        <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}&pagesize={{ $pagesize }}">Previous</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                    @endif

                    <!-- Nomor halaman -->
                    @foreach ($users->getUrlRange(max($users->currentPage() - 2, 1), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                        @if ($page == $users->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}&pagesize={{ $pagesize }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    <!-- Tautan "Next" -->
                    @if ($users->nextPageUrl())
                        <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}&pagesize={{ $pagesize }}">Next</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <style>
        .action-buttons {
            display: flex;
            /* justify-content: space-between; */
            gap: 10px;

        }

        .action-buttons .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px 10px;
            font-size: 0.875rem;
            border-radius: 5px;
        }

        .btn-toggle-admin {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-danger {
            background-color: #ff0000;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>

    <!-- Tambahkan SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            const searchForm = searchInput.closest('form');

            searchInput.addEventListener('input', function(event) {
                if (searchInput.value.trim() === '') {
                    searchForm.submit();
                }
            });

            searchForm.addEventListener('submit', function(event) {
                if (searchInput.value.trim() === '') {
                    event.preventDefault();
                    console.log("Menampilkan semua data karena input kosong.");
                }
            });

            const pageSizeSelect = document.getElementById('pagesize');
            pageSizeSelect.addEventListener('change', function(event) {
                const pageSize = pageSizeSelect.value;
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('pagesize', pageSize);
                window.location.href = currentUrl.toString();
            });

            const toggleAdminButtons = document.querySelectorAll('.btn-toggle-admin');
            toggleAdminButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    const userId = button.getAttribute('data-user-id');
                    fetch(`/admin/users/${userId}/toggle-admin`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            button.innerText = data.is_admin ? 'Hapus Admin' : 'Tambah Admin';
                            button.style.backgroundColor = data.is_admin ? '#ff0000' : '#007bff';
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });

            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    const form = button.closest('form');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda tidak dapat mengembalikan tindakan ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-admin>
