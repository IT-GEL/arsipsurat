@extends('dashboard.layouts.main')

@section('container')

@php
    function monthToRoman($monthNumber) {
        $romanMonths = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
            5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
            9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        return $romanMonths[$monthNumber] ?? '';
    }

    function formatDateIndonesian($date) {
        $englishDayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $indonesianDayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $englishMonthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $indonesianMonthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $day = date('l', strtotime($date));
        $month = date('F', strtotime($date));

        $dayIndex = array_search($day, $englishDayNames);
        $monthIndex = array_search($month, $englishMonthNames);

        $indonesianDay = $indonesianDayNames[$dayIndex];
        $indonesianMonth = $indonesianMonthNames[$monthIndex];

        return $indonesianDay . ', ' . date('j', strtotime($date)) . ' ' . $indonesianMonth . ' ' . date('Y', strtotime($date));
    }

    $monthNumber = date('n', strtotime($it->tglSurat));
    $romanMonth = monthToRoman($monthNumber);
@endphp

<!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="/dashboard/it" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
                        <a href="/dashboard/it/{{ $it->noSurat }}/cetak" class="btn btn-secondary"><i class="bi bi-printer"></i> Cetak</a>
                    </div>
                    <center style="margin-top: 50px;">
                        <table style="align-content: center">
                            <tr>
                            <td><img src="{{ asset('dashmin/img/GEL.png') }}" width="110" height="110" /></td>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 13px">
                                <center>
                                <font size="5"><b>GLOBAL ENERGI LESTARI</b> </font><br />
                                </center>
                            </td>
                            </tr>
                            <tr>
                            <td colspan="2"><hr style="border: 1px solid" /></td>
                            </tr>
                        </table>
                        <br />
                        <table width="545">
                            <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold" class="text">
                                <u>{{ $it->perihal }}</u>
                            </td>
                            </tr>
                            <tr>
                            <td style="text-align: center">Nomor : ITS/00{{ $it->noSurat }}/GELJKT/{{ $romanMonth }}/2024</td>
                            </tr>
                        </table> 
                        <br>
                        <table width="545">
                            <tr>
                               <td>Perihal : </td>
                            <tr>
                            
                        </table>   
                        <br>
                        <table width="545">
                            <tr>
                            <td>Saya yang bertandatangan dibawah ini :</td>
                            </tr>
                        </table>
                        <br /><br />
                        <table width="545">
                            <td width="200">Nama</td>
                            <td width="10">:</td>
                            <td width="335">{{ $it->nama }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="200">Jabatan</td>
                            <td width="10">:</td>
                            <td width="335">{{ $it->jabatan }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="200">Divisi</td>
                            <td width="10">:</td>
                            <td width="335">{{ $it->divisi }}</td>
                            </tr>
                        </table>
                        <br /><br />
                        <table width="545">
                            <tr>
                            <td>Dengan ini mengajukan ijin untuk : </td>
                            </tr>
                        </table>
                        <table width="545">
                            <tr>
                            <td>
                                {!! $it->keterangan !!}
                            </td>
                            </tr>
                            <br /><br />
                        </table>
                        <br /><br />
  
                        <br /><br /><br />
                        <table width="545">
                            <tr>
                                <td style="text-align: left">Pada Hari & Tanggal : {{ formatDateIndonesian($it->tglSurat) }}</td>
                            </tr>
                            <tr>
                                <td width="400"></td>
                                <td style="text-align: left">An. {{ $it->ttd }}</td>
                            </tr>
                        </table>
                        <br>
                        <table>
                        <tr>
                        <td width="400"></td>
                            <td >
                                <img src="{{ asset('dashmin/img/' . $it->ettd) }}" width="110" height="110" />
                            </td>
                        </tr>
                    </table>
              
                        <table width="400" style="margin-bottom: 100px">
                            <tr>
                                <td width="340"></td>
                                <td style="text-align: left">{{ $it->namaTtd }}</td>
                            </tr>
                        </table>
                    </center>
                </div>
            </div>
<!-- Recent Sales End -->

@endsection