@extends('dashboard.layouts.main')

@section('container')

@php
    $userName = auth()->user()->name ?? '';
    $date = null;
    $formattedDate = '';
    $total = 'N/A';
    $records = [];
    $romanMonth = ''; // Define the variable here

    switch ($userName) {
        case "IT Support":
            $date = $it->tglSurat ?? null;
            $total = $totalIT ?? 'N/A';
            $records = $its ?? [];
            break;
        case "General Affair":
            $date = $ga->tglSurat ?? null;
            $total = $totalGA ?? 'N/A';
            $records = $ga ?? [];
            break;
        case "Marketing Sales Shipping":
            $date = $mss->tglSurat ?? null;
            $total = $totalMSS ?? 'N/A';
            $records = $mss ?? [];
            break;
        default:
            $total = 'N/A';
            $records = [];
            break;
    }

    if ($date) {
        $monthNumber = \Carbon\Carbon::parse($date)->month;
        $romanMonth = monthToRoman($monthNumber); // Define $romanMonth here
        $formattedDate = formatDateIndonesian($date);
    }
@endphp

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        @if ($userName == "IT Support")
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Surat IT</p>
                    <h6 class="mb-0">{{ $total }}</h6>
                </div>
            </div>
        </div>
        @endif

        @if ($userName == "General Affair")
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Surat Keterangan GA</p>
                    <h6 class="mb-0">{{ $total }}</h6>
                </div>
            </div>
        </div>
        @endif

        @if ($userName == "Marketing Sales Shipping")
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Surat Keterangan MSS</p>
                    <h6 class="mb-0">{{ $total }}</h6>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Sale & Revenue End -->

@if ($userName == "IT Support")
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Surat Keterangan IT</h6>
            <a href="/dashboard/it">Lihat Semua</a>
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
                    @forelse ($records as $record)
                    <tr>
                        <td>{{ $record->noSurat }}</td>
                        <td>{{ $record->nama }}</td>
                        <td>{{ date('d M Y', strtotime($record->tglSurat)) }}</td>
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

@if ($userName == "General Affair")
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Surat Keterangan GA</h6>
            <a href="/dashboard/ga">Lihat Semua</a>
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
                    @forelse ($records as $record)
                    <tr>
                        <td>{{ $record->noSurat }}</td>
                        <td>{{ $record->nama }}</td>
                        <td>{{ date('d M Y', strtotime($record->tglSurat)) }}</td>
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

@if ($userName == "Marketing Sales Shipping")
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Surat Keterangan Marketing Sales Shipping</h6>
            <a href="/dashboard/mss">Lihat Semua</a>
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
                    @forelse ($records as $record)
                    <tr>
                        
                        <td style="font-weight:bold;">Ref. No:MSS/GEL/BA-{{ $record->noSurat }}/{{ $romanMonth }}/2024</td>
                        <td>{{ $record->perihal }}</td>
                        <td>{{ date('d M Y', strtotime($record->tglSurat)) }}</td>
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
