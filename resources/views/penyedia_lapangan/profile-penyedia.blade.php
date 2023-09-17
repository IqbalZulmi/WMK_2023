@extends('html.html')

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">
@endpush

@push('js')
    <script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>
    <script>
        dselect(document.querySelector('#dselect-example'))
    </script>
@endpush

@section('content')

    @include('components.header')

    @include('components.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboardPage') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="{{ $dataProfile->foto ? asset('storage/'.$dataProfile->foto) : asset('assets/img/user.png') }}" alt="Profile" class="rounded-circle">
                            <h2 class="text-capitalize">{{ $dataProfile->nama_bisnis }}</h2>
                            <h3 class="text-capitalize">{{ $dataProfile->user->role }} lapangan</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Ringkasan</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Rekening</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Kata Sandi</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Profile Details</h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama Bisnis</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->nama_bisnis }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->user->email }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Bank</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->rekening->daftar_bank->nama_bank ?? "belum menambahkan rekening" }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nomor Rekening</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->rekening->no_rekening ?? "belum menambahkan rekening" }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nama Rekening</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->rekening->nama_rekening ?? "belum menambahkan rekening" }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Alamat</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->alamat }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Jam Buka</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->jam_buka }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Jam Tutup</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->jam_tutup }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nomor Handpone</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->no_hp }}</div>
                                    </div>

                                    <h5 class="card-title">Deskripsi Lapangan</h5>
                                    <p>
                                        @if ($dataProfile->deskripsi_lapangan == null)
                                            Dapat diisi dengan deskripsi lapangan,peraturan lapangan dan fasilitas lapangan
                                        @else
                                        {!! $dataProfile->deskripsi_lapangan !!}
                                        @endif
                                    </p>
                                </div>
                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <!-- Profile Edit Form -->
                                    <form action="{{ route('updateProfilePenyedia',['id_user' => $dataProfile->id_user]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('put')
                                        <div class="row mb-3">
                                            <label for="fotoProfil" class="col-md-4 col-lg-3 col-form-label">Foto Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="foto" type="file" class="form-control mt-2 @error('foto') is-invalid @enderror">
                                                @error('foto')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nama_bisnis" class="col-md-4 col-lg-3 col-form-label">Nama Bisnis</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nama_bisnis" type="text" class="form-control @error('nama_bisnis') is-invalid @enderror" value="{{ $dataProfile->nama_bisnis }}" required>
                                                @error('nama_bisnis')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="hidden" name="old_email" value="{{ $dataProfile->user->email }}">
                                                <input name="email" class="form-control @error('email') is-invalid @enderror" type="email" value="{{ old('email', $dataProfile->user->email) }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="alamat" class="col-md-4 col-lg-3 col-form-label">alamat</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $dataProfile->alamat) }}</textarea>
                                                @error('alamat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jam_buka" class="col-md-4 col-lg-3 col-form-label">Jam Buka</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="jam_buka" type="time" class="form-control @error('jam_buka') is-invalid @enderror" value="{{ old('jam_buka', $dataProfile->jam_buka) }}" required>
                                                @error('jam_buka')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jam_tutup" class="col-md-4 col-lg-3 col-form-label">Jam Tutup</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="jam_tutup" type="time" class="form-control @error('jam_tutup') is-invalid @enderror" value="{{ old('jam_tutup', $dataProfile->jam_tutup) }}" required>
                                                @error('jam_tutup')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="no_hp" class="col-md-4 col-lg-3 col-form-label">Nomor Handphone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror"  value="{{ old('no_hp', $dataProfile->no_hp) }}" required>
                                                @error('no_hp')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="deskripsi_lapangan" class="col-md-4 col-lg-3 col-form-label">Deskripsi Lapangan</label>
                                            <div class="quill-editor-full">
                                                {!! $dataProfile->deskripsi_lapangan !!}
                                            </div>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="deskripsi_lapangan" type="hidden" class="form-control @error('deskripsi_lapangan') is-invalid @enderror" id="deskripsi_lapangan" value="{{ old('deskripsi_lapangan', $dataProfile->deskripsi_lapangan) }}">
                                                @error('deskripsi_lapangan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-main">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                </div>
                                <div class="tab-pane fade pt-3" id="profile-settings">
                                    <!-- Rekening Form -->
                                    <form action="{{ route('updateRekening',['id_penyedia_lapangan' => $dataProfile->id]) }}" method="POST">
                                        @csrf @method('put')
                                        <div class="row mb-3">
                                            <label for="kode_bank" class="col-md-4 col-lg-3 col-form-label">Nama Bank</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select name="kode_bank" id="dselect-example" class="form-select @error('kode_bank') is-invalid @enderror" data-dselect-search="true" data-dselect-clearable="true" data-dselect-max-height="300px" required>
                                                    <option value="">Pilih Bank</option>
                                                    @foreach ($daftarBank as $index => $data)
                                                    <option value="{{ $data->kode_bank }}" @if (($dataProfile->rekening->kode_bank ?? '') == $data->kode_bank) selected @endif>{{ $data->nama_bank }}</option>
                                                    @endforeach
                                                </select>
                                                @error('kode_bank')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="no_rekening" class="col-md-4 col-lg-3 col-form-label">Nomor Rekening</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="no_rekening" type="text" class="form-control @error('no_rekening') is-invalid @enderror" value="{{ old('no_rekening', $dataProfile->rekening->no_rekening ?? '') }}" required>
                                                @error('no_rekening')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nama_rekening" class="col-md-4 col-lg-3 col-form-label">Nama Rekening</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nama_rekening" type="text" class="form-control @error('nama_rekening') is-invalid @enderror" value="{{ old('nama_rekening', $dataProfile->rekening->nama_rekening ?? '') }}" required>
                                                @error('nama_rekening')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-center">
                                        <button type="submit" class="btn btn-main">Save Changes</button>
                                        </div>
                                    </form><!-- End settings Form -->
                                </div>
                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form action="{{ route('updateKataSandi',['id_user' => $dataProfile->id_user]) }}" method="post">
                                        @csrf @method('put')
                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Kata Sandi Sekarang</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_lama" type="password" class="form-control @error('password_lama') is-invalid @enderror" value="{{ old('password_lama') }}" required>
                                                @error('password_lama')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Kata Sandi</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_baru" type="password" class="form-control @error('password_baru') is-invalid @enderror" value="{{ old('password_baru') }}" required>
                                                @error('password_baru')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Ulangi Kata Sandi Baru</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="konf_password" type="password" class="form-control @error('konf_password') is-invalid @enderror" value="{{ old('konf_password') }}" required>
                                                @error('konf_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-main">Ubah Kata Sandi</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    @include('components.footer')
@endsection
