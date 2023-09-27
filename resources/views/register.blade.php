@extends('html.html')

@section('content')
    <div class="container-fluid bg-white">
        <div class="row min-vh-100">
            <div class="col-lg-6 d-none d-lg-block">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="3000">
                            <img src="{{ asset('assets/img/c7.jpg') }}" class="d-block w-100" alt="Image 1">
                            <div class="spasi-atas">
                                <h5>Kelola lapanganmu di SportsCamp!</h5>
                                <p>ayo Kelola informasi dan status lapangan milikmu disini!</p>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="{{ asset('assets/img/c10.jpg') }}" class="d-block w-100" alt="Image 2">
                            <div class="spasi-atas">
                                <h5>Atur Jadwalnya</h5>
                                <p>perbanyak jadwalnya, semakin banyak pertandingannya!</p>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="{{ asset('assets/img/c9.jpg') }}" class="d-block w-100" alt="Image 3">
                            <div class="spasi-atas">
                                <h5>pemesanan dan konfirmasi!</h5>
                                <p>pantau pemesanannya, konfirmasi secepatnya!</p>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="{{ asset('assets/img/c11.jpg') }}" class="d-block w-100" alt="Image 3">
                            <div class="spasi-atas">
                                <h5>Promosikanlah!</h5>
                                <p>berikan potongan harga hanya di SportsCamp!</p>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="{{ asset('assets/img/c12.jpg') }}" class="d-block w-100" alt="Image 3">
                            <div class="spasi-atas">
                                <h5>Cek laporan keuangamu di SportsCamp!</h5>
                                <p>Jangan sungkan untuk melihat keuangmu!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex justify-content-center align-items-center main-color">
                <div class="scrollable-form">
                    <div>
                        <img src="{{ asset('assets/img/logo.png') }}" alt="SportsCamp Logo" class="my-3 mb-lg-3" style="width: 300px; display: block; margin-left: auto; margin-right: auto;">
                        <form action="{{ route('registerPenyedia') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-section">
                                <div class="mb-3">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email" required value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputPassword1" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputPasswordConfirm" class="form-label">Konfirmasi Password</label>
                                    <input name="konf_password" type="password" class="form-control @error('konf_password') is-invalid @enderror" placeholder="Konfirmasi Password" required>
                                    @error('konf_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="mb-3">
                                    <label for="inputBusinessName" class="form-label">Nama Bisnis</label>
                                    <input name="nama_bisnis" type="text" class="form-control @error('nama_bisnis') is-invalid @enderror" placeholder="Masukkan Nama Bisnis" required value="{{ old('nama_bisnis') }}">
                                    @error('nama_bisnis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputBusinessAddress" class="form-label">Alamat Bisnis</label>
                                    <textarea name="alamat" rows="4" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat Bisnis" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="openingTime" class="form-label">Jam buka</label>
                                    <input name="jam_buka" type="time" class="form-control @error('jam_buka') is-invalid @enderror" required value="{{ old('jam_buka') }}">
                                    @error('jam_buka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="closingTime" class="form-label">Jam Tutup</label>
                                    <input name="jam_tutup" type="time" class="form-control @error('jam_tutup') is-invalid @enderror" required value="{{ old('jam_tutup') }}">
                                    @error('jam_tutup')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputPhone" class="form-label">No Hp</label>
                                    <input name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Masukkan Nomor HP" required value="{{ old('no_hp') }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="fieldImage" class="form-label">Logo Bisnis</label>
                                    <input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" required>
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-navigation mb-3">
                                <button type="button" class="btn btn-secondary prev-step"><i class="bi bi-arrow-return-left"></i></button>
                                <button type="button" class="btn btn-success next-step"><i class="bi bi-arrow-return-right"></i></button>
                                <button type="submit" class="btn btn-success register-btn" style="display: none;">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mengatur navigasi formulir
        let currentSectionIndex = 0;
        const sections = document.querySelectorAll(".form-section");
        const prevButton = document.querySelector('.prev-step');
        const nextButton = document.querySelector('.next-step');

        // Fungsi untuk menampilkan bagian formulir
        function showSection(index) {
            sections[currentSectionIndex].classList.remove('current');
            sections[index].classList.add('current');
            currentSectionIndex = index;

            if (currentSectionIndex === 0) {
                prevButton.style.display = 'none';
            } else {
                prevButton.style.display = 'inline-block';
            }

            if (currentSectionIndex === sections.length - 1) {
                nextButton.style.display = 'none';
                document.querySelector('.register-btn').style.display = 'inline-block'; // Tampilkan tombol 'Daftar'
            } else {
                nextButton.style.display = 'inline-block';
                document.querySelector('.register-btn').style.display = 'none'; // Sembunyikan tombol 'Daftar'
            }
        }


        nextButton.addEventListener('click', function() {
            showSection(currentSectionIndex + 1);
        });

        prevButton.addEventListener('click', function() {
            showSection(currentSectionIndex - 1);
        });

        // Tampilkan bagian pertama formulir
        showSection(0);
    });
</script>
@endpush
