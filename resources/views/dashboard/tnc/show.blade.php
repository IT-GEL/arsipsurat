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
            <!-- Recent Sales End -->
    @endif

    @if ($tnc->idPerihal == '4')
        <!-- SURAT MUTASI -->

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
            <!-- Recent Sales End -->
    @endif


    @if ($tnc->idPerihal == '6')
        <!-- PKWT -->


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
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;" lang="FI">No
                            :&nbsp;</span><span
                            style="color:black;font-family:&quot;Calibri&quot;,sans-serif;font-size:10.0pt;"
                            lang="IN">TNC</span><span
                            style="color:black;font-family:&quot;Calibri&quot;,sans-serif;font-size:10.0pt;"
                            lang="EN-GB">/</span><span
                            style="color:black;font-family:&quot;Calibri&quot;,sans-serif;font-size:10.0pt;"
                            lang="IN">018/GELJKT/IX</span><span
                            style="color:black;font-family:&quot;Calibri&quot;,sans-serif;font-size:10.0pt;"
                            lang="EN-GB">/202</span><span
                            style="color:black;font-family:&quot;Calibri&quot;,sans-serif;font-size:10.0pt;"
                            lang="IN">4</span>
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
                                    lang="EN-GB">sebagai&nbsp;</span><span
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
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">Tanggal awal masuk bekerja</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">{{ formatdateindonesian($tnc->tanggalMasukKerja) }}</div>
                                </div>
                            </li>
                            <li>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">Tempat Penerimaan</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">Jakarta</div>
                                </div>
                            </li>
                            <li>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">Tempat Penugasan</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">PT Global Energi Lestari (Head Office)</div>
                                </div>
                            </li>
                            <li>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">Jabatan Awal</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;"></div>
                                </div>
                            </li>
                            <li>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">Bertanggung Jawab Kepada</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;"></div>
                                </div>
                            </li>
                            <li>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">Rincian Upah</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;"></div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">a. Gaji Pokok</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">_______________________________per bulan</div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">b. Tunjangan Makan</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">_______________________________per bulan</div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">c. Tunjangan Transportasi</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">_______________________________per bulan</div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">d. Tunjangan Operasional</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">_______________________________per bulan</div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">e. Tunjangan Telekomunikasi</div>
                                    <div style="margin-right: 10px;">:</div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;">_______________________________per bulan</div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 175px;font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;"><strong>Total THP</strong></div>
                                    <div style="margin-right: 10px;"><strong>:</strong></div>
                                    <div style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;"><strong>_______________________________per bulan</strong></div>
                                </div>
                            </li>
                        </ol>

                    </ol>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;tab-stops:2.0cm 205.55pt 219.75pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="IN">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">(Komponen Fa, Fb, Fc, Fd &amp; Fe adalah upah tetap, yang&nbsp;akan
                            digunakan&nbsp; sebagai dasar perhitungan THR).</span>
                    </p>


                    <br><br>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;tab-stops:list 18.0pt 36.0pt;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FR"><strong>2. Jangka waktu PKWT</strong></span>
                    </p>

                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;tab-stops:36.0pt;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FR">2.1 PKWT ini berlaku untuk jangka waktu efektif terhitung sejak
                            tanggal …………………………………sampai dengan tanggal…………………………………………
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
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FR">a) Mendidik Pekerja yang melanggar.</span>
                    </p>
                    <p
                    style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-indent:-18.0pt;">
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FR">b) Mengamankan investasi dan aset Perusahaan, serta memastikan agar
                            kegiatan bisnis Perusahaan berlangsung efektif dan efisien.</span>
                    </p>
                    <p
                    style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-indent:-18.0pt;">
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FR">c) Mencegah pengulangan pelanggaran oleh pekerja.</span>
                    </p>
                    <p
                    style="line-height:150%;margin-bottom:0cm;margin-left:54.0pt;margin-right:0cm;margin-top:0cm;tab-stops:54.0pt;text-indent:-18.0pt;">
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FR">d) Menciptakan suasana lingkungan kerja yang kondusif.</span>
                    </p>
                    <p
                    style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:-18.0pt;">
                        <span style="font-family:Tahoma, sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="FR">9.4 Semua arsip Pekerja termasuk sanksi disiplin yang masih berlaku
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
                            lang="EN-GB"><strong>13.&nbsp; Pernyataan Tunduk<u>&nbsp;</u></strong>:</span>
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
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:36.0pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:36.0pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:36.0pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:36.0pt;margin-right:0cm;margin-top:0cm;text-align:justify;text-indent:36.0pt;">
                        &nbsp;
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;line-height:150%;"
                            lang="EN-GB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;</span>
                    </p>
                    <p
                        style="line-height:150%;margin-bottom:0cm;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;">
                        <span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;letter-spacing:-.05pt;line-height:150%;"
                            lang="IN"><strong><u>Tuty Alawiyah,
                                    M.M.</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;</strong></span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;letter-spacing:-.05pt;line-height:150%;"
                            lang="EN-US"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
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
                            </strong></span><span
                            style="font-family:&quot;Tahoma&quot;,sans-serif;font-size:9.0pt;letter-spacing:-.05pt;line-height:150%;"
                            lang="SV"><strong>Pekerja&nbsp; &nbsp; &nbsp;</strong></span>
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

        // Move footer to the very bottom of the web page
        document.addEventListener('DOMContentLoaded', function() {
            const footer = document.querySelector('.footer');
            if (footer) {
                document.body.appendChild(footer);
            }
        });

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
