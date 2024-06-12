<!-- resources/views/components/admin/accommodation/form.blade.php -->
@props(['action', 'method' => 'POST', 'accommodation' => null])

<form action="{{ $action }}" method="POST">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="form-group">
        <label for="name">Nama:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $accommodation->name ?? '') }}" required>
    </div>
    <div class="form-group">
        <label for="image_url">URL Gambar:</label>
        <input type="text" class="form-control" id="image_url" name="image_url" value="{{ old('image_url', $accommodation->image_url ?? '') }}" required>
        @if ($errors->has('image_url'))
            <div class="text-danger">{{ $errors->first('image_url') }}</div>
        @endif
    </div>
    <div class="form-group">
        <label for="url_gmaps">URL Google Maps:</label>
        <input type="text" class="form-control" id="url_gmaps" name="url_gmaps" value="{{ old('url_gmaps', $accommodation->url_gmaps ?? '') }}" required>
        @if ($errors->has('url_gmaps'))
            <div class="text-danger">{{ $errors->first('url_gmaps') }}</div>
        @endif
    </div>
    <div class="form-group" style="margin-top:10px;">
        <label for="address">Alamat:</label>
        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $accommodation->address ?? '') }}" required>
    </div>
    <div class="form-group" style="margin-top:10px;">
        <label for="rating">Rating:</label>
        <input type="number" class="form-control" id="rating" name="rating" value="{{ old('rating', $accommodation->rating ?? '') }}" step="0.1" required>
    </div>
    <div class="form-group" style="margin-top:10px;">
        <label for="price">Harga /malam (contoh: 100000):</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $accommodation->price ?? '') }}" required>
    </div>
    <div class="form-group" style="margin-top:10px;">
        <label for="public_facilities">Jumlah Fasilitas Publik Terdekat (dalam bentuk angka):</label>
        <input type="number" class="form-control" id="public_facilities" name="public_facilities" value="{{ old('public_facilities', $accommodation->public_facilities ?? '') }}" required>
    </div>
    <div class="form-group" style="margin-top:10px;">
        <label for="name_facilities_public">Nama Fasilitas Publik Terdekat (Swalayan, Stasiun, dll):</label>
        <input type="text" class="form-control" id="name_facilities_public" name="name_facilities_public" value="{{ old('name_facilities_public', $accommodation->name_facilities_public ?? '') }}" required>
    </div>
    <div class="form-group" style="margin-top:10px;">
        <label for="facilities">Jumlah Fasilitas Inap (dalam bentuk angka):</label>
        <input type="number" class="form-control" id="facilities" name="facilities" value="{{ old('facilities', $accommodation->facilities ?? '') }}" required>
    </div>
    <div class="form-group" style="margin-top:10px;">
        <label for="name_facilities">Nama Fasilitas Inap (Kolam renang, Caffe, dll):</label>
        <input type="text" class="form-control" id="name_facilities" name="name_facilities" value="{{ old('name_facilities', $accommodation->name_facilities ?? '') }}" required>
    </div>
    <div class="form-group" style="margin-bottom:20px; margin-top:10px;">
        <label for="distance_to_city">Jarak Pusat Kota (km):</label>
        <input type="number" class="form-control" id="distance_to_city" name="distance_to_city" value="{{ old('distance_to_city', $accommodation->distance_to_city ?? '') }}" required>
    </div>
    <button type="submit" class="btn btn-primary">{{ $method === 'POST' ? 'Tambah' : 'Update' }}</button>
</form>

