<x-app-layout>
    <x-nav-spk/>
    <style>
        .card {
            margin-bottom: 20px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .btn-primary {
            margin-top: 20px;
            text-decoration: none;
        }

        .container h1 {
            margin-bottom: 30px;
        }

        .error-message {
            color: red;
            margin-bottom: 20px;
        }

    </style>
    <div class="container">
        <h1>Pilih Penginapan</h1>

        <form id="accommodation-form" action="{{ route('spk.choose') }}" method="POST">
            @csrf
            <div class="row">
                @foreach($accommodations as $accommodation)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ $accommodation->image_url }}" class="card-img-top" alt="{{ $accommodation->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $accommodation->name }}</h5>
                                <input type="checkbox" name="accommodations[]" value="{{ $accommodation->id }}"> Pilih
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="error-message" class="error-message" style="display:none;">
                Wajib memilih lebih dari 3 dan maksimal 5
            </div>
            <button type="submit" class="btn btn-primary">Selanjutnya</button>
        </form>
    </div>
    <script>
        document.getElementById('accommodation-form').addEventListener('submit', function(event) {
            const checkboxes = document.querySelectorAll('input[name="accommodations[]"]:checked');
            const errorMessage = document.getElementById('error-message');
            if (checkboxes.length < 3 || checkboxes.length > 5) {
                event.preventDefault();
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        });
    </script>
</x-app-layout>
