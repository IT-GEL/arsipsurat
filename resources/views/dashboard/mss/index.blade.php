@extends('dashboard.layouts.main')

@section('container')

@php
    $userName = auth()->user()->name ?? '';
    $date = null;
    $formattedDate = '';
    $total = 'N/A';
    $records = [];
    $romanMonth = ''; // Define the variable here

    if ($date) {
        $monthNumber = \Carbon\Carbon::parse($date)->month;
        $romanMonth = monthToRoman($monthNumber); // Define $romanMonth here
        $formattedDate = formatDateIndonesian($date);
    }
@endphp

<!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-5">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Surat Keterangan Marketing Sales Shipping</p>
                        <h6 class="mb-0">{{ $totalMSS }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->

    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Surat Divisi Marketing Sales Shipping</h6>
                <a href="/dashboard/mss/create" class="btn btn-primary">Tambah Surat</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No Surat</th>
                            <th scope="col">Perihal Surat</th>
                            <th scope="col">Tanggal Surat</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mss as $mss)
                        <tr>
                        <td style="font-weight:bold;">Ref. No:MSS/GEL/BA-{{ $mss->noSurat }}/{{ $romanMonth }}/2024</td>
                            <td>{{ $mss->perihal }}</td>
                            <td>{{ date('d M Y', strtotime($mss->tglSurat)); }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="/dashboard/mss/{{ $mss->noSurat }}">Detail</a>
                                <a class="btn btn-sm btn-warning" href="/dashboard/mss/{{ $mss->noSurat }}/edit">Edit</a>
                                <form action="/dashboard/mss/{{ $mss->noSurat }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf 
                                    <button class="btn btn-sm btn-danger border-0" onclick="return confirm('Kilik Oke Untuk Menghapus')">Hapus</button>
                                </form>
                                {{-- <a class="btn btn-sm btn-danger" href="#">Hapus</a> --}}
                                <a class="btn btn-sm btn-success" href="/dashboard/mss/{{ $mss->noSurat }}/cetak">Cetak</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection