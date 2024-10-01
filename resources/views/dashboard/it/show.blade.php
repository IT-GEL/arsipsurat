@extends('dashboard.layouts.main')

@section('container')

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="/dashboard/it" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
            <a href="/dashboard/it/{{ $it->id }}/cetak" class="btn btn-secondary"><i class="bi bi-printer"></i> Cetak</a>
        </div>
        <center style="margin-top: 50px;">
            <!-- Header -->
            <table style="align-content: center">
                <tr>
                    <td><img src="{{ asset('dashmin/img/GEL.png') }}" width="110" height="110" /></td>
                    <td style="font-family: 'Times New Roman', Times, serif; font-size: 13px">
                        <center>
                            <font size="5"><b>GLOBAL ENERGI LESTARI</b></font><br />
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><hr style="border: 1px solid" /></td>
                </tr>
            </table>
            <br />

            <!-- Title and Reference Number -->
            <table width="545">
                <tr>
                    <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold" class="text">
                        <u>FORMULIR KEBUTUHAN BASIS IT</u>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">Nomor : ITS/{{ $it->noSurat }}/GELJKT/{{ $romanMonth }}/2024</td>
                </tr>
            </table>
            <br>

            <!-- Applicant Details -->
            <table width="545">
                <tr>
                    <td>Saya yang bertandatangan dibawah ini :</td>
                </tr>
            </table>
            <br /><br />
            <table width="545">
                <tr>
                    <td width="200">Nama</td>
                    <td width="10">:</td>
                    <td width="335">{{ $it->nama }}</td>
                </tr>
            </table>
            <table width="545">
                <tr>
                    <td width="200">Jabatan</td>
                    <td width="10">:</td>
                    <td width="335">{{ $it->jabatan }}</td>
                </tr>
            </table>
            <table width="545">
                <tr>
                    <td width="200">Divisi</td>
                    <td width="10">:</td>
                    <td width="335">{{ $it->divisi }}</td>
                </tr>
            </table>
            <br /><br />

            <!-- Request Details -->
            <table width="545">
                <tr>
                    <td>Dengan ini mengajukan ijin untuk {{ $it->perihal }} :</td>
                </tr>
            </table>
            <table width="545">
                <tr>
                    <td>
                        {!! $it->keterangan !!}
                    </td>
                </tr>
            </table>
            <br /><br />

            <!-- Footer -->
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
                    <td>
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
