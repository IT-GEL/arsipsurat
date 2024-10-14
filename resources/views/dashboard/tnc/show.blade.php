@extends('dashboard.layouts.main')

@section('container')

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
    <?php \Carbon\Carbon::setLocale('id'); ?>

    @if ($tnc->idPerihal == '1')
        <!-- Surat Internal Memo -->
        <!-- Recent Sales Start -->

        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="/dashboard/tnc" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
                Kembali</a>
            {{-- <a href="/dashboard/tnc/{{ $tnc->id }}/cetak" class="btn btn-secondary" target="_blank"><i
                    class="bi bi-printer"></i> Cetak</a> --}}
            <button id="download-pdf" class="btn btn-primary">Cetak</button>
        </div>
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $tnc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content">
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
            <a id="backBtn" href="/dashboard/tnc" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
                Kembali</a>
            {{-- <a href="/dashboard/tnc/{{ $tnc->id }}/cetak" class="btn btn-secondary" target="_blank"><i
                    class="bi bi-printer"></i> Cetak</a> --}}
            <button id="download-pdf" class="btn btn-primary">Cetak</button>
        </div>
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $tnc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content">
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
                            <td style="text-align: left"><u><b>{{ $tnc->tujuanSurat }}</b></u></td>
                        </tr>
                        <tr>
                            <td style="text-align: left">Di Tempat</td>
                        </tr>
                    </table>
                    <br>
                    <table class="table-keterangan" width="615">
                        <tr>
                            <td style="border: 0px;">{!! $tnc->keterangan !!}</td>
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
            <a id="backBtn" href="/dashboard/tnc" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
                Kembali</a>
            {{-- <a href="/dashboard/tnc/{{ $tnc->id }}/cetak" class="btn btn-secondary" target="_blank"><i
                    class="bi bi-printer"></i> Cetak</a> --}}
            <button id="download-pdf" class="btn btn-primary">Cetak</button>
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
                            lang="EN-US">Adalah benar karyawan kami yang telah bekerja pada @if($tnc->kop == 'KKS')PT Kelinci Karya Sampoerna @endif
                            terhitung tanggal <strong>{{ formatDateIndonesian($tnc->startingDate) }} – {{ formatDateIndonesian($tnc->endDate) }}</strong> Sebagai </span><i><span
                                style="font-family:Calibri, sans-serif;font-size:12.0pt;line-height:150%;"
                                lang="EN-US"><strong>{{  $tnc->jabatan }}</strong></span></i><span
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
            <!-- Recent Sales End -->
    @endif

    @if ($tnc->idPerihal == '4')
        <!-- SURAT MUTASI -->

        <div class="WordSection1" style="page:WordSection1;">
            <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                &nbsp;
            </p>
            <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                &nbsp;
            </p>
            <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                &nbsp;
            </p>
            <p style="margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
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
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                    lang="EN-US">Jakarta, 02 Desember 2022&nbsp;</span>
            </p>
            <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                    lang="EN-US">No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 002/GEL/HR-SM/XII/2022</span>
            </p>
            <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
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
            <p
                style="line-height:115%;margin-bottom:12.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                    lang="EN-US">Kami memberitahukan bahwa mutasi karyawan antar departemen PT Global Energi Lestari
                    dengan rincian sebagai berikut,</span>
            </p>
            <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                    lang="EN-US">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    : Mardiah Nuraeni</span>
            </p>
            <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                    lang="EN-US">NIK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    : 3174014408840009</span>
            </p>
            <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                    lang="EN-US">ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    : LE202210005</span>
            </p>
            <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                    lang="EN-US">Jabatan Awal / Dept &nbsp;&nbsp; : </span><i><span
                        style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                        lang="EN-US">Finance Staff / Finance</span></i>
            </p>
            <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                    lang="EN-US">Jabatan Baru / Dept&nbsp;&nbsp;&nbsp; : </span><i><span
                        style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                        lang="EN-US">Controller / Accounting</span></i>
            </p>
            <p style="line-height:115%;margin-bottom:12.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
                    lang="EN-US">Tanggal Efektif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 5
                    Desember 2022</span>
            </p>
            <p style="line-height:115%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:115%;"
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
            <p style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:150%;"
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
                <span style="font-family:&quot;Calibri Light&quot;,sans-serif;font-size:12.0pt;line-height:150%;"
                    lang="EN-US"><strong>Corporate HR
                        Manager&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        General Manager</strong></span>
            </p>
        </div>
        <p>
            <br>
            &nbsp;
        </p>
        <p style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
            &nbsp;
        </p>
    @endif


    @if ($tnc->idPerihal == '5')
        <!-- SURAT TUGAS -->

        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="/dashboard/tnc" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
                Kembali</a>
            {{-- <a href="/dashboard/tnc/{{ $tnc->id }}/cetak" class="btn btn-secondary" target="_blank"><i
                    class="bi bi-printer"></i> Cetak</a> --}}
            <button id="download-pdf" class="btn btn-primary">Cetak</button>
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
                                : SASKYA YOZI SAPUTRI</span>
                        </li>
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;line-height:115%;"
                            lang="IN">NIK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            : 3273054610870002</span>
                        <br>
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;line-height:115%;"
                            lang="IN">Divisi&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            : Operations</span>
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
        </p>                    <p
        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
        &nbsp;
    </p>


                    <p
                        style="line-height:normal;margin-bottom:0cm;margin-left:0cm;margin-right:-2.3pt;margin-top:0cm;tab-stops:0cm 9.0cm;text-align:justify;">
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;"
                            lang="IN"><strong><u>@if($tnc->divisi == 'Operation')Ervina
                                    Wijaya @endif</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <u>Tuty Alawiyah</u></strong></span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:-2.3pt;margin-top:0cm;tab-stops:9.0cm;text-align:justify;">
                        <span style="font-family:&quot;Times New Roman&quot;,serif;font-size:12.0pt;line-height:150%;"
                            lang="IN"><strong>@if($tnc->divisi == 'Operation')Corporate MSS @endif
                                Manager&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Corporate Talent &amp; Culture Manager</strong></span>
                    </p>


                </div>
                @if ($tnc->kop !== null && file_exists(public_path('img/' . $tnc->kop . '-bottom-kop.png')))
                <div class="footer-page">
                    <img src="{{ asset('img/' . $tnc->kop . '-bottom-kop.png') }}"
                        style="max-width: 100%; height: auto;">
                </div>
            @endif
            </div>
            <!-- Recent Sales End -->
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
                filename: 'document.pdf',
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
