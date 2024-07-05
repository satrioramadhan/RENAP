<x-app-layout>
    <x-nav-spk/>
    <style>
        .btn-primary {
            margin-top: 20px;
        }

        .btn-secondary {
            margin-top: 20px;
            background-color: #6c757d;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .container h1 {
            margin-bottom: 30px;
        }

        .table th, .table td {
            text-align: center;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

    </style>
    <div class="container">
        <h1>Hasil Perhitungan SPK</h1>
        <h2>Metode WP</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Rangking</th>
                    <th>Nama</th>
                    <th>Skor Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($finalScores as $index => $result)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->final_score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <h2>Metode SAW</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Rangking</th>
                    <th>Nama</th>
                    <th>Nilai Preferensi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sawResults as $index => $result)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->preference_value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}

        <div class="action-buttons">
            <form action="{{ route('spk.reset') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Mulai Menghitung SPK Lagi</button>
            </form>
                <a href="{{ route('home') }}" type="submit" class="btn-secondary">Kembali ke Home</a>
        </div>
    </div>
</x-app-layout>
