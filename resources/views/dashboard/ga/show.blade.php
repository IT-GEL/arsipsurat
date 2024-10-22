@extends('dashboard.layouts.main')

@section('container')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
                <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i
                        class="bi bi-arrow-left-square"></i>
                    Kembali</a>
                <div class="ml-auto">
                    @if (auth()->user()->name == 'IT Support')
                        <form action="{{ route('it.approve', $tnc->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('put')
                            <input type="hidden" name="approve" value="yes">
                            <button class="btn btn-primary {{ $tnc->approve ? 'btn-success' : 'btn-secondary' }}"
                                data-approved="{{ $tnc->approve }}"
                                onclick="{{ $tnc->approve ? 'return false;' : 'berhasil(this);' }}"
                                {{ $tnc->approve ? 'disabled' : '' }}>
                                <i class="bi bi-check2-square"></i> Approve
                            </button>
                        </form>
                    @endif
                    <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                        href="{{ url('/dashboard/it/' . $tnc->id . '/edit') }}"
                        @if ($tnc->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
                        <i class="bi bi-pencil-square"></i> Edit
                    </button>
                    <button id="download-pdf" class="btn btn-primary" style="margin-left:10px;">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Unduh
                    </button>
                </div>
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
                    <td>
                    <td colspan="2">
                        <hr style="border: 1px solid" />
                    </td>
                    </td>
                </table>
                <br />
                <table width="545">
                    <tr>
                        <td>Jakarta, {{ formatDateIndonesian($ga->tglSurat) }}</td>
                    </tr>
                    <tr>
                        <td>Nomor : {{ $ga->noSurat }}/GEL/GA-AG/{{ $romanMonth }}/2024</td>
                    </tr>
                    <tr>
                        <td>Perihal : {{ $ga->perihal }}</td>
                    </tr>


                </table>
                <br>
                <table width="545">
                    <tr>
                        <td>Kepada</td>
                    </tr>
                    <tr>
                        <td>Building Management</td>
                    </tr>
                    <tr>
                        <td>PT Buanagraha Arthaprima</td>
                    </tr>
                    <tr>
                        <td>Gedung Artha Graha Jl. Jendral Sudirman Kav. 52-53</td>
                    </tr>
                    <tr>
                        <td>Jakarta - Indonesia</td>
                    </tr>
                </table>
                <br>
                <table width="545">
                    <tr>
                        <td>Dengan hormat,</td>
                    </tr>
                    <tr>
                        <td>Yang bertanda tangan dibawah ini:</td>
                    </tr>
                    <tr>
                        <td width="200" style="font-weight: bold">NAMA</td>
                        <td width="10" style="font-weight: bold">:</td>
                        <td width="335" style="font-weight: bold">TONY</td>
                    </tr>
                    <tr>
                        <td width="200" style="font-weight: bold">JABATAN</td>
                        <td width="10" style="font-weight: bold">:</td>
                        <td width="335" style="font-weight: bold">CORPORATE BUSINESS CONTROL MANAGER</td>
                    </tr>
                </table>
                <table width="545">
                    <tr>
                        <td>Dengan ini mengajukan permohonan pembuatan kartu akses Gedung Artha Graha untuk karyawan PT.
                            Global Energi Lestari,</td>

                    </tr>
                    <tr>
                        <td>berikut data karyawan kami :</td>
                    </tr>
                </table>
                <table width="545">
                    <tr>
                        <td>
                            {!! $ga->keterangan !!}
                        </td>
                    </tr>
                    <br /><br />
                </table>
                <br /><br />

                <br /><br /><br />
                <table width="545">
                    <tr>
                        <td style="text-align: left">Pada Hari & Tanggal : {{ formatDateIndonesian($ga->tglSurat) }}</td>
                    </tr>
                    <tr>
                        <td width="400"></td>
                        <td style="text-align: left">An. {{ $ga->ttd }}</td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td width="400"></td>
                        <td>
                            <img src="{{ asset('dashmin/img/' . $ga->ettd) }}" width="110" height="110" />
                        </td>
                    </tr>
                </table>

                <table width="400" style="margin-bottom: 100px">
                    <tr>
                        <td width="340"></td>
                        <td style="text-align: left">{{ $ga->namaTtd }}</td>
                    </tr>
                </table>
            </center>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
