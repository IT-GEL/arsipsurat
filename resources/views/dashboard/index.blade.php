@extends('dashboard.layouts.main')

@section('container')

@php
    $userName = auth()->user()->name ?? '';

@endphp

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        @if ($userName == "IT Support" || $userName == "superadmin")
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Surat IT</p>
                    <h6 class="mb-0">{{ $totalIT }}</h6>
                </div>
            </div>
        </div>
        @endif

        @if ($userName == "General Affair" || $userName == "superadmin")
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Surat Keterangan GA</p>
                    <h6 class="mb-0">{{ $totalGA }}</h6>
                </div>
            </div>
        </div>
        @endif

        @if ($userName == "Marketing Sales Shipping" || $userName == "superadmin")
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Surat Keterangan MSS</p>
                    <h6 class="mb-0">{{ $totalMSS }}</h6>
                </div>
            </div>
        </div>
        @endif

        @if ($userName == "Global Sinergi Maritim" || $userName == "superadmin" || $userName == "Capt. John Herley")
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Surat Keterangan GSM</p>
                    <h6 class="mb-0">{{ $totalGSM }}</h6>
                </div>
            </div>
        </div>
        @endif

        @if ($userName == "Talent and Culture" || $userName == "superadmin" || $userName == "Tuty Alawiyah, M.M.")
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Surat Keterangan TNC</p>
                    <h6 class="mb-0">{{ $totalTNC }}</h6>
                </div>
            </div>
        </div>
        @endif

        @if ($userName == "Procurement" || $userName == "superadmin" || $userName == "EDY")
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Surat Keterangan PRC</p>
                    <h6 class="mb-0">{{ $totalPRC }}</h6>
                </div>
            </div>
        </div>
        @endif

        @if ($userName == "Finance AR" || $userName == "superadmin")
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Surat Keterangan Finance AR</p>
                    <h6 class="mb-0">{{ $totalPRC }}</h6>
                </div>
            </div>
        </div>
        @endif

        @if ($userName == "Finance AP" || $userName == "superadmin")
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Surat Keterangan Finance AP</p>
                    <h6 class="mb-0">{{ $totalPRC }}</h6>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
<!-- Sale & Revenue End -->

@if ($userName == "IT Support" || $userName == "superadmin")
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Surat Keterangan IT</h6>
            <a href="{{ url('/dashboard/it') }}">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No Surat</th>
                        <th scope="col">Perihal Surat</th>
                        <th scope="col">Nama User</th>
                        <th scope="col">Tanggal Surat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($its as $it)
                    <tr>
                        <td>{{ $it->prefix }}</td>
                        <td>{{ $it->perihal }}</td>
                        <td>{{ $it->nama }}</td>
                        <td>{{ date('d M Y', strtotime($it->tglSurat)) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
@endif

@if ($userName == "General Affair" || $userName == "superadmin")
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Surat Keterangan GA</h6>
            <a href="{{ url('/dashboard/ga') }}">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No Surat</th>
                        <th scope="col">Nama Surat</th>
                        <th scope="col">Tanggal Surat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ga as $ga)
                    <tr>
                        <td>{{ $ga->noSurat }}</td>
                        <td>{{ $ga->nama }}</td>
                        <td>{{ date('d M Y', strtotime($ga->tglSurat)) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
@endif

@if ($userName == "Marketing Sales Shipping" || $userName == "superadmin" || $userName == "Ervina Wijaya")
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Surat Keterangan Marketing Sales Shipping</h6>
            <a href="{{ url('/dashboard/mss') }}">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No Surat</th>
                        <th scope="col">Perihal Surat</th>
                        <th scope="col">Tanggal Surat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mss as $mss)
                    <tr>
                        <td style="font-weight:bold;">{{ $mss->prefix }}</td>
                        <td>{{ $mss->perihal }}</td>
                        <td>{{ date('d M Y', strtotime($mss->tglSurat)) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
@endif

@if ($userName == "Global Sinergi Maritim" || $userName == "superadmin" || $userName == "Capt. John Herley")
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Surat Keterangan Global Sinergi Maritim</h6>
            <a href="{{ url('/dashboard/gsm') }}">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No Surat</th>
                        <th scope="col">Perihal Surat</th>
                        <th scope="col">Tanggal Surat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gsm as $gsm)
                    <tr>
                        <td style="font-weight:bold;">{{ $gsm->prefix }}</td>
                        <td>{{ $gsm->perihal }}</td>
                        <td>{{ date('d M Y', strtotime($gsm->tglSurat)) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
@endif

@if ($userName == "Talent and Culture" || $userName == "superadmin" || $userName == "Tuty Alawiyah, M.M.")
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Surat Keterangan Talent and Culture</h6>
            <a href="{{ url('/dashboard/tnc') }}">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No Surat</th>
                        <th scope="col">Perihal Surat</th>
                        <th scope="col">Tanggal Surat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tnc as $tnc)
                    <tr>
                        <td style="font-weight:bold;">{{ $tnc->prefix }}</td>
                        <td>{{ $tnc->perihal }}</td>
                        <td>{{ date('d M Y', strtotime($tnc->tglSurat)) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
@endif


@if ($userName == "Procurement" || $userName == "superadmin" || $userName == "Edy")
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Surat Keterangan Procurement</h6>
            <a href="{{ url('/dashboard/prc') }}">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No Surat</th>
                        <th scope="col">Perihal Surat</th>
                        <th scope="col">Tanggal Surat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prc as $prc)
                    <tr>
                        <td style="font-weight:bold;">{{ $prc->prefix }}</td>
                        <td>{{ $prc->perihal }}</td>
                        <td>{{ date('d M Y', strtotime($prc->tglSurat)) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
@endif

@if ($userName == "Finance AP" || $userName == "superadmin")
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Surat Keterangan Finance AP</h6>
            <a href="{{ url('/dashboard/finap') }}">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No Surat</th>
                        <th scope="col">Perihal Surat</th>
                        <th scope="col">Tanggal Surat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($finap as $finap)
                    <tr>
                        <td style="font-weight:bold;">{{ $finap->prefix }}</td>
                        <td>{{ $finap->perihal }}</td>
                        <td>{{ date('d M Y', strtotime($finap->tglSurat)) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
@endif

@if ($userName == "Finance AR" || $userName == "superadmin")
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Surat Keterangan Finance AR</h6>
            <a href="{{ url('/dashboard/finar') }}">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No Surat</th>
                        <th scope="col">Perihal Surat</th>
                        <th scope="col">Tanggal Surat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($finar as $finar)
                    <tr>
                        <td style="font-weight:bold;">{{ $finar->prefix }}</td>
                        <td>{{ $finar->perihal }}</td>
                        <td>{{ date('d M Y', strtotime($finar->tglSurat)) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
@endif

@endsection
