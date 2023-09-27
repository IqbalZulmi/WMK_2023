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
@endpush

@section('content')

    @include('components.header')

    @include('components.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Penarikan Saldo</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardPage') }}">Home</a></li>
                    <li class="breadcrumb-item">Halaman</li>
                    <li class="breadcrumb-item active">Penarikan</li>
                    </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Kelola Jenis Lapangan</h5>
                            <div class="d-flex justify-content-end mb-2">
                                <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#TambahModal">
                                    <i class="bi bi-plus-circle-fill"></i> Ajukan Penarikan
                                </button>
                            </div>
                            <table class="table table-striped table-hover border table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Jumlah Penarikan</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataPending as $index => $data )
                                        <tr>
                                            <th>{{ $index+1 }}</th>
                                            <td>{{ $data->jumlah_penarikan }}</td>
                                            <td>
                                                <span class="btn btn-sm btn-warning disabled ">{{ $data->status }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%" class="text-center">Tidak Ada Data Untuk Ditampilkan!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="TambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Ajukan Penarikan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengajuanPenarikan') }}" method="POST">
                        @csrf
                        <div class="container-fluid">
                            <div class="row gy-2">
                                @if(!Auth::user()->penyedia->rekening)
                                    <h4>Silahkan tambahkan rekening anda pada profile</h4>
                                @else
                                    <div class="col-12">
                                        <label for="" class="mb-2">Total Saldo</label>
                                        <input name="total_saldo" type="text" class="form-control @error('total_saldo') is-invalid @enderror" value="Rp. {{ number_format($totalSaldo, 0, ',', '.') }},00" disabled>
                                        @error('total_saldo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="mb-2">Bank</label>
                                        <input name="bank" type="text" class="form-control @error('bank') is-invalid @enderror" value="{{ Auth::user()->penyedia->rekening->daftar_bank->nama_bank }}" disabled>
                                        @error('bank')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="mb-2">Nomor Rekening</label>
                                        <input name="no_rekening" type="text" class="form-control @error('no_rekening') is-invalid @enderror" value="{{ Auth::user()->penyedia->rekening->no_rekening }}" disabled>
                                        @error('no_rekening')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="mb-2">Nama Rekening</label>
                                        <input name="nama_rekening" type="text" class="form-control @error('nama_rekening') is-invalid @enderror" value="{{ Auth::user()->penyedia->rekening->nama_rekening }}" disabled>
                                        @error('nama_rekening')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="mb-2">Jumlah Penarikan</label>
                                        <input name="jumlah_penarikan" type="text" class="form-control @error('jumlah_penarikan') is-invalid @enderror" value="{{ old('jumlah_penarikan') }}" placeholder="Jumlah Penarikan yang diinginkan" required>
                                        @error('jumlah_penarikan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                        @if(!Auth::user()->penyedia->rekening)
                            <a href="{{ route('profilePenyedia') }}" class="btn btn-main">TambahKan Rekening <i class="bi bi-arrow-right-circle"></i></a>
                        @else
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-main">Simpan</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
@endsection
