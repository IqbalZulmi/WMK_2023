@extends('html.html')

@section('content')

    @include('components.header')

    @include('components.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Lapangan dan Jadwal</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardPage') }}">Home</a></li>
                    <li class="breadcrumb-item">Kelola</li>
                    <li class="breadcrumb-item active">Lapangan</li>
                    </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row mb-3">
                <div class="d-flex">
                    <button type="button" class="btn btn-main" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class="bi bi-plus-circle"></i> Tambah Lapangan
                    </button>
                </div>
            </div>
            <div class="row">
                @forelse ($dataLapangan as $index => $data)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ $data->foto_lapangan ? asset('storage/'.$data->foto_lapangan) : asset('assets/img/c7.jpg') }}" class="card-img-top object-fit-cover lapangan-img">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <p class="card-title blockquote fw-semibold">{{ $data->nama_lapangan }}</p>
                                    <p class="text-body-secondary blockquote-footer fw-semibold fst-italic">{{ $data->jenis_lapangan->jenis_lapangan }}</p>
                                </div>
                                <button type="button" class="btn btn-sm btn-main ms-auto" data-bs-toggle="modal" data-bs-target="#editLapanganModal{{ $data->id }}">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#hapusLapanganModal{{ $data->id }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                            <ul class="sidebar-nav">
                                <li class="nav-item">
                                    <a class="nav-link collapsed" data-bs-target="#jadwal{{ $index+1 }}" data-bs-toggle="collapse" href="#">
                                        <i class="bi bi-calendar-event"></i><span>Jadwal Lapangan</span><i class="bi bi-chevron-down ms-auto"></i>
                                    </a>
                                    <ul id="jadwal{{ $index+1 }}" class="nav-content collapse list-group" data-bs-parent="#sidebar-nav">
                                        @foreach ($data->jadwal_lapangan as $indexJadwal => $dataJadwal )
                                            <li class="list-group-item p-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    @if ($dataJadwal->status == 'tersedia')
                                                        <i class="bi bi-check-circle text-success me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Tersedia"></i>
                                                    @elseif ($dataJadwal->status == 'telah dipesan')
                                                        <i class="bi bi-exclamation-circle text-warning me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Telah Dipesan"></i>
                                                    @else
                                                        <i class="bi bi-x-circle me-2 text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Tidak Tersedia"></i>
                                                    @endif
                                                    {{ $dataJadwal->jam_mulai }} - {{ $dataJadwal->jam_selesai }}
                                                    <button type="button" class="btn btn-sm btn-main ms-auto" data-bs-toggle="modal" data-bs-target="#editJadwalModal{{ $dataJadwal->id }}">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#hapusJadwalModal{{ $dataJadwal->id }}">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </div>
                                                <div class="fw-semibold">
                                                    Rp. {{ number_format($dataJadwal->harga, 0, ',', '.') }},00
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('assets/img/not-available.svg') }}" alt="">
                        <h3 class="text-center text-capitalize text-success fw-semibold">Tidak ada data lapangan untuk ditampilkan!!</h3>
                    </div>
                </div>
                @endforelse
            </div>
        </section>
    </main>

    <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah Lapangan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambahLapangan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="inputBusinessName" class="form-label">Nama Lapangan</label>
                                    <input name="nama_lapangan" type="text" class="form-control @error('nama_lapangan') is-invalid @enderror" placeholder="Masukkan Nama Lapangan" value="{{ old('nama_lapangan') }}" required>
                                    @error('nama_lapangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputBusinessName" class="form-label">Jenis Lapangan</label>
                                    <select name="jenis_lapangan" class="form-select @error('jenis_lapangan') is-invalid @enderror" required>
                                        <option value="" disabled selected>Pilih jenis lapangan</option>
                                        @foreach ($jenisLapangan as $index => $data )
                                            <option value="{{ $data->id }}">{{ $data->jenis_lapangan }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_lapangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputBusinessName" class="form-label">Harga Lapangan per jam</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp.</span>
                                        <input name="harga_lapangan" type="text" onkeyup="formatInput(this)" onblur="formatValue(this)" class="form-control @error('harga_lapangan') is-invalid @enderror" placeholder="Masukkan harga per jam" value="{{ old('harga_lapangan') }}" required>
                                        @error('harga_lapangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <span class="input-group-text">,00</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputBusinessName" class="form-label">Foto Lapangan</label>
                                    <input name="foto_lapangan" type="file" class="form-control @error('foto_lapangan') is-invalid @enderror" required>
                                    @error('foto_lapangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-main">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($dataLapangan as $index => $dataModal )
        <div class="modal fade" id="editLapanganModal{{ $dataModal->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Lapangan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('editLapangan', ['id_lapangan' => $dataModal->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('put')
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="inputBusinessName" class="form-label">Nama Lapangan</label>
                                        <input name="nama_lapangan" type="text" class="form-control @error('nama_lapangan') is-invalid @enderror" placeholder="Masukkan Nama Lapangan" value="{{ old('nama_lapangan',$dataModal->nama_lapangan) }}" required>
                                        @error('nama_lapangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputBusinessName" class="form-label">Jenis Lapangan</label>
                                        <select name="jenis_lapangan" class="form-select @error('jenis_lapangan') is-invalid @enderror" required>
                                            <option value="" disabled>Pilih jenis lapangan</option>
                                            @foreach ($jenisLapangan as $index => $data )
                                                <option value="{{ $data->id }}" @if ($dataModal->id_jenis_lapangan == $data->id) selected @endif>{{ $data->jenis_lapangan }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_lapangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputBusinessName" class="form-label">Harga Lapangan per jam</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp.</span>
                                            <input name="harga_lapangan" type="text" class="form-control @error('harga_lapangan') is-invalid @enderror" onkeyup="formatInput(this)" onblur="formatValue(this)" placeholder="Masukkan harga per jam" value="{{ old('harga_lapangan') }}">
                                            @error('harga_lapangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <span class="input-group-text">,00</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputBusinessName" class="form-label">Foto Lapangan</label>
                                        <input name="foto_lapangan" type="file" class="form-control @error('foto_lapangan') is-invalid @enderror">
                                        @error('foto_lapangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-main">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="hapusLapanganModal{{ $dataModal->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Tambah Lapangan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-capitalize">
                            Apakah anda yakin ingin menghapus <span class="fw-bold text-danger">{{ $dataModal->nama_lapangan }} ?</span>
                        </h4>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('hapusLapangan',['id_lapangan' => $dataModal->id]) }}" method="POST">
                            @csrf @method('delete')
                            <button type="submit" class="btn btn-main">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($dataModal->jadwal_lapangan as $indexJadwalModal => $dataJadwalModal)
            <div class="modal fade" id="editJadwalModal{{ $dataJadwalModal->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Edit Jadwal Lapangan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('editJadwalLapangan', ['id_jadwal' => $dataJadwalModal->id]) }}" method="POST">
                                @csrf @method('put')
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="inputBusinessName" class="form-label">Jam Mulai</label>
                                            <input name="jam_mulai" type="time" class="form-control @error('jam_mulai') is-invalid @enderror" placeholder="Masukkan Nama Lapangan" value="{{ old('jam_mulai',$dataJadwalModal->jam_mulai) }}" required>
                                            @error('jam_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputBusinessName" class="form-label">Jam Selesai</label>
                                            <input name="jam_selesai" type="time" class="form-control @error('jam_selesai') is-invalid @enderror" placeholder="Masukkan Nama Lapangan" value="{{ old('jam_selesai',$dataJadwalModal->jam_selesai) }}" required>
                                            @error('jam_selesai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputBusinessName" class="form-label">Harga Lapangan</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input name="harga_lapangan" type="text" onkeyup="formatInput(this)" onblur="formatValue(this)" class="form-control @error('harga_lapangan') is-invalid @enderror" placeholder="Masukkan harga per jam" value="{{ old('harga_lapangan',$dataJadwalModal->harga) }}">
                                                @error('harga_lapangan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <span class="input-group-text">,00</span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputBusinessName" class="form-label">Jenis Lapangan</label>
                                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                                <option value="" disabled>Pilih status lapangan</option>
                                                <option value="tersedia" @if ($dataJadwalModal->status == 'tersedia') selected @endif>Tersedia</option>
                                                <option value="telah dipesan" @if ($dataJadwalModal->status == 'telah dipesan') selected @endif>Telah Dipesan</option>
                                                <option value="tidak tersedia" @if ($dataJadwalModal->status == 'tidak tersedia') selected @endif>Tidak Tersedia</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-main">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="hapusJadwalModal{{ $dataJadwalModal->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Tambah Lapangan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4 class="text-capitalize">
                                Apakah anda yakin ingin menghapus <span class="fw-bold text-danger">{{ $dataJadwalModal->jam_mulai }} - {{ $dataJadwalModal->jam_selesai }} ?</span>
                            </h4>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form action="{{ route('hapusJadwalLapangan',['id_jadwal' => $dataJadwalModal->id]) }}" method="POST">
                                @csrf @method('delete')
                                <button type="submit" class="btn btn-main">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach

    @include('components.footer')
@endsection

@push('js')
    <script>
        function formatInput(input) {
            // Menghapus semua karakter selain angka
            let value = input.value.replace(/\D/g, '');

            // Menggunakan fungsi toLocaleString() untuk menampilkan format ribuan
            input.value = parseInt(value).toLocaleString();
        }

        function formatValue(input) {
            // Menghapus semua karakter selain angka
            let value = input.value.replace(/\D/g, '');

            // Menghilangkan format ribuan saat input kehilangan fokus
            input.value = value;
        }
    </script>
@endpush
