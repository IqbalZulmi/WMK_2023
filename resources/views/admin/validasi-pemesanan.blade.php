@extends('html.html')

@push('js')
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                info: true,
                dom: '<"row"<"col-sm-6 d-flex justify-content-center justify-content-sm-start mb-2 mb-sm-0"l><"col-sm-6 d-flex justify-content-center justify-content-sm-end"f>>rt<"row"<"col-sm-6 mt-0"i><"col-sm-6 mt-2"p>>',
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.review').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                image: {
                    verticalFit: true
                },
                tClose: 'Tutup',
                tLoading: 'Memuat gambar...',
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            // Saat halaman dimuat, tampilkan label dan input komentar
            $('label[for="komentar"]').hide();
            $('textarea[name="komentar"]').hide();

            // Ketika dropdown "Status Verifikasi" berubah
            $('select[name="status"]').change(function () {
                var selectedStatus = $(this).val();

                if (selectedStatus === 'selesai') {
                    // Jika status "Selesai" dipilih, tampilkan label dan input bukti pembayaran, dan sembunyikan label dan input komentar
                    $('label[for="komentar"]').hide();
                    $('textarea[name="komentar"]').hide();
                } else if (selectedStatus === 'gagal') {
                    // Jika status "Tolak" dipilih, sembunyikan label dan input bukti pembayaran, dan tampilkan label dan input komentar
                    $('label[for="komentar"]').show();
                    $('textarea[name="komentar"]').show();
                } else {
                    // Jika tidak ada yang dipilih, kembalikan ke keadaan awal
                    $('label[for="komentar"]').hide();
                    $('textarea[name="komentar"]').hide();
                }
            });
        });
    </script>
@endpush

@section('content')

    @include('components.header')

    @include('components.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Validasi Pemesanan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminDashboardPage') }}">Home</a></li>
                    <li class="breadcrumb-item">Validasi</li>
                    <li class="breadcrumb-item active">Pemesanan</li>
                    </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Validasi Pemesanan</h5>
                            <table class="table table-striped table-hover border table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">No Handphone</th>
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Tanggal Pembayaran</th>
                                        <th scope="col">Bukti Pembayaran</th>
                                        <th scope="col">Metode Pembayaran</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataPembayaran as $groupKey => $group)
                                        @php
                                            $groupCount = $group->count();
                                            $sanitizedGroupKey = preg_replace('/\s+/', '_', $groupKey); // Mengganti spasi dengan underscore
                                            $sanitizedGroupKey = preg_replace('/[^A-Za-z0-9_\-]/', '', $sanitizedGroupKey); // Mengganti semua karakter selain alphanumerik, underscore, dan dash
                                        @endphp
                                        @if ($groupCount > 1) {{-- If group has more than one item, display only the first one --}}
                                            @php $data = $group->first(); @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->pelanggan->nama }}</td>
                                                <td>{{ $data->pelanggan->user->email }}</td>
                                                <td>{{ $data->pelanggan->no_hp }}</td>
                                                <td>Rp. {{ number_format($data->total_harga, 0, ',', '.') }},00</td>
                                                <td>{{ $data->pembayaran->tanggal_pembayaran }}</td>
                                                <td class="text-center">
                                                    @if($data->pembayaran->bukti_pembayaran)
                                                        <a href="{{ asset('storage/'. $data->pembayaran->bukti_pembayaran) }}" class="btn btn-main review">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $data->metode_pembayaran->nama_metode }}</td>
                                                <td>
                                                    <button class="btn btn-warning" disabled>
                                                        {{ $data->status }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                        <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#validasiModal{{ $sanitizedGroupKey  }}">
                                                            <i class="bi bi-pen"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach($group as $data)
                                                <tr>
                                                    <td>{{ $loop->parent->iteration }}</td>
                                                    <td>{{ $data->pelanggan->nama }}</td>
                                                    <td>{{ $data->pelanggan->user->email }}</td>
                                                    <td>{{ $data->pelanggan->no_hp }}</td>
                                                    <td>Rp. {{ number_format($data->total_harga, 0, ',', '.') }},00</td>
                                                    <td>{{ $data->pembayaran ? $data->pembayaran->tanggal_pembayaran : 'N/A' }}</td>
                                                    <td class="text-center">
                                                        @if($data->pembayaran && $data->pembayaran->bukti_pembayaran)
                                                            <a href="{{ asset('storage/'. $data->pembayaran->bukti_pembayaran) }}" class="btn btn-main review">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>{{ $data->metode_pembayaran->nama_metode }}</td>
                                                    <td>
                                                        <button class="btn btn-warning" disabled>
                                                            {{ $data->status }}
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                            <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#validasiModal{{ $sanitizedGroupKey  }}">
                                                                <i class="bi bi-pen"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @empty
                                        {{-- Handle empty collection --}}
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @foreach ($dataPembayaran as $groupKey => $group )
        @php
            $dataPelanggan = $group->first();
            $sanitizedGroupKey = preg_replace('/\s+/', '_', $groupKey); // Mengganti spasi dengan underscore
            $sanitizedGroupKey = preg_replace('/[^A-Za-z0-9_\-]/', '', $sanitizedGroupKey); // Mengganti semua karakter selain alphanumerik, underscore, dan dash
        @endphp
        <div class="modal fade" id="validasiModal{{ $sanitizedGroupKey  }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Validasi Pemesanan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('validasiPemesanan') }}" method="POST">
                            @csrf @method('put')
                            <div class="container-fluid">
                                <div class="row gy-2">
                                    @foreach ($group as $data)
                                        {{-- Sembunyikan input untuk menyimpan id_pemesanan --}}
                                        <input type="hidden" name="id_pemesanans[]" value="{{ $data->id }}">
                                        {{-- Tampilkan informasi lain yang relevan jika perlu --}}
                                    @endforeach
                                    <div class="col-12">
                                        <label for="" class="form-label mb-2">Nama</label>
                                        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama',$dataPelanggan->pelanggan->nama) }}" disabled>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="form-label mb-2">no_hp</label>
                                        <input name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" value="{{ $dataPelanggan->pelanggan->no_hp }}" disabled>
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="form-label mb-2">Status Verifikasi</label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="berhasil">Selesai</option>
                                            <option value="gagal">Tolak</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="komentar" class="form-label mb-2">Komentar</label>
                                        <textarea name="komentar" rows="4" class="form-control @error('komentar') is-invalid @enderror" placeholder="Isikan alasan mengapa anda menolak penarikan ini !"></textarea>
                                        @error('komentar')
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
    @endforeach

    @include('components.footer')
@endsection
