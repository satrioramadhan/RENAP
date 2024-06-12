<!-- resources/views/view-admin/show.blade.php -->
<x-admin>
    <div class="head-title">
        <div class="left">
            <h1>Detail Tempat Inap</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Detail Tempat Inap</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>{{ $accommodation->name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>URL Gambar:</strong> {{ $accommodation->image_url }}</p>
                <p><strong>URL Google Maps:</strong> <a href="{{ $accommodation->url_gmaps }}">{{ $accommodation->url_gmaps }}</a></p>
                <p><strong>Alamat:</strong> {{ $accommodation->address }}</p>
                <p><strong>Rating:</strong> {{ $accommodation->rating }}</p>
                <p><strong>Harga per malam:</strong> {{ $accommodation->price }}</p>
                <p><strong>Jumlah Fasilitas Publik Terdekat:</strong> {{ $accommodation->public_facilities }}</p>
                <p><strong>Nama Fasilitas Publik terdekat:</strong> {{ $accommodation->name_facilities_public }}</p>
                <p><strong>Jumlah Fasilitas Inap:</strong> {{ $accommodation->facilities }}</p>
                <p><strong>Nama Fasilitas Inap:</strong> {{ $accommodation->name_facilities }}</p>
                <p><strong>Jarak ke Pusat Kota (km):</strong> {{ $accommodation->distance_to_city }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.accommodations.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</x-admin>
