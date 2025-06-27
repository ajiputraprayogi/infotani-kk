@extends('layouts.home')
@section('title', 'INFOTANI-KK')
@section('content')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->

            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-danger shadow-sm">
                            <i class="bi bi-box-seam"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Panen</span>
                            <span class="info-box-number">{{ $jumlah_panen }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-success shadow-sm">
                            <i class="bi bi-cash-stack"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Hasil Panen</span>
                            <span class="info-box-number">Rp {{ number_format($hasil_panen ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-primary shadow-sm">
                            <i class="bi bi-flower3"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tanaman</span>
                            <span class="info-box-number">{{ $tanaman }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-warning shadow-sm">
                            <i class="bi bi-person-lines-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Petani</span>
                            <span class="info-box-number">{{ $user }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- List Harga Jual Hari Ini --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h3 class="card-title">Harga Jual Tanaman Hari Ini</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Tanaman</th>
                                            <th>Jenis Tanaman</th>
                                            <th>Harga Jual (/kg)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($harga_jual as $item)
                                            <tr>
                                                <td>{{ $item->nama_tanaman_t }}</td>
                                                <td>{{ $item->jenis_tanaman_jt }}</td>
                                                <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada data hari ini.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-end small text-muted">
                            Tanggal: {{ \Carbon\Carbon::today()->format('d M Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>

@endsection
