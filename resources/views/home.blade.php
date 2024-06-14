<x-app-layout>
    <x-navbar/>
    <x-slider/>
    <x-intro/>

    <section id="works" class="works">
        <div class="container">
            <div class="section-heading">
                <h1 class="title wow fadeInDown" data-wow-delay=".3s">Daftar Tempat Inap</h1>
            </div>
            <div class="row">
                {{-- Loop through each accommodation --}}
                @foreach($accommodations as $accommodation)
                    <div class="col-md-4 col-sm-6">
                        <figure class="wow fadeInLeft animated portfolio-item" data-wow-duration="500ms" data-wow-delay="0ms">
                            <div class="img-wrapper">
                                <img src="{{ $accommodation->image_url }}" class="img-fluid" alt="{{ $accommodation->name }}">
                                <div class="overlay">
                                    <div class="buttons">
                                        <h1 style="color: whitesmoke"><a href="{{ $accommodation->url_gmaps }}" target="blank"><i class='bx bxs-map'></i>{{ $accommodation->name }}</a></h1>
                                    </div>
                                </div>
                            </div>
                            <figcaption>
                                <h4>
                                    <a>{{ $accommodation->name }}</a>
                                </h4>
                                <br>
                                <p><strong>Alamat:</strong> {{ $accommodation->address }}</p>
                                <p><strong>Rating:</strong> {{ $accommodation->rating }}⭐</p>
                                <p><strong>Harga:</strong> Rp.{{ $accommodation->price }}</p>
                                <p><strong>Fasilitas Inap:</strong> {{ $accommodation->name_facilities }}</p>
                                <p><strong>Fasilitas Publik Terdekat:</strong> {{ $accommodation->name_facilities_public }}</p>
                                <p><strong>Jarak ke Kota:</strong> {{ $accommodation->distance_to_city }} km</p>

                            </figcaption>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <h2 class="title wow fadeInDown" data-wow-delay=".3s" data-wow-duration="500ms">SO, Mau Coba SPK renap?</h1>
                        <p class="wow fadeInDown" data-wow-delay=".5s" data-wow-duration="500ms">Pastikan kamu sudah mendaftar akun, jika belum kamu bisa melakukan registrasi.<a href="/login"  class="klik-disini"> Klik disini</a></p>
                        <a href="{{ route('spk.index') }}" class="btn btn-default btn-contact wow fadeInDown" data-wow-delay=".7s" data-wow-duration="500ms">Coba SPK</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-app-layout>
