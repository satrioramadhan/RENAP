<x-app-layout>
    <x-nav-spk/>
    <style>

    .container {
            /* max-width: 600px; */
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        }

    .container h2 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
        }
    .btn-primary {
        margin-top: 20px;
    }

    .container h1 {
        margin-bottom: 30px;
    }

    </style>
    <div class="container">
        <h1>Masukkan Jarak Destinasi</h1>
        <p>Kamu bisa mengisi jarak destinasi yang ingin kamu kunjungi dari tempat penginapan yang kamu pilih, atau kamu juga bisa mengisi jarak dari titik lokasi kamu sekarang ini dengan penginapan yang ingin kamu pilih. isikan jarak dengan satuan kilometer(km), sesuaikan dengna kebutuhan kamu ^^</p>
        <form action="{{ route('spk.storeDistance') }}" method="POST">
            @csrf
            @foreach($accommodations as $accommodation)
                <div class="form-group">
                    <label for="distance_{{ $accommodation->id }}">{{ $accommodation->name }}</label>
                    <input type="number" name="distances[]" class="form-control" id="distance_{{ $accommodation->id }}" required>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Selanjutnya</button>
        </form>
    </div>
</x-app-layout>
