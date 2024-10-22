@extends('dashboard.layouts.main')

@section('container')
<?php \Carbon\Carbon::setLocale('id'); ?>
    <style>
        @page {
            size: A4;
            margin: 1cm;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            margin: auto;
            border: 1px solid #D3D3D3;
            background-color: white;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .header-content {
            position: relative;
            z-index: 10;
            padding-bottom: 10mm;
            display: flex;
            flex-direction: column;
            padding-left: 1in;
            padding-right: 1in;
            /* Make sure the content stays in front */
        }

        .footer-page {
            position: absolute;
            bottom: 0;
            left: 0;
            z-index: 0;
            /* Ensure the footer is behind content */
        }
    </style>


    @if ($tnc->idPerihal == '1' && $tnc->divisi == 'FIN-AP')
        <!-- Surat Internal Memo -->
        <!-- Recent Sales Start -->

        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
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
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $tnc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style="padding-left:1in; padding-right:1in;">
                    {{-- <center style="margin-top: 50px;"> --}}

                    <table width="600">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold; text-transform: uppercase;"
                                class="text">
                                <u>{{ $tnc->perihal }}</u>
                            </td>

                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold; font:italic">{{ $tnc->prefix }}</td>
                        </tr>
                    </table>
                    <br>
                    <table class="table-keterangan" width="600">
                        <tr>
                            <td style="border: 0px;">{!! $tnc->keterangan !!}</td>
                        </tr>
                    </table>

                    <table width="600">
                        <tr>
                            <td style="text-align: left">Jakarta, {{ formatDateIndonesian($tnc->tglSurat) }}</td>
                        </tr>
                        <tr>
                            <td>Hormat Kami,</td>
                        </tr>
                    </table>

                    @if ($tnc->approve == '1')
                        <table width="600" style="font-weight:bold;">
                            <tr>
                                <td><img style="height:125px; weigth:125px;padding-left:15px;"
                                        src="{{ asset('img/qrcodes/' . $tnc->qr) }}" alt="QR Code"></td>
                            </tr>
                        </table>
                    @else
                        <br><br><br><br>
                    @endif

                    <table width="600" style="font-weight:bold;">
                        <tr>
                            <td><u>{{ $tnc->ttd }}</u></td>
                        </tr>
                        <tr>
                            <td>{{ $tnc->jabatan }}</td>
                        </tr>
                    </table>

                    {{-- </center> --}}
                </div>
                @if ($tnc->kop !== null)
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $tnc->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>
        </div>
        <!-- Recent Sales End -->
    @endif

    @if ($tnc->idPerihal == '2')
        <!-- Surat Waskita -->
        <!-- Recent Sales Start -->

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
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $tnc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style="padding-left:1in; padding-right:1in;">
                    {{-- <center style="margin-top: 50px;"> --}}

                    <table width="600">
                        <tr>
                            <td style="text-align: left">Jakarta, {{ formatDateIndonesian($tnc->tglSurat) }}</td>
                        </tr>


                    </table>
                    <br>

                    <table width="600">
                        <tr>
                            <td style="text-align: left">Nomor : {{ $tnc->prefix }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left">Perihal : {{ $tnc->perihal }}</td>
                        </tr>
                    </table>
                    <br>
                    <table width="600">
                        <tr>
                            <td style="text-align: left">Kepada Yth.</td>
                        </tr>
                        <tr>
                            <td style="text-align: left"><u><b>Biro Konsultan Psikologi Waskita</b></u></td>
                        </tr>
                        <tr>
                            <td style="text-align: left">Di Tempat</td>
                        </tr>
                    </table>
                    <br>
                    <table class="table-keterangan" width="620">
                        <tr>
                            <td style="border: 0px; width: 100%; padding: 0px;">{!! $tnc->keterangan !!}</td>
                        </tr>
                    </table>

                    <table width="600">
                        <tr>
                            <td><b>PT Global Energi Lestari</b></td>
                        </tr>
                    </table>

                    @if ($tnc->approve == '1')
                        <table width="600" style="font-weight:bold;">
                            <tr>
                                <td><img style="height:125px; weigth:125px;padding-left:15px;"
                                        src="{{ asset('img/qrcodes/' . $tnc->qr) }}" alt="QR Code"></td>
                            </tr>
                        </table>
                    @else
                        <br><br><br><br>
                    @endif

                    <table width="600" style="font-weight:bold;">
                        <tr>
                            <td><u>Tuty Alawiyah, M.M</u></td>
                        </tr>
                        <tr>
                            <td>Corporate Talent and Culture Manager</td>
                        </tr>
                    </table>

                    {{-- </center> --}}
                </div>
                @if ($tnc->kop !== null)
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $tnc->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>
        </div>
        <!-- Recent Sales End -->
    @endif

    @if ($tnc->idPerihal == '3')
        <!-- SURAT KETERANGAN KERJA -->

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
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $tnc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style="padding-left:1in; padding-right:1in;">
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:213.75pt;text-align:center;"
                        align="center">
                        <span style="font-family:Calibri, sans-serif;font-size:16.0pt;" lang="EN-US"><strong><u>SURAT
                                    KETERANGAN KERJA</u></strong></span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:213.75pt;text-align:center;"
                        align="center">
                        <span style="font-family:Calibri, sans-serif;font-size:16.0pt;"
                            lang="EN-US"><strong>{{ $tnc->prefix }}</strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:213.75pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:213.75pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:213.75pt;">
                        <span style="font-family:Calibri, sans-serif;font-size:12.0pt;line-height:150%;"
                            lang="EN-US">Dengan ini menerangkan bahwa:</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:213.75pt;">
                        &nbsp;
                    </p>
                    <div
                        style="display: flex; align-items: baseline; font-family:Calibri, sans-serif; font-size:12.0pt; line-height:150%;">
                        <div style="width: 250px; font-family:Calibri, sans-serif; font-size:12.0pt; line-height:150%;">
                            Nama</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>{{ $tnc->nama }}</div>
                    </div>
                    <div style="display: flex; align-items: baseline;">
                        <div style="width: 250px; font-family:Calibri, sans-serif; font-size:12.0pt; line-height:150%;">NIK
                        </div>
                        <div style="margin-right: 10px;">:</div>
                        <div style="font-family:Calibri, sans-serif; font-size:12.0pt; line-height:150%;">
                            {{ $tnc->nik }}</div>
                    </div>
                    <div style="display: flex; align-items: baseline; ">
                        <div style="width: 250px; font-family:Calibri, sans-serif; font-size:12.0pt; line-height:150%;">
                            Jabatan</div>
                        <div style="margin-right: 10px;">:</div>
                        <div style="font-family:Calibri, sans-serif; font-size:12.0pt; line-height:150%;">
                            {{ $tnc->jabatan }}</div>
                    </div>
                    <div style="display: flex; align-items: baseline;">
                        <div style="width: 250px; font-family:Calibri, sans-serif; font-size:12.0pt; line-height:150%;">
                            Departemen</div>
                        <div style="margin-right: 10px;">:</div>
                        <div style="font-family:Calibri, sans-serif; font-size:12.0pt; line-height:150%;">
                            {{ $tnc->departement }}</div>
                    </div>
                    <br>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:5.0cm 213.75pt;text-align:justify;">
                        <span style="font-family:Calibri, sans-serif;font-size:12.0pt;line-height:150%;"
                            lang="EN-US">Adalah benar karyawan kami yang telah bekerja pada @if ($tnc->kop == 'KKS')
                                PT Kelinci Karya Sampoerna
                            @endif
                            terhitung tanggal <strong>{{ formatDateIndonesian($tnc->startingDate) }} –
                                {{ formatDateIndonesian($tnc->endDate) }}</strong> Sebagai </span><i><span
                                style="font-family:Calibri, sans-serif;font-size:12.0pt;line-height:150%;"
                                lang="EN-US"><strong>{{ $tnc->jabatan }}</strong></span></i><span
                            style="font-family:Calibri, sans-serif;font-size:12.0pt;line-height:150%;" lang="EN-US">
                            selama bekerja karyawan tersebut telah memberikan dedikasi dan hasil kerja yang baik.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:5.0cm 213.75pt;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:5.0cm 213.75pt;text-align:justify;">
                        <span style="font-family:Calibri, sans-serif;font-size:12.0pt;line-height:150%;"
                            lang="EN-US">Demikian surat keterangan kerja ini dibuat, agar dapat dipergunakan sebagaimana
                            mestinya.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:5.0cm 213.75pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:5.0cm 213.75pt;">
                        &nbsp;
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:5.0cm 213.75pt;">
                        <span style="font-family:Calibri, sans-serif;font-size:12.0pt;" lang="EN-US">Jakarta,
                            {{ \Carbon\Carbon::parse($tnc->tglSurat)->translatedFormat('d F Y') }}</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:5.0cm 213.75pt;">
                        <span style="font-family:Calibri, sans-serif;font-size:12.0pt;line-height:150%;"
                            lang="EN-US"><strong>PT Kelinci Karya Sampoerna</strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:5.0cm 213.75pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:5.0cm 213.75pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:5.0cm 213.75pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:5.0cm 213.75pt;">
                        &nbsp;
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:5.0cm 213.75pt;">
                        <span style="font-family:Calibri, sans-serif;font-size:12.0pt;" lang="EN-US"><strong><u>Tuty
                                    Alawiyah</u></strong></span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:213.75pt;">
                        <span style="font-family:Calibri, sans-serif;font-size:12.0pt;" lang="EN-US"><strong>Corporate
                                Talent and Culture Manager</strong></span>
                    </p>
                    @if ($tnc->kop !== null && file_exists(public_path('img/' . $tnc->kop . '-bottom-kop.png')))
                        <div class="footer-page">
                            <img src="{{ asset('img/' . $tnc->kop . '-bottom-kop.png') }}"
                                style="max-width: 100%; height: auto;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if ($tnc->idPerihal == '4')
        <!-- SURAT MUTASI -->

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

        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $tnc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style="padding-left:1in; padding-right:1in;">
                    <div class="WordSection1" style="page:WordSection1;">
                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">Jakarta, {{ $tnc->tglSurat }}&nbsp;</span>
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $tnc->prefix }}</span>
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">Re&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Surat Mutasi Karyawan</span>
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p
                            style="line-height:115%;margin-bottom:12.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">Kami memberitahukan bahwa mutasi karyawan antar departemen PT Global Energi
                                Lestari dengan rincian sebagai berikut,</span>
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                : {{ $tnc->namaKaryawan }}</span>
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">NIK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                : {{ $tnc->nik }}</span>
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                : {{ $tnc->idKaryawan }}</span>
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">Jabatan Awal / Dept &nbsp;&nbsp; : </span><i><span
                                    style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                    lang="EN-US">{{ $tnc->jabatanAwal }}</span></i>
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">Jabatan Baru / Dept&nbsp;&nbsp;&nbsp; : </span><i><span
                                    style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                    lang="EN-US">{{ $tnc->jabatanBaru }}</span></i>
                        </p>
                        <p style="line-height:115%;margin-bottom:12.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">Tanggal
                                Efektif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                                {{ formatDateIndonesian($tnc->tglEfektif) }}</span>
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">Demikian informasi ini kami sampaikan agar dapat ditindaklanjuti sebagaimana
                                mestinya</span>
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            &nbsp;
                        </p>
                        <p style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:150%;"
                                lang="EN-US">Hormat
                                Saya,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Disetujui
                                oleh,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </p>
                        <p
                            style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                            &nbsp;
                        </p>
                        <p
                            style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                            &nbsp;
                        </p>
                        <p
                            style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                            &nbsp;
                        </p>
                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                            <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;"
                                lang="EN-US"><strong><u>Tuty
                                        Alawiyah</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <u>Johnson
                                        Hartawan</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                        </p>
                        <p
                            style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                            <span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:150%;"
                                lang="EN-US"><strong>Corporate HR
                                    Manager&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    General Manager</strong></span>
                        </p>
                    </div>
                    <p>
                        <br>
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                </div>
                @if ($tnc->kop !== null && file_exists(public_path('img/' . $tnc->kop . '-bottom-kop.png')))
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $tnc->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>
        </div>
    @endif


    @if ($tnc->idPerihal == '5')
        <!-- SURAT TUGAS -->

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
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $tnc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style="padding-left:1in; padding-right:1in;">

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:-2.3pt;margin-top:0cm;tab-stops:9.0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:-2.3pt;margin-top:0cm;text-align:center;"
                        align="center">
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:16.0pt;"
                            lang="IN"><strong><u>
                                    <o:p><span style="text-decoration:none;"> </span></o:p>
                                </u></strong></span>
                    </p>
                    <p style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:-2.3pt;margin-top:0cm;text-align:center;"
                        align="center">
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:16.0pt;"
                            lang="IN"><strong><u>SURAT TUGAS</u></strong></span>
                    </p>
                    <p style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:-2.3pt;margin-top:0cm;text-align:center;"
                        align="center">
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:11pt;"
                            lang="IN"><strong>{{ $tnc->prefix }}</strong></span>
                    </p>
                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12pt;" lang="IN">Yang
                            bertanda tangan di bawah ini, Corporate TC Manager dan @if ($tnc->divisi == 'Operation')
                                Corporate MSS Manager
                            @endif memberikan tugas dinas</span><span
                            style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;" lang="IN"> kepada
                            :</span>
                    </p>
                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <ol>
                        <li style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                            <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;line-height:115%;"
                                lang="IN">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                : <span style="text-transform:uppercase;">{{ $tnc->namaKaryawan }}</span></span>
                        </li>
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;line-height:115%;"
                            lang="IN">NIK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            : {{ $tnc->nik }}</span>
                        <br>
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;line-height:115%;"
                            lang="IN">Divisi&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            : {{ $tnc->divisi }}</span>
                    </ol>
                    <p
                        style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;line-height:115%;"
                            lang="IN">{!! $tnc->keterangan !!}</span>
                    </p>
                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;"
                            lang="IN">Jakarta, {{ formatDateIndonesian($tnc->tglSurat) }}</span>
                    </p>
                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:10.0cm;text-align:justify;">
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;" lang="IN">PT.
                            Global Energi Lestari&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp;Mengetahui,</span>
                    </p>
                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>


                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:-2.3pt;margin-top:0cm;tab-stops:0cm 9.0cm;text-align:justify;">
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;"
                            lang="IN"><strong><u>
                                    @if ($tnc->divisi == 'Operation')
                                        Ervina
                                        Wijaya
                                    @endif
                                </u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <u>Tuty Alawiyah</u></strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:-2.3pt;margin-top:0cm;tab-stops:9.0cm;text-align:justify;">
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;line-height:150%;"
                            lang="IN"><strong>
                                @if ($tnc->divisi == 'Operation')
                                    Corporate MSS
                                @endif
                                Manager&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Corporate Talent &amp; Culture Manager
                            </strong></span>
                    </p>


                </div>
                @if ($tnc->kop !== null && file_exists(public_path('img/' . $tnc->kop . '-bottom-kop.png')))
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $tnc->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>
        </div>
            <!-- Recent Sales End -->
    @endif


    @if ($tnc->idPerihal == '6')
        <!-- PKWT -->
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
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $tnc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style="padding-left:1in; padding-right:1in;">

                    <p style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                        align="center">
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"
                            lang="EN-US"><strong><u>
                                    <o:p><span style="text-decoration:none;"> </span></o:p>
                                </u></strong></span>
                    </p>
                    <p style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                        align="center">
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"
                            lang="EN-US"><strong><u>
                                    <o:p><span style="text-decoration:none;"> </span></o:p>
                                </u></strong></span>
                    </p>
                    <p style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"
                            lang="EN-GB"><strong><u>
                                    <o:p><span style="text-decoration:none;"> </span></o:p>
                                </u></strong></span>
                    </p>
                    <p style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        &nbsp;
                    </p>
                    <p style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        &nbsp;
                    </p>
                    <p style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                        align="center">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:12pt;"
                            lang="FI"><strong>PERJANJIAN KERJA WAKTU TERTENTU</strong></span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                        align="center">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;" lang="FI">{{ $tnc->prefix }}</span>
                    </p>
                    <p style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                        align="center">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">Pada hari ini <strong>{{ getIndonesianDay($tnc->tglSurat) }}</strong>
                            tanggal&nbsp;</span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="IN"><strong>{{ date('j', strtotime($tnc->tglSurat)) }}&nbsp;</strong></span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>({{ getDateInText($tnc->tglSurat) }})</strong></span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">, bulan&nbsp;</span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="IN"><strong>{{ getIndonesianMonth($tnc->tglSurat) }}</strong></span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>,</strong> tahun
                            <strong>{{ date('Y', strtotime($tnc->tglSurat)) }}</strong></span> <span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>,</strong> kami yang bertanda tangan dibawah ini:</span>
                    </p>
                    <ol style="padding-left:48px;font-size:9.0pt;">
                        <li>
                            <p
                                style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                                <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:115%;"
                                    lang="EN-GB"><strong>PT GLOBAL ENERGI LESTARI,&nbsp;</strong>sebuah perusahaan
                                    terbatas yang didirikan berdasarkan peraturan dan hukum Republik Indonesia, beralamat
                                    kantor di Jakarta, Gedung Artha Graha Lantai 30, SCBD – Kebayoran Lama, Jakarta Selatan,
                                    dalam Perjanjian ini diwakili oleh&nbsp;</span><span
                                    style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:115%;"
                                    lang="IN"><strong>Tuty Alawiyah, M. M.,</strong></span><span
                                    style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:115%;"
                                    lang="EN-GB"> sebagai&nbsp;</span><span
                                    style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:115%;"
                                    lang="IN">Corporate Talent &amp; Culture Manager.</span><span
                                    style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:115%;"
                                    lang="EN-GB"> Selanjutnya disebut “Perusahaan”</span>
                            </p>

                        </li>

                    </ol>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:-0.5cm;text-align:justify;text-indent:36.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">Dan&nbsp;</span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:36.0pt;">
                        &nbsp;
                    </p>
                    <ol style="padding-left:48px; font-size:9.0pt;" start="2">
                        <li>
                            <div style="display: flex; align-items: center;">
                                <div style="width: 150px;">Nama</div>
                                <div style="margin-right: 10px;">:</div>
                                <div>{{ $tnc->namaKaryawan }}</div>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <div style="width: 150px;">Tempat/Tanggal Lahir</div>
                                <div style="margin-right: 10px;">:</div>
                                <div>{{ $tnc->tempatLahir }} / {{ formatdateindonesian($tnc->tanggalLahir) }}</div>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <div style="width: 150px;">KTP</div>
                                <div style="margin-right: 10px;">:</div>
                                <div>{{ $tnc->nik }}</div>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <div style="width: 150px;">Jenis Kelamin</div>
                                <div style="margin-right: 10px;">:</div>
                                <div>{{ $tnc->jenisKelamin }}</div>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <div style="width: 150px;">Pendidikan</div>
                                <div style="margin-right: 10px;">:</div>
                                <div>{{ $tnc->pendidikan }}</div>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <div style="width: 150px;">Alamat</div>
                                <div style="margin-right: 10px;">:</div>
                                <div>{{ $tnc->alamat }}</div>
                            </div>

                        </li>
                    </ol>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;" lang="EN-GB">&nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;( Untuk selanjutnya disebut “Pekerja” )</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="SV">Selanjutnya Perusahaan dan Pekerja secara bersama – sama akan disebut Para Pihak
                            dan masing – masing akan disebut Pihak.&nbsp;</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FI">Para Pihak telah sepakat dan setuju untuk&nbsp; membuat dan menandatangani
                            Perjanjian Kerja Waktu Tertentu (untuk selanjutnya disebut ”PKWT”), dengan syarat-syarat dan
                            ketentuan-ketentuan sebagai berikut :</span>
                    </p>
                    <ol style="padding-left:26.13px; font-size:9.0pt;">
                        <li>
                            <p
                                style="line-height:150%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;tab-stops:list 18.0pt 36.0pt;text-align:justify;">
                                <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                                    lang="FR"><strong>Penempatan, Jabatan, Upah&nbsp;</strong></span>
                            </p>
                        </li>
                        <ol style="padding-left:26.13px; font-size:9.0pt;" type="A">
                            <li>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        Tanggal awal masuk bekerja</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        {{ formatdateindonesian($tnc->tanggalMasukKerja) }}</div>
                                </div>
                            </li>
                            <li>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        Tempat Penerimaan</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">Jakarta</div>
                                </div>
                            </li>
                            <li>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        Tempat Penugasan</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">PT Global
                                        Energi Lestari (Head Office)</div>
                                </div>
                            </li>
                            <li>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        Jabatan Awal</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">{{ $tnc->jabatanAwal }}</div>
                                </div>
                            </li>
                            <li>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        Bertanggung Jawab Kepada</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">{{ $tnc->tanggungjawabKPD }}</div>
                                </div>
                            </li>
                            <li>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        Rincian Upah</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;"></div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">a.
                                        Gaji Pokok</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        _______________________________per bulan</div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">b.
                                        Tunjangan Makan</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        _______________________________per bulan</div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">c.
                                        Tunjangan Transportasi</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        _______________________________per bulan</div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">d.
                                        Tunjangan Operasional</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        _______________________________per bulan</div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">e.
                                        Tunjangan Telekomunikasi</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        _______________________________per bulan
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        <strong>Total THP</strong>
                                    </div>
                                    <div style="margin-right: 10px;"><strong>:</strong></div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">
                                        <strong>__________________________per bulan</strong>
                                    </div>
                                </div>
                            </li>
                        </ol>

                    </ol>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:2.0cm 205.55pt 219.75pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="IN">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">(Komponen Fa, Fb, Fc, Fd, Fe &amp; Ff adalah upah tetap, yang&nbsp;akan
                            digunakan&nbsp; sebagai dasar perhitungan THR).</span>
                    </p>


                    <br><br><br>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;tab-stops:list 18.0pt 36.0pt;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FR"><strong>2. Jangka waktu PKWT</strong></span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;tab-stops:36.0pt;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FR">2.1 PKWT ini berlaku untuk jangka waktu efektif terhitung sejak
                            tanggal {{ formatDateIndonesian($tnc->tanggalMasukKerja) }} sampai dengan tanggal {{ formatDateIndonesian($tnc->endDate) }}
                            <strong>dengan masa penyesuaian diri selama 3 bulan.</strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FR">2.2 Jangka waktu di atas tidak mengurangi hak Perusahaan untuk mempertimbangkan
                            pemberhentian PKWT ini sebelum jangka waktu PKWT berakhir apabila Pekerja melalaikan
                            kewajibannya menurut ketentuan-ketentuan dalam PKWT ini.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FR">2.3. </span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="IN">Perusahaan dapat memperpanjang dan atau memperbaharui PKWT ini berdasarkan
                            penilaian
                            kinerja di periode PKWT sesuai pasal 2.2.1 dan mempertimbangkan kebutuhan tenaga kerja di
                            Perusahaan.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FR">2.4. Perpanjangan dan atau penetapan status karyawan setelah PKWT sesuai pasal
                            2.2.1. akan dilakukan sesuai tata laksana yang berlaku di perusahaan yang mengacu pada
                            undang-undang ketenagakerjaan yang berlaku.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:-18.0pt;">
                        &nbsp;
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;tab-stops:list 18.0pt;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>3. Sifat Pekerjaan</strong></span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt list 36.0pt left 147.6pt;text-align:justify; text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">3.1 Pekerja berkewajiban untuk melakukan semua tugas dalam <i>job
                                description</i> dan tanggung jawabnya dengan baik&nbsp;</span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-right:0cm;margin-left:36.0pt;margin-top:0cm;tab-stops:18.0pt list 36.0pt;text-align:justify; text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">3.2 Pekerja memahami bahwa atas kebutuhan pekerjaan dan perkembangan
                            organisasi Perusahaan, pekerja mungkin diperlukan untuk bekerja pada jenis-jenis
                            pekerjaan atau lokasi/entitas kerja yang berbeda dengan jabatan awal atau lokasi
                            awal apabila Perusahaan menghendaki demikian.</span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt list 36.0pt;text-align:justify; text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">3.3 Pekerja memahami bahwa atas kebutuhan pekerjaan dan perkembangan
                            organisasi Perusahaan, pekerja mungkin diperlukan untuk bekerja di perusahaan
                            yang masih satu grup dan atau anak perusahaan lain dari grup sesuai dengan
                            kebutuhan perusahaan dan atau grup.</span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;margin-left:36.0pt;tab-stops:18.0pt list 36.0pt;text-align:justify; text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">3.4 Pelaksanaan pasal 3.3.2. dan 3.3.3 diatur dalam bentuk kebijakan
                            dan atau petunjuk pelaksanaan yang berlaku di perusahaan yang mengacu pada
                            perundang-undangan ketenagakerjaan yang berlaku.</span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:18.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt;">
                        &nbsp;
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:6pt;margin-left:18.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>4.&nbsp; &nbsp;Pengaturan Hari Kerja dan Jam Kerja
                                Perusahaan</strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:18.0pt;margin-right:0cm;margin-top:0cm;tab-stops:36.0pt;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4.1 Hari Kerja:</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">a.&nbsp;&nbsp; Waktu kerja pekerja diatur sesuai dengan peraturan perundangan
                            ketenagakerjaan yang berlaku, yaitu 40 jam dalam satu minggu dengan waktu kerja per hari adalah
                            8 (Delapan) jam.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">b. &nbsp;&nbsp; Hari kerja adalah 5 hari dan 2 hari libur dalam satu minggu dan
                            diatur dari Hari Senin sampai dengan Jum’at dengan pengaturan jam kerja awal sebagai
                            berikut:</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1. Senin – Jumat
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            : 08.30 – 17.30 WIB</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. Sabtu - Minggu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                            Libur&nbsp;&nbsp;&nbsp;</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">c. &nbsp;&nbsp;&nbsp;PEKERJA sepakat dan setuju bahwa PERUSAHAAN mempunyai
                            kewenangan
                            penuh dalam pengaturan waktu kerja sesuai dengan kebutuhan operasional merujuk pada peraturan
                            perundangan yang berlaku.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:2.0cm;margin-right:0cm;margin-top:0cm;tab-stops:2.0cm;text-indent:-35.4pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">4.2. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Atas jabatannya, PEKERJA, yang karena sifat
                            pekerjaannya, dalam keadaan tertentu dapat bekerja di luar waktu dan melebihi waktu kerja
                            seperti tersebut pada pasal 4.1.a dan pada pasal 4.1.b. tanpa kompensasi pembayaran upah
                            lembur.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:18.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt list 36.0pt;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>5.&nbsp; &nbsp;Pembayaran Upah/Gaji dan Pajak</strong></span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt list 36.0pt left 147.6pt;text-align:justify; text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">5.1 Gaji akan dibayarkan atas hari-hari kerja yang telah dijalani oleh
                            Pekerja melalui bank yang ditunjuk oleh perusahaan dengan waktu yang di atur oleh
                            perusahaan.</span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt list 36.0pt left 147.6pt;text-align:justify; text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">5.2 Pajak Penghasilan merupakan beban Perusahaan dan Perusahaan
                            bertanggungjawab untuk memotong pajak tersebut atau pajak lainnya sesuai dengan
                            Undang-Undang Pajak yang berlaku.</span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt list 36.0pt left 147.6pt;text-align:justify; text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">5.3 Pekerja dipersyaratkan memiliki NPWP pribadi dan pekerja sepakat
                            serta menyetujui atas konsekuensi pribadi pekerja terkait pajak penghasilan jika
                            pekerja tidak memiliki NPWP.</span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt list 36.0pt left 147.6pt;text-align:justify; text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">5.4 Dengan mengacu pada ketentuan pada perundang-undangan yang
                            berlaku pada UU Cipta Kerja No. 11 tahun 2020 pasal 88A tentang Ketenagakerjaan,
                            maka apabila Pekerja tidak masuk kerja tanpa alasan dan atau alat bukti dokumen
                            yang sah yang diatur oleh perusahaan maka Perusahaan berhak untuk memotong gaji
                            Pekerja secara proporsional atau memotong hak cuti karyawan.&nbsp;</span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt list 36.0pt left 147.6pt;text-align:justify; text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">5.5 Dalam hal Pekerja mengajukan pengunduran diri ke perusahaan,
                            maka mengacu pada Pasal 154A UU Undang-undang No. 11 Tahun 2020 tentang
                            Ketenagakerjaan, Pekerja mengajukan permohonan pengunduran diri secara tertulis
                            selambat-lambatnya <strong>30 ( tiga Puluh )</strong> hari sebelum tanggal mulai
                            pengunduran diri tersebut.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt list 36.0pt left 147.6pt;text-align:justify; text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">5.6 Dengan ini Pekerja dan Perusahaan sepakat bahwa dalam hal pasal
                            5.5 tersebut dilanggar, maka gaji Pekerja tidak akan dibayarkan.</span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:list 18.0pt;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:18.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>6. Program BPJS Ketenagakerjaan dan BPJS
                                Kesehatan</strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:40.5pt;margin-right:0cm;margin-top:0cm;tab-stops:40.5pt;text-align:justify;text-indent:-22.5pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">6.1. &nbsp;Pekerja akan dimasukkan sebagai peserta Jaminan Kecelakaan Kerja,
                            Jaminan Kematian dan Jaminan Hari Tua sesuai dengan undang-undang yang berlaku atau sesuai
                            dengan program jaminan yang ditentukan dan diberikan Perusahaan kepada Pekerja.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:40.5pt;margin-right:0cm;margin-top:0cm;tab-stops:40.5pt;text-align:justify;text-indent:-22.5pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">6.2 &nbsp; Pekerja akan dimasukkan sebagai peserta BPJS Kesehatan dengan
                            undang-undang yang berlaku atau sesuai dengan program jaminan yang ditentukan dan diberikan
                            Perusahaan kepada Pekerj</span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="IN">a.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:40.5pt;margin-right:0cm;margin-top:0cm;tab-stops:40.5pt;text-align:justify;text-indent:-22.5pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">6.3. Kebijakan pemberian fasilitas terkait perlindungan kesehatan dan manfaat
                            lainnya diatur berdasarkan kemampuan dan kewajaran kebutuhan perusahaan yang akan diatur oleh
                            perusahaan.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <ol style="padding-left:24px;" start="7">
                        <p
                            style="line-height:150%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;tab-stops:list 18.0pt;text-align:justify; text-indent:-18.0pt;">
                            <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                                lang="EN-GB"><strong>7. Cuti Tahunan Dengan Upah</strong></span>
                        </p>
                    </ol>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;tab-stops:36.0pt;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">7.1&nbsp; Cuti Tahunan dimaksudkan untuk memberi peluang bagi Pekerja untuk
                            berlibur di luar tempat kerja. Setiap Pekerja, berhak atas Cuti Tahunan duabelas (12) hari
                            kalender</span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="IN">.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">7.2&nbsp; Dengan persetujuan tertulis di muka dari Perusahaan, Pekerja dapat
                            mengambil Cuti Tahunan tersebut, setelah Pekerja bekerja selama duabelas (12) bulan
                            berturut-turut.&nbsp;</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:18.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>8. Tunjangan Hari Raya/Keagamaan</strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">8.1 Tiap tahun pada tanggal yang ditentukan oleh Perusahaan, Pekerja
                            yang bermasa kerja minimal tigapuluh (30) hari secara berturut-turut akan
                            diberikan Tunjangan Hari Raya Keagamaan secara proposional.&nbsp;</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">8.2 Pengaturan tata laksana pemberian THR akan mengacu pada
                            peraturan pemerintah yang berlaku.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:18.0pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>9. Kewajiban Pekerja dan tindakan Disiplin</strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;" lang="SV">9.1
                            Semua Pekerja diharapkan untuk menegakkan standar tinggi
                            disiplin di tempat kerja. Standar disiplin akan dibuat dengan jelas agar Pekerja
                            memahami sepenuhnya berbagai harapan/target yang perlu dicapai di
                            Perusahaan.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;" lang="FR">9.2
                            Perusahaan berharap agar tingkat kedisiplinan tinggi ditegakkan atas
                            kesadaran Pekerja sendiri. Meski demikian, Pekerja yang melanggar disiplin dapat dikenai
                            sanksi disiplin. Sanksi disiplin tersebut dapat mengarah pada pemutusan hubungan kerja.
                            Perusahaan berhak menentukan penilaian atas tingkat keseriusan pelanggaran dan bobot
                            sanksi yang dikenakan.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;" lang="FR">9.3
                            Tindakan disiplin dapat disusun untuk mencapai tujuan
                            berikut&nbsp;:</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-indent:-18.0pt;">
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;" lang="FR">a)
                            Mendidik Pekerja yang melanggar.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-indent:-18.0pt;">
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;" lang="FR">b)
                            Mengamankan investasi dan aset Perusahaan, serta memastikan agar
                            kegiatan bisnis Perusahaan berlangsung efektif dan efisien.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-indent:-18.0pt;">
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;" lang="FR">c)
                            Mencegah pengulangan pelanggaran oleh pekerja.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-indent:-18.0pt;">
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;" lang="FR">d)
                            Menciptakan suasana lingkungan kerja yang kondusif.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;" lang="FR">9.4
                            Semua arsip Pekerja termasuk sanksi disiplin yang masih berlaku
                            dan berkaitan dengan pelanggaran Peraturan kerja, kehadiran , dan kinerja
                            pekerja dapat dijadikan bahan pertimbangan dalam proses kenaikan
                            pangkat/jabatan. Arsip-arsip tersebut dapat mencakup semua surat peringatan yang
                            baru maupun yang lama.</span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:45.0pt;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>10. Berakhirnya Perjanjian Kerja</strong>&nbsp;</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:31.5pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt;text-autospace:none;text-indent:-13.5pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-US">Perjanjian kerja berakhir apabila:</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:31.5pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt 31.5pt;text-autospace:none;text-indent:-13.5pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-US">a. &nbsp;Pekerja meninggal dunia;</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:31.5pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt;text-autospace:none;text-indent:-13.5pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-US">b. &nbsp;Berakhirnya jangka waktu perjanjian kerja;</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:31.5pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt;text-align:justify;text-autospace:none;text-indent:-13.5pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-US">c. &nbsp;Adanya putusan pengadilan dan/atau putusan atau penetapan lembaga
                            penyelesaian perselisihan hubungan industrial yang telah mempunyai kekuatan hukum tetap;
                            atau</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:31.5pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt;text-align:justify;text-autospace:none;text-indent:-13.5pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-US">d. &nbsp;Adanya keadaan atau kejadian tertentu yang dicantumkan dalam perjanjian
                            kerja ini,peraturan perusahaan, atau Kebijakan perusahaan yang dapat menyebabkan berakhirnya
                            hubungan kerja.</span>
                    </p>
                    <p
                        style="margin-bottom:0cm;margin-left:31.5pt;margin-right:0cm;margin-top:0cm;tab-stops:18.0pt;text-autospace:none;text-indent:-13.5pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>&nbsp; 11. Pemutusan PKWT</strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:49.5pt;margin-right:0cm;margin-top:0cm;tab-stops:49.5pt;text-align:justify;text-indent:-27.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">11.1.&nbsp; &nbsp;Perusahaan dapat memutuskan PKWT ini, apabila Pekerja tidak
                            mampu menunjukkan kinerja kerja yang tidak memenuhi ekspektasi Perusahaan berdasarkan penilaian
                            yang objektif dari atasan langsung Pekerja.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:49.5pt;margin-right:0cm;margin-top:0cm;tab-stops:49.5pt;text-align:justify;text-indent:-27.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">11.2. &nbsp;Pemutusan PKWT sebagaimana dimaksud diatas tidak mewajibkan
                            Perusahaan untuk mengajukan permohonan ijin pemutusan PKWT ke pengadilan ataupun instansi
                            pemerintah terkait lainnya.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:49.5pt;margin-right:0cm;margin-top:0cm;tab-stops:45.0pt 49.5pt;text-align:justify;text-indent:-27.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">11.3. &nbsp;Pekerja tidak dapat menuntut kepada Perusahaan berupa uang pesangon
                            atau ganti kerugian, apapun nama dan jenisnya, sebagai akibat dari pemutusan PKWT, kecuali hak
                            atas gaji pada bulan yang sedang berjalan.&nbsp;</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:49.5pt;margin-right:0cm;margin-top:0cm;tab-stops:45.0pt 49.5pt;text-align:justify;text-indent:-27.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">11.4.&nbsp; Perusahaan dapat memberikan denda atas pembayaran sisa masa kerja,
                            apabila Pekerja tidak menyelesaikan secara penuh masa kerjanya sesuai PKWT dengan masa tunggu
                            kurang dari 30 (tiga puluh) hari.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:49.5pt;margin-right:0cm;margin-top:0cm;tab-stops:45.0pt 49.5pt;text-align:justify;text-indent:-27.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">11.5&nbsp;Jika terjadi indikasi Fraud maka Pekerja wajib memberikan ijin kepada
                            manajemen perusahaan untuk membuka dan melihat rekening bank, whatsapp, panggilan telpon, sms
                            serta email pribadi jika dibutuhkan pada saat pemeriksaan lebih lanjut.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:49.5pt;margin-right:0cm;margin-top:0cm;tab-stops:45.0pt 49.5pt;text-align:justify;text-indent:-27.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">11.6&nbsp; Pekerja bersedia/ berjanji tidak menghasut, memprovokasi dan membuat
                            keonaran yang merugikan perusahaan, apabila hal tersebut terjadi maka bersedia menanggung biaya
                            yang timbul akibat tindakan pekerja yang bersangkutan.&nbsp;</span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:21.75pt;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>12.&nbsp; Penyelesaian Perselisihan</strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:49.5pt;margin-right:0cm;margin-top:0cm;tab-stops:49.5pt;text-align:justify;text-indent:-27.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">12.1. &nbsp;Semua perselisihan yang timbul sehubungan dengan berlakunya PKWT ini
                            akan diselesaikan secara musyawarah oleh Para Pihak.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:49.5pt;margin-right:0cm;margin-top:0cm;tab-stops:49.5pt;text-align:justify;text-indent:-27.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">12.2. &nbsp;Apabila musyawarah dimaksud tidak mencapai kata sepakat maka
                            perselisihan akan diselesaikan secara hukum dan oleh karena itu Para Pihak telah sepakat dan
                            setuju untuk memilih domisili hukum yang umum dan tetap di Kepaniteraan Pengadilan Hubungan
                            Industrial pada Pengadilan Negeri di wilayah domisili para pihak.&nbsp;</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:49.5pt;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:21.75pt;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>13.&nbsp; Pernyataan Tunduk </strong>:</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-align:justify;text-indent:-31.5pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">13.1.&nbsp; &nbsp; Pekerja dengan ini menyatakan telah memahami serta menyetujui
                            sepenuhnya ketentuan-ketentuan dalam PKWT ini dan menyatakan bersedia untuk melaksanakannya
                            dengan sungguh-sungguh dan penuh tanggung jawab.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-align:justify;text-indent:-31.5pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">13.2.&nbsp;&nbsp; Pengangkatan dan pemberhentian Pekerja merupakan hak
                            prerogatif Perusahaan dan Pekerja tidak dapat dan tidak berhak untuk mempengaruhi Perusahaan
                            dengan cara apapun juga.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-align:justify;text-indent:-31.5pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>14.</strong><strong><u>Penutup</u></strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:49.65pt;margin-right:0cm;margin-top:0cm;tab-stops:49.65pt;text-align:justify;text-indent:-1.0cm;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">14.1. Hal-hal yang belum diatur dalam perjanjian, akan diatur kemudian
                            dan apabila terdapat kekeliruan akan diadakan perubahan sebagaimana mestinya dengan berpedoman
                            pada perundang-undangan yang berlaku</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:49.65pt;margin-right:0cm;margin-top:0cm;tab-stops:49.65pt;text-align:justify;text-indent:-1.0cm;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">14.2. Perjanjian kerja ini dicetak dua rangkap dan ditandatangani para
                            pihak di mana masing-masing rangkap yang sudah ditandatangani mempuyai kekuatan yang sama secara
                            hukum.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:18.75pt;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">Demikian PKWT ini dibuat dan ditandatangani atas kehendak bebas Para Pihak dalam
                            rangkap dua dimana masing-masing mempunyai kekuatan hukum yang sama.</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>PT GLOBAL ENERGI LESTARI&nbsp;&nbsp;&nbsp;&nbsp; </strong></span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="IN"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB"><strong>Pekerja, &nbsp; &nbsp; &nbsp;</strong></span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;</span>
                    </p>
                    @if ($tnc->approve == '1')
                    <table width="600" style="font-weight:bold;">
                        <tr>
                            <td><img style="height:125px; weigth:125px;padding-left: 100px;"
                                    src="{{ asset('img/qrcodes/' . $tnc->qr) }}" alt="QR Code"></td>
                        </tr>
                    </table>

                @endif
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;letter-spacing:-.05pt;line-height:150%;"
                            lang="IN"><strong><u>Tuty Alawiyah,
                                    M.M.</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;</strong></span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;letter-spacing:-.05pt;line-height:150%;"
                            lang="EN-US"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                            <span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;letter-spacing:-.05pt;line-height:150%;"
                            lang="SV"><strong>{{ $tnc->namaKaryawan }}&nbsp; &nbsp; &nbsp;</strong></span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;letter-spacing:-.05pt;line-height:150%;"
                            lang="IN"><strong>Corporate Talent and Culture Manager</strong></span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;letter-spacing:-.05pt;line-height:150%;"
                            lang="EN-US"><strong>&nbsp; </strong></span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;letter-spacing:-.05pt;line-height:150%;"
                            lang="IN"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </strong></span>
                    </p>

                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                        align="center">
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"
                            lang="EN-GB"><strong><u>
                                    <o:p><span style="text-decoration:none;"> </span></o:p>
                                </u></strong></span>
                    </p>
                    <p style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <s><span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;" lang="EN-US">
                                <o:p><span style="text-decoration:none;"> </span></o:p>
                            </span></s>
                    </p>

                </div>
                @if ($tnc->kop !== null && file_exists(public_path('img/' . $tnc->kop . '-bottom-kop.png')))
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $tnc->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>
        </div>
    @endif


    @if ($tnc->idPerihal == '7')
        <!-- Surat Permohonan -->

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

        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $tnc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style="padding-left:1in; padding-right:1in;">

                    <p style="line-height:150%;margin-bottom:10pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                        align="center">
                        <a name="_Hlk132725798"><span
                                style="font-family:&quot;Cambria&quot;,serif;font-size:16.0pt;line-height:150%;"
                                lang="EN-US"><strong><u>SURAT PERMOHONAN</u></strong></span></a>
                    </p>
                    <p style="line-height:150%;margin-bottom:10pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                        align="center">
                        <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;"
                            lang="EN-US">{{ $tnc->prefix }}</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                        &nbsp;
                    </p>

                    {!! $tnc->keterangan !!}

                    <p
                        style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                        &nbsp;
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                        <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;"
                            lang="EN-US">{{ $tnc->tmptTGL }},&nbsp;</span><span
                            style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;"
                            lang="IN">{{ formatdateindonesian($tnc->tglSurat) }}</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                        <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;"
                            lang="EN-US"><strong>
                                @if ($tnc->kop == 'KKS')
                                    PT.Kelinci Karya Sampoerna,
                                    @endif @if ($tnc->kop == 'GEL')
                                        PT.Global Energi Lestari,
                                    @endif
                            </strong></span><span
                            style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;"
                            lang="EN-US"></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                        &nbsp;
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                        <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;"
                            lang="EN-US"><strong><u>
                                    <o:p><span style="text-decoration:none;"> </span></o:p>
                                </u></strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                        <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;"
                            lang="EN-US"><strong><u>
                                    <o:p><span style="text-decoration:none;"> </span></o:p>
                                </u></strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                        <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;"
                            lang="EN-US"><strong><u>
                                    <o:p><span style="text-decoration:none;"> </span></o:p>
                                </u></strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                        <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;"
                            lang="EN-US"><strong><u>Tuty Alawiyah, M.M</u></strong>.</span>
                    </p>
                    <p style="line-height:115%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <i><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">Corporate H</span><span
                                style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:115%;"
                                lang="IN">uman&nbsp;</span><span
                                style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US">R</span><span
                                style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:115%;"
                                lang="IN">esources</span><span
                                style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:115%;"
                                lang="EN-US"> Manager</span></i>
                    </p>
                    <p style="line-height:115%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        &nbsp;
                    </p>


                </div>
                @if ($tnc->kop !== null && file_exists(public_path('img/' . $tnc->kop . '-bottom-kop.png')))
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $tnc->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>
        </div>
    @endif


    @if ($tnc->idPerihal == '8')
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

        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $tnc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style="padding-left:1in; padding-right:1in;">

                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US">{{ $tnc->tmptTGL }}, {{ formatDateIndonesian($tnc->tglSurat) }}</span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;" lang="EN-US">
                            To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;</span>
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="IN">{{ $tnc->prefix }}</span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US">Re&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : SURAT
                            PENAWARAN KERJA (OFFERING LETTER)</span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        &nbsp;
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <span style="color:#262626;font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US"><strong><u>PRIVATE &amp; CONFIDENTIAL</u></strong></span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="IN"><strong>{{ $tnc->namaKaryawan }}</strong></span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <a name="_Hlk154664585"><span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                lang="IN">{{ $tnc->alamat }}</span></a>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        &nbsp;
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;" lang="EN-US">Yang
                            terhormat&nbsp;</span><span
                            style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;" lang="IN">
                            @if ($tnc->jenisKelamin == 'Laki-Laki')
                                Bapak
                            @else()
                                Ibu
                            @endif{{ $tnc->namaKaryawan }},
                        </span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:111.0pt;">
                        <i><span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                lang="EN-US">Dear </span><span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;" lang="IN">
                                @if ($tnc->jenisKelamin == 'Laki-Laki')
                                    Mr.
                                @else()
                                    Ms.
                                @endif {{ $tnc->namaKaryawan }},
                            </span></i>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        &nbsp;
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:111.0pt;">
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US">Sehubungan dengan proses rekrutmen karyawan atas nama&nbsp;</span><i><span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                lang="IN">{{ $tnc->namaKaryawan }}</span></i><span
                            style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US"><strong>,&nbsp;</strong>maka kami memberikan surat penawaran kerja yang terkait
                            dengan posisi yang dimaksud, sehingga mampu memberikan kontribusi atas kemampuan dan pengalaman
                            kerja Anda terhadap pertumbuhan perusahaan sebagai berikut:</span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <i><span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                lang="EN-US">Refer to the recruitment process under name&nbsp;</span><span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                lang="IN">{{ $tnc->namaKaryawan }}</span><span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;" lang="EN-US">
                                we would like to offer you the following position, we feel confident that you will
                                contribute your skills and experience towards the growth of our company:</span></i>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        &nbsp;
                    </p>
                    <div style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;">
                        <div style="display: flex; align-items: center;">
                            <div style="width: 230px;">1. Tanggal Masuk kerja (Joint Date)</div>
                            <div style="margin-right: 10px;">:</div>
                            <div>{{ $tnc->tanggalMasukKerja }}</div>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <div style="width: 230px;">2. Jabatan (Position)</div>
                            <div style="margin-right: 10px;">:</div>
                            <div>{{ $tnc->jabatan }}</div>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <div style="width: 230px;">3. Masa Kontrak Kerja (Working Period)</div>
                            <div style="margin-right: 10px;">:</div>
                            <div>{{ formatDateIndonesian($tnc->masakontrakAwal) }} -
                                {{ formatDateIndonesian($tnc->masakontrakAkhir) }} (3 bulan masa penyesuaian diri)</div>
                        </div>
                    </div>

                    <figure class="table">
                        <table style="border-collapse:collapse;border-style:none;" border="1" cellspacing="0"
                            cellpadding="0">
                            <tbody>
                                <tr>
                                    <td style="background-color:#D9D9D9;border-color:windowtext;border-width:1.0pt;padding:0cm 5.4pt;vertical-align:top;width:26.55pt;"
                                        width="35">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <a name="_Hlk106808595"><span
                                                    style="color:black;font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                                    lang="EN-US"><strong>No</strong></span></a>
                                        </p>
                                    </td>
                                    <td style="background-color:#D9D9D9;border-bottom-style:solid;border-color:windowtext;border-left-style:none;border-right-style:solid;border-top-style:solid;border-width:1.0pt;padding:0cm 5.4pt;vertical-align:top;width:228.35pt;"
                                        width="304">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="color:black;font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                                lang="EN-US"><strong>Rincian</strong></span>
                                        </p>
                                    </td>
                                    <td style="background-color:#D9D9D9;border-bottom-style:solid;border-color:windowtext;border-left-style:none;border-right-style:solid;border-top-style:solid;border-width:1.0pt;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;"
                                        width="123">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="color:black;font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                                lang="EN-US"><strong>Nominal</strong></span>
                                        </p>
                                    </td>
                                    <td style="background-color:#D9D9D9;border-bottom-style:solid;border-color:windowtext;border-left-style:none;border-right-style:solid;border-top-style:solid;border-width:1.0pt;padding:0cm 5.4pt;vertical-align:top;width:104.95pt;"
                                        width="140">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="color:black;font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                                lang="EN-US"><strong>Keterangan</strong></span>
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;padding:0cm 5.4pt;vertical-align:top;width:26.55pt;"
                                        width="35">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            &nbsp;
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:228.35pt;"
                                        width="304">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US"><strong>Komponen Gaji (</strong></span><i><span
                                                    style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                    lang="EN-US"><strong>Remuneration package</strong></span></i><span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US"><strong>):</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;"
                                        width="123">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                            &nbsp;
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:104.95pt;"
                                        width="140">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                            &nbsp;
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;padding:0cm 5.4pt;vertical-align:top;width:26.55pt;"
                                        width="35">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">1</span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:228.35pt;"
                                        width="304">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">Gaji Pokok (</span><i><span
                                                    style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                    lang="EN-US">Basic Salary</span></i><span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">)</span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;"
                                        width="123">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:right;"
                                            align="right">
                                            &nbsp;
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:104.95pt;"
                                        width="140">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">Per Bulan</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;padding:0cm 5.4pt;vertical-align:top;width:26.55pt;"
                                        width="35">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">2</span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:228.35pt;"
                                        width="304">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">Tunjangan Makan (</span><i><span
                                                    style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                    lang="EN-US">Meal Allowance</span></i><span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">)</span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;"
                                        width="123">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:right;"
                                            align="right">
                                            &nbsp;
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:104.95pt;"
                                        width="140">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">Per Bulan</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;padding:0cm 5.4pt;vertical-align:top;width:26.55pt;"
                                        width="35">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">3</span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:228.35pt;"
                                        width="304">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">Tunjangan Transportasi (</span><i><span
                                                    style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                    lang="EN-US">Transportation Allowance</span></i><span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">)</span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;"
                                        width="123">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:right;"
                                            align="right">
                                            &nbsp;
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:104.95pt;"
                                        width="140">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">Per Bulan</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;padding:0cm 5.4pt;vertical-align:top;width:26.55pt;"
                                        width="35">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">4</span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:228.35pt;"
                                        width="304">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">Tunjangan Telekomunikasi </span><i><span
                                                    style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                    lang="EN-US">(Telecommunication Allowance</span></i><span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">)</span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;"
                                        width="123">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:right;"
                                            align="right">
                                            &nbsp;
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:104.95pt;"
                                        width="140">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">Per Bulan</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;padding:0cm 5.4pt;vertical-align:top;width:26.55pt;"
                                        width="35">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">5</span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:228.35pt;"
                                        width="304">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">Tunjangan Operasional (</span><i><span
                                                    style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                    lang="EN-US">Operational Allowance</span></i><span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">)</span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;"
                                        width="123">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:right;"
                                            align="right">
                                            &nbsp;
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:104.95pt;"
                                        width="140">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US">Per Bulan</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;padding:0cm 5.4pt;vertical-align:top;width:26.55pt;"
                                        width="35">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            &nbsp;
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:228.35pt;"
                                        width="304">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US"><strong>TOTAL</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;"
                                        width="123">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            &nbsp;
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;padding:0cm 5.4pt;vertical-align:top;width:104.95pt;"
                                        width="140">
                                        <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:center;"
                                            align="center">
                                            <span
                                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:9.0pt;"
                                                lang="EN-US"><strong>Per Bulan</strong></span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </figure>

                    <p style="margin-bottom:0cm;margin-left:18.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>



                    <ol style="font-size:9pt;margin-left:-20px;" start="4">
                        <li>
                            <p
                                style="margin-bottom:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;line-height:150%;">
                                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                    lang="EN-US">
                                    Masa Penilaian Kinerja berupa Indikator Kinerja (<i>Keys Performance Indicator</i>/KPI)
                                    dilakukan setiap bulan selama masa kerja sesuai dengan kebijakan dan peraturan
                                    perusahaan yang berlaku.</span>

                            </p>
                            <p style="margin-bottom:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                                <i><span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                        lang="EN-US">The performance assessment period will be done from Keys
                                        Performance Indicator (KPI)’s achievement every month according to the applicable
                                        regulations in the company.</span></i>
                            </p>
                        </li>
                    </ol>
                    <ol style="font-size:9pt;margin-left:-20px;" start="5">
                        <li>
                            <p style="margin-bottom:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                    lang="EN-US">Apabila karyawan mengajukan pengunduran diri maka masa pemberitahuan
                                    wajib diinformasikan kepada Divisi </span><i><span
                                        style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                        lang="EN-US">Human Resources</span></i><span
                                    style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                    lang="EN-US"> minimal 1 (satu) bulan sebelumnya setelah disetujui oleh Atasan yang
                                    bersangkutan. Karyawan yang tidak memenuhi masa pembertahuan pengunduran diri kurang
                                    dari 1 (satu) bulan maka dikenakan sanksi administratif berupa </span><i><span
                                        style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                        lang="EN-US">penalty</span></i><span
                                    style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                    lang="EN-US"> yaitu membayar sisa masa kontrak kerja yang belum diselesaikan.</span>
                            </p>
                            <p style="margin-bottom:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                                <i><span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                        lang="EN-US">The employee may tender his/her resignation with minimum 1 (one)
                                        month in prior after being approved from Superior and submit it to Human Resources
                                        Division. The penalty of charging the manpower cost occurs will be applied in case
                                        of misconduct of this offer and if the employee tenders his/her resignation less
                                        than 1 (one) month.</span></i>
                            </p>
                        </li>
                        <li>

                            <p style="margin-bottom:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                    lang="EN-US">Karyawan wajib memberikan dedikasi sepenuhnya guna tercapainya tujuan
                                    perusahaam, oleh karena itu karyawan tidak diperkenakan menjalankan bisnis diluar
                                    perusahaan tanpa persetujuan dari Direktur baik secara langsung maupun tidak
                                    langsung.</span>
                            </p>
                            <p style="margin-bottom:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                                <i><span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                        lang="EN-US">You are expected to fully devote yourself for the organization’s
                                        better improvement. Therefore, employee shall not, during the employment, render
                                        services to any other business without the prior approval of the Managing Director
                                        of the company, directly or indirectly.</span></i>
                            </p>
                        </li>
                        <li>

                            <p style="margin-bottom:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                    lang="EN-US">Upah karyawan akan dipotong biaya kepesertaan BPJS Ketenagakerjaan dan
                                    BPJS Kesehatan setelah karyawan bekerja dengan masa kerja 3 (tiga) bulan sesuai dengan
                                    peraturan yang berlaku.</span>
                            </p>
                            <p style="margin-bottom:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                                <i><span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                        lang="EN-US">Monthly Net Salary will be deducted for BPJS Ketenagakerjaan and
                                        BPJS Kesehatan’s membership after 3 months working period with the applicable
                                        regulations.</span></i>
                            </p>
                        </li>
                        <li>
                            <p style="margin-bottom:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                    lang="EN-US">Berdasarkan penunjukan tugas dari Atasan karyawan yang bersangkutan,
                                    maka karyawan wajib menyelesaikan seluruh program dan tugas&nbsp;</span>
                            </p>
                            <p style="margin-bottom:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                                <i><span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                        lang="EN-US">Under the general direction of the official appointed as your
                                        Superior, you will have responsibility to finish all programs and other duties given
                                        by your Superior.</span></i>
                            </p>
                        </li>
                    </ol>

                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US">Mohon memberikan konfirmasi dengan menandatangani surat penawaran kerja ini.
                            Terima kasih atas perhatian Anda.</span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <i><span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                lang="EN-US">Please confirm your acceptance of this offer by signing&nbsp;and returning
                                the copy of the offering letter.</span></i>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        &nbsp;
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US">Selamat bergabung!</span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <i><span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                lang="EN-US">Welcome aboard!</span></i>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        &nbsp;
                    </p>

                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US">Hormat kami (</span><i><span
                                style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                                lang="EN-US">Sincerely</span></i><span
                            style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US">),</span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US">PT. Global Energi
                            Lestari&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Diterima oleh,</span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        &nbsp;
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US"><strong><u>Tuty Alawiyah</u></strong></span><span
                            style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="IN"><strong><u>, M.M</u></strong></span><span
                            style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </strong></span><span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="IN"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $tnc->namaKaryawan }}</strong></span>
                    </p>
                    <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US"><strong>Corporate&nbsp;</strong></span><span
                            style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="IN"><strong>Talent &amp; Culture</strong></span><span
                            style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:10pt;"
                            lang="EN-US"><strong>
                                Manager&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                    </p>
                    <p
                        style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:72.0pt 90.0pt 522.0pt;">
                        &nbsp;
                    </p>

                </div>
                @if ($tnc->kop !== null && file_exists(public_path('img/' . $tnc->kop . '-bottom-kop.png')))
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $tnc->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>
        </div>
    @endif

    @if($tnc->idPerihal == "9")

            <!-- Surat Permohonan Promosi -->

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

            <div id="contentToConvert" class="contentToConvert">
                <div class="page">
                    <div class="header" id="header">
                        <img src="{{ asset('img/' . $tnc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                        <br><br>
                    </div>
                    <div class="header-content" style="padding-left:1in; padding-right:1in;">


                        <div class="container-p9" style="
                            border: 1px solid black;
                            padding: 10px;margin-left: -50px;width:700px;">
                            <div class="header-p9">

                        <table>
                            <tr>
                             <td rowspan="4" style="text-align: center; border:1px solid black;">
                              <img alt="Company Logo" height="100" src="{{ asset('img/' . $tnc->kop . '-Kecil.png') }}" width="200"/>
                             </td>
                             <td colspan="2" width="200px" style="text-align: center; border:1px solid black;">
                              <strong>
                               PERMOHONAN
                               <br/>
                               PROMOSI
                              </strong>
                             </td>
                             <td style="border: 1px solid black;" width="300px" rowspan="4">
                              <table style="font-size: 14px;">
                               <tbody>
                                <tr>
                                 <td width="125px">
                                  Name
                                 </td>
                                 <td>
                                  :
                                 </td>
                                 <td>
                                  {{ $tnc->namaKaryawan }}
                                 </td>
                                </tr>
                                <tr>
                                 <td>
                                  Tgl. Masuk Kerja
                                 </td>
                                 <td>
                                  :
                                 </td>
                                 <td>
                                    {{ formatDateIndonesian($tnc->tanggalMasukKerja) }}
                                 </td>
                                </tr>
                                <tr>
                                 <td>
                                  Jabatan
                                 </td>
                                 <td>
                                  :
                                 </td>
                                 <td>
                                    {{ $tnc->jabatanAwal }}
                                 </td>
                                </tr>
                                <tr>
                                 <td>
                                  Departemen
                                 </td>
                                 <td>
                                  :
                                 </td>
                                 <td>
                                    {{ $tnc->departement}}
                                 </td>
                                </tr>
                               </tbody>
                              </table>
                             </td>
                            </tr>
                            <tr>
                             <td colspan="2" style="text-align: center;border:1px solid black;">

                               PROPOSAL FOR
                               <br/>
                               PROMOTION

                             </td>
                            </tr>
                           </table>
                          </div>
                          <div class="section" style="border-left: 1px solid black;border-right: 1px solid black;">
                           <table class="no-border-table" style="width: 100%; font-size:13px;">
                            <tbody>
                                <tr>
                                    <th colspan="3" style="border-bottom: 1px solid black;text-align:center;">
                                        <br>
                                    </th>
                                   </tr>
                             <tr>
                              <th colspan="3" style="border-bottom: 1px solid black;text-align:center;">
                               <i>DIUSULKAN UNTUK PROMOSI PADA / PROPOSED TO BE PROMOTED :</i>
                              </th>
                             </tr>
                             <tr>
                              <td class="no-border-cell">
                               <u>Jabatan baru</u>
                               <br/>
                               <i>New Position</i>
                              </td>
                              <td style="width:1px;">:</td>
                              <td style="width:400px;">
                               {{ $tnc->jabatanBaru }}
                              </td>
                             </tr>
                             <tr>
                              <td class="no-border-cell">
                               <u>Bagian</u>
                               <br/>
                               <i>Department</i>
                              </td>
                              <td style="width:1px;">:</td>
                              <td style="width:400px;">
                                {{ $tnc->departementBaru }}
                              </td>
                             </tr>
                             <tr>
                              <td class="no-border-cell">
                                <u>Alasan</u>
                               <br/>
                               <i>Reason</i>
                              </td>
                              <td style="width:1px;">:</td>
                              <td style="width:400px;">
                                {{ $tnc->alasan }}
                              </td>
                             </tr>
                             <tr>
                              <td class="no-border-cell">
                                <u> Mulai tanggal</u>
                               <br/>
                               <i>Starting from</i>
                              </td>
                              <td style="width:1px;">:</td>
                              <td style="width:400px;">
                               {{ formatDateindonesian($tnc->startingDate) }}
                              </td>
                             </tr>
                            </tbody>
                           </table>
                          </div>
                          <div class="section" style="border: 1px solid black;">
                           <table style="font-size:13px;">
                            <tr>
                             <td width="400px">
                              Diajukkan oleh / Proposed by :
                              <br><br><br><br><br>
                             </td>
                             <td>
                              Dikonfirmasi Oleh / Confirmed by :
                              <br><br><br><br><br>
                             </td>
                            </tr>

                            <tr>
                             <td>
                              Corporate TC Manager
                              <br class="spaced-br"/>
                              Tanggal / Date :
                             </td>
                             <td>
                              Direktur / Penanggung Jawab Unit Usaha
                              <br/>
                              Tanggal / Date :
                             </td>
                            </tr>
                           </table>
                          </div>
                          <div class="section" style="border: 1px solid black;">
                           <table style="width: 650px; font-size:13px;">
                            <tr>
                             <th colspan="2" style="border-bottom:1px solid black;text-align:center;">
                              Diisi oleh Bagian Sumber Daya Manusia / To be filled by Human Resources Department
                             </th>
                            </tr>
                            <tr>
                             <td style="border-right:1px solid black;">
                              <strong>SEKARANG</strong> / PRESENT
                             </td>
                             <td>
                              <strong>DIUSULKAN</strong> / PROPOSED
                             </td>
                            </tr>
                            <tr>
                             <td style="border-right:1px solid black;">
                              Gaji Pokok
                              <br/>
                              Tunjangan Makan
                              <br/>
                              Tunjangan Jabatan
                              <br/>
                              Tunjangan Transportasi
                              <br/>
                              Tunjangan Telekomunikasi
                              <br/>
                              Tunjangan Operasional
                              <br/>
                              <strong>Total</strong>
                             </td>
                             <td>
                              Gaji Pokok
                              <br/>
                              Tunjangan Makan
                              <br/>
                              Tunjangan Jabatan
                              <br/>
                              Tunjangan Transportasi
                              <br/>
                              Tunjangan Telekomunikasi
                              <br/>
                              Tunjangan Operasional
                              <br/>
                              <strong>Total</strong>
                             </td>
                            </tr>
                        </table>
                    </div>
                    <div class="section" style="border: 1px solid black;">
                        <table style="font-size:13px;">
                                   <tr>
                                    <td colspan="2" style="border-right:1px solid black;width:325px;">
                                     Dikonfirmasi Oleh / <i>Confirmed by :</i>
                                    </td>
                                    <td colspan="2">
                                        Disetujui oleh / <i>Approved by :</i>
                                    </td>
                                   </tr>
                                   <tr>
                                    <td style="padding-right:100px;">
                                     <br/><br><br><br>
                                     Dept. Head
                                     <br/>
                                     Tanggal / <i>Date :</i>
                                    </td>
                                    <td style="border-right:1px solid black; padding-right:10px;">
                                        <br><br><br><br>
                                        Corp. TC Manager
                                        <br/>
                                        Tanggal / Date :
                                    </td>
                                    <td style="padding-right:100px;">
                                        <br/><br><br><br>
                                        Business Controller
                                        <br/>
                                        Tanggal / <i>Date :</i>
                                       </td>
                                       <td>
                                           <br><br><br><br>
                                           DIREKTUR
                                           <br/>
                                           Tanggal / Date :
                                       </td>
                                   </tr>
                               </table>

                        </div>
                           </div>




        </div>
        @if ($tnc->kop !== null && file_exists(public_path('img/' . $tnc->kop . '-bottom-kop.png')))
            <div class="footer-page">
                <img src="{{ asset('img/' . $tnc->kop . '-bottom-kop.png') }}"
                    style="max-width: 100%; height: auto;">
            </div>
        @endif
        </div>
        </div>
    @endif


    @if ($tnc->idPerihal == '10')
    <!-- BPJS -->
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

    <div id="contentToConvert" class="contentToConvert">
        <div class="page">
            <div class="header" id="header">
                <img src="{{ asset('img/' . $tnc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                <br><br>
            </div>
            <div class="header-content" style="padding-left:1in; padding-right:1in;">


                <div class="WordSection1" style="page:WordSection1;">
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        <span style="font-family:Calibri, sans-serif;font-size:11pt;"><span lang="IN" dir="ltr">{{ $tnc->tmptTGL }},&nbsp;</span><span lang="EN-US" dir="ltr">{{ formatDateIndonesian($tnc->tglSurat) }}</span></span>
                    </p>
                    <p style="line-height:107%;margin:0cm;tab-stops:35.45pt;">
                        <span style="font-family:Calibri, sans-serif;font-size:11pt;"><span lang="IN" dir="ltr">No  : {{ $tnc->prefix }}</span>
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;tab-stops:35.45pt;">
                        <span style="font-family:Calibri, sans-serif;font-size:11pt;"><span lang="IN" dir="ltr">Re : SURAT PEMANGGILAN <span style="text-transform:uppercase;">{{ $tnc->suratPanggilan }}</span></span></span>
                    </p>
                    <br><br>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        <span style="color:white;font-family:Calibri, sans-serif;font-size:11pt;"><span style="text-effect:outline;" lang="EN-US" dir="ltr"><strong><u>PRIVATE &amp; CONFIDENTIAL</u></strong></span></span>
                    </p>
                    <p style="line-height:107%;margin:0cm;">
                        <span style="font-family:Calibri, sans-serif;font-size:11pt;"><span lang="IN" dir="ltr"><strong>Kepada Yth.</strong></span></span>
                    </p>
                    <p style="line-height:107%;margin:0cm;">
                        <span style="font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>{{ $tnc->namaKaryawan }}</strong></span></span>
                    </p>
                    <p style="line-height:107%;margin:0cm;">
                        <span style="font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>{{ $tnc->jabatan }}</strong></span></span>
                    </p>
                    <p style="line-height:107%;margin:0cm;">
                        <span style="font-family:Calibri, sans-serif;font-size:11pt;"><span lang="IN" dir="ltr"><strong>PT Global&nbsp;</strong></span><span lang="EN-US" dir="ltr"><strong>Energi&nbsp;Lestari</strong></span></span>
                    </p>
                    <p style="line-height:107%;margin:0cm;">
                        <span style="font-family:Calibri, sans-serif;font-size:11pt;"><span lang="IN" dir="ltr"><strong>Di tempat</strong></span></span>
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        &nbsp;
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        {!! $tnc->keterangan !!}
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        &nbsp;
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        &nbsp;
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        &nbsp;
                    </p>
                    <p style="line-height:107%;margin:0cm;">
                        <span style="font-family:Calibri, sans-serif;font-size:11pt;"><span lang="IN" dir="ltr">Hormat kami (</span><i><span lang="IN" dir="ltr">Sincerely</span></i><span lang="IN" dir="ltr">),</span></span>
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        <span style="font-family:Calibri, sans-serif;font-size:11pt;"><span lang="IN" dir="ltr">PT. Global Energi Lestari</span></span>
                    </p>
                    <p style="line-height:normal;margin:0cm;text-autospace:none;">
                        &nbsp;
                    </p>
                    <p style="line-height:normal;margin:0cm;text-autospace:none;">
                        &nbsp;
                    </p>
                    <p style="line-height:normal;margin:0cm;text-autospace:none;">
                        &nbsp;
                    </p>
                    <p>
                        <span style="font-family:Calibri, sans-serif;font-size:11pt;"><strong><u>Tuty Alawiyah, M.M</u></strong></span><br>
                        <span style="font-family:Calibri, sans-serif;font-size:11pt;"><strong>Corporate Talent &amp; Culture Manager</strong></span>
                    </p>
                    <p style="line-height:normal;margin:0cm;text-autospace:none;">
                        &nbsp;
                    </p>
                    <p style="line-height:normal;margin:0cm;text-autospace:none;">
                        &nbsp;
                    </p>
                </div>
                <div class="page-break" style="page-break-after:always;">
                    <span style="display:none;">&nbsp;</span>
                </div>

                <div class="WordSection1" style="page:WordSection1;">
                    <p style="line-height:107%;margin:0cm 0cm 8pt;text-align:center;">
                        &nbsp;
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;text-align:center;">
                        <span style="font-family:Calibri, sans-serif;font-size:14.0pt;"><span style="line-height:107%;" lang="IN" dir="ltr"><strong>TANDA TERIMA</strong></span></span>
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;text-align:center;">
                        &nbsp;
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;text-align:center;">
                        &nbsp;
                    </p>

                    <table>
                        <tr>
                            <td width="200px">
                                Nama
                            </td>
                            <td>
                                :
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tanggal
                            </td>
                            <td>
                                :
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jam
                            </td>
                            <td>
                                :
                            </td>
                        </tr>
                    </table>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        &nbsp;
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        <span style="font-family:&quot;AAAAAC+Calibri&quot;,sans-serif;font-size:11.5pt;"><span style="line-height:107%;" lang="IN" dir="ltr">Telah dokumen surat pemanggilan pertama atas nama&nbsp;</span><span style="line-height:107%;" lang="EN-US" dir="ltr">{{ $tnc->namaKaryawan }}</span><span style="line-height:107%;" lang="IN" dir="ltr"> dengan nomor surat&nbsp;</span></span><span style="font-family:&quot;AAAAAG+Calibri-Light&quot;,sans-serif;font-size:11pt;"><span lang="IN" dir="ltr">{{ $tnc->prefix }}.</span></span>
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        &nbsp;
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        &nbsp;
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        &nbsp;
                    </p>
                    <p style="line-height:107%;margin:0cm 0cm 8pt;">
                        &nbsp;
                    </p>

                    <table>
                        <tr>
                            <td width="450px">
                            Diberikan oleh,
                            </td>
                            <td style="text-align: center;">
                               Diterima oleh,
                            </td>
                        </tr>
                        <tr height="150px">
                            <td><br></td>
                        </tr>
                        <tr>
                            <td width="450px">
                                (….……………….………………)
                                </td>
                                <td style="text-align: right;">
                                    (….……………….………………)
                                </td>
                        </tr>
                    </table>
                </div>


    </div>
    @if ($tnc->kop !== null && file_exists(public_path('img/' . $tnc->kop . '-bottom-kop.png')))
        <div class="footer-page">
            <img src="{{ asset('img/' . $tnc->kop . '-bottom-kop.png') }}"
                style="max-width: 100%; height: auto;">
        </div>
    @endif
    </div>
    </div>
