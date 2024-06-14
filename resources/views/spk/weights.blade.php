<x-app-layout>
    <x-nav-spk/>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        } */

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

        form div {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            font-size: 16px;
            color: #555;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .btn-primary {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

    </style>
    <div class="container">
        <h2>Isi Bobot Kriteria</h2>
        <form action="{{ route('spk.storeWeights') }}" method="POST">
            @csrf
            <div>
                <label>Rating</label>
                <select name="weight_rating" required>
                    <option value="" disabled selected>Isikan Bobot</option>
                    <option value="1">Tidak Diprioritaskan</option>
                    <option value="2">Sedikit Diprioritaskan</option>
                    <option value="3">Cukup Diprioritaskan</option>
                    <option value="4">Diprioritaskan</option>
                    <option value="5">Sangat Diprioritaskan</option>
                </select>
            </div>
            <div>
                <label>Harga</label>
                <select name="weight_price" required>
                    <option value="" disabled selected>Isikan Bobot</option>
                    <option value="1">Tidak Diprioritaskan</option>
                    <option value="2">Sedikit Diprioritaskan</option>
                    <option value="3">Cukup Diprioritaskan</option>
                    <option value="4">Diprioritaskan</option>
                    <option value="5">Sangat Diprioritaskan</option>
                </select>
            </div>
            <div>
                <label>Jarak ke Destinasi</label>
                <select name="weight_distance" required>
                    <option value="" disabled selected>Isikan Bobot</option>
                    <option value="1">Tidak Diprioritaskan</option>
                    <option value="2">Sedikit Diprioritaskan</option>
                    <option value="3">Cukup Diprioritaskan</option>
                    <option value="4">Diprioritaskan</option>
                    <option value="5">Sangat Diprioritaskan</option>
                </select>
            </div>
            <div>
                <label>Jumlah Fasilitas Publik</label>
                <select name="weight_public_facilities" required>
                    <option value="" disabled selected>Isikan Bobot</option>
                    <option value="1">Tidak Diprioritaskan</option>
                    <option value="2">Sedikit Diprioritaskan</option>
                    <option value="3">Cukup Diprioritaskan</option>
                    <option value="4">Diprioritaskan</option>
                    <option value="5">Sangat Diprioritaskan</option>
                </select>
            </div>
            <div>
                <label>Jumlah Fasilitas</label>
                <select name="weight_facilities" required>
                    <option value="" disabled selected>Isikan Bobot</option>
                    <option value="1">Tidak Diprioritaskan</option>
                    <option value="2">Sedikit Diprioritaskan</option>
                    <option value="3">Cukup Diprioritaskan</option>
                    <option value="4">Diprioritaskan</option>
                    <option value="5">Sangat Diprioritaskan</option>
                </select>
            </div>
            <div>
                <label>Jarak ke Kota</label>
                <select name="weight_distance_to_city" required>
                    <option value="" disabled selected>Isikan Bobot</option>
                    <option value="1">Tidak Diprioritaskan</option>
                    <option value="2">Sedikit Diprioritaskan</option>
                    <option value="3">Cukup Diprioritaskan</option>
                    <option value="4">Diprioritaskan</option>
                    <option value="5">Sangat Diprioritaskan</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Selanjutnya</button>
        </form>
    </div>
</x-app-layout>
