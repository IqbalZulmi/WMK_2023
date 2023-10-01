@extends('html.html')

@section('content')

    @include('components.header')

    @include('components.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('superadminDashboardPage') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">Superadmin</li>
                    <li class="breadcrumb-item active">Kata Sandi</li>
                </ol>
            </nav>
        </div>

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="{{ asset('assets/img/user.png') }}" alt="Profile" class="rounded-circle">
                            <h2 class="text-capitalize">{{ Auth::user()->email }}</h2>
                            <h3 class="text-capitalize">{{ Auth::user()->role }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Kata Sandi</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form action="{{ route('updateKataSandi',['id_user' => Auth::user()->id]) }}" method="post">
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
