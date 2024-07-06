<x-admin>
    <div class="head-title">
        <div class="left">
            <h1>Tempat Inap</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Tempat Inap</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Dashboard</a>
                </li>
            </ul>
        </div>
        <a href="{{ route('admin.accommodations.create') }}" class="btn btn-lg btn-primary" style="font-size: 15px; font-weight: bold;">Tambah Data</a>
    </div>

    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Data Tempat Inap</h3>
                <form action="{{ route('admin.accommodations.index') }}" method="GET">
                    <div class="form-input" style="display: flex; align-items: center;">
                        <input type="search" name="search" placeholder="Search..." value="{{ $search ?? '' }}" style="padding: 10px; border: 1px solid #ccc; border-radius: 5px 0 0 5px; outline: none; flex: 1;">
                        <button type="submit" class="search-btn" style="background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 0 5px 5px 0; cursor: pointer;">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form>
            </div>

            <form action="{{ route('admin.accommodations.index') }}" method="GET" style="margin-bottom: 10px; display: flex; align-items: center;">
                <label for="pagesize" style="margin-right: 10px;">Page Size:</label>
                <select name="pagesize" id="pagesize" style="margin-right: 10px; border-radius:10px;">
                    <option value="10" {{ $pagesize == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $pagesize == 20 ? 'selected' : '' }}>20</option>
                    <option value="30" {{ $pagesize == 30 ? 'selected' : '' }}>30</option>
                </select>

            </form>





            <table>
                <thead>
                    <tr>
                        <th>No  </th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Rating</th>
                        <th>Harga /malam</th>
                        <th>Fasilitas Publik<br>Terdekat</th>
                        <th>Fasilitas Inap</th>
                        <th>Jarak Pusat <br> Kota /km</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accommodations as $index => $accommodation)
                    <tr>
                        <td>{{ $index +1 }}   .</td>
                        <td>{{ \Illuminate\Support\Str::limit($accommodation->name, 10) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($accommodation->address, 10) }}</td>
                        <td>{{ $accommodation->rating }}</td>
                        <td>{{ $accommodation->price }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($accommodation->name_facilities_public, 10) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($accommodation->name_facilities, 10) }}</td>
                        <td>{{ $accommodation->distance_to_city }}</td>
                        <td>
                            <a href="{{ route('admin.accommodations.show', $accommodation->id) }}" class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ route('admin.accommodations.edit', $accommodation->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.accommodations.destroy', $accommodation->id) }}" method="POST" class="delete-form" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger delete-button">Hapus</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="display: flex; justify-content: center; margin-top:30px;">
                <ul class="pagination">
                    <!-- Tautan "Previous" -->
                    @if ($accommodations->previousPageUrl())
                        <li class="page-item"><a class="page-link" href="{{ $accommodations->previousPageUrl() }}&pagesize={{ $pagesize }}">Previous</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                    @endif

                    <!-- Nomor halaman -->
                    @foreach ($accommodations->getUrlRange(max($accommodations->currentPage() - 2, 1), min($accommodations->lastPage(), $accommodations->currentPage() + 2)) as $page => $url)
                        @if ($page == $accommodations->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}&pagesize={{ $pagesize }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    <!-- Tautan "Next" -->
                    @if ($accommodations->nextPageUrl())
                        <li class="page-item"><a class="page-link" href="{{ $accommodations->nextPageUrl() }}&pagesize={{ $pagesize }}">Next</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                    @endif
                </ul>
            </div>



        </div>
    </div>


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
            });


            document.addEventListener('DOMContentLoaded', function() {
                const pageSizeSelect = document.getElementById('pagesize');

                // Tangani perubahan pada dropdown 'Page Size'
                pageSizeSelect.addEventListener('change', function(event) {
                    // Perbarui URL dengan parameter 'pagesize'
                    const pageSize = pageSizeSelect.value;
                    const currentUrl = new URL(window.location.href);
                    currentUrl.searchParams.set('pagesize', pageSize);
                    window.location.href = currentUrl.toString();
                });
            });


     </script>
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = button.closest('.delete-form');

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Data ini akan dihapus dan tidak dapat dikembalikan!",
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