@endif

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const documentContainer = document.getElementById('contentToConvert');
        const pageHeight = 900; // Height of A4 in mm

        function paginateContent() {
            const pages = Array.from(document.querySelectorAll('.page'));

            pages.forEach(page => {
                let content = page.querySelector('.header-content');
                let contentHeight = content.scrollHeight;

                while (contentHeight > pageHeight) {
                    // Create a new page
                    let newPage = document.createElement('div');
                    newPage.className = 'page';

                    // Clone the header for the new page
                    let headerClone = document.querySelector('.header').cloneNode(true);
                    let footerClone = document.querySelector('.footer-page').cloneNode(true);
                    newPage.appendChild(headerClone);

                    let newContent = document.createElement('div');
                    newContent.className = 'header-content';

                    // Move overflowing content to the new page
                    while (content.scrollHeight > pageHeight && content.lastChild) {
                        newContent.insertBefore(content.lastChild, newContent.firstChild);
                    }

                    // Append the new content to the new page
                    newPage.appendChild(newContent);
                    newPage.appendChild(footerClone);
                    documentContainer.appendChild(newPage);

                    // Recalculate content height for the current page
                    contentHeight = content.scrollHeight;
                    paginateContent();
                }
            });
        }

        paginateContent();

        document.getElementById('download-pdf').addEventListener('click', async function() {
            let pages = document.getElementById('contentToConvert').querySelectorAll('.page')
            pages.forEach(page => {
                page.style.border = 'none';
            });
            const element = document.getElementById('contentToConvert');
            const opt = {
                filename: '{{ $tnc->idPerihal == 6 ? "PKWT - " . $tnc->namaKaryawan : "document tnc" }}.pdf',
                margin: [-0.05, -100],
                html2canvas: {
                    scale: 3,
                    backgroundColor: '#ffffff'
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            // Generate the PDF
            await html2pdf().from(element).set(opt).save();
            pages.forEach(page => {
                page.style.border = '1px solid #D3D3D3';
            });
        });

    });
</script>
