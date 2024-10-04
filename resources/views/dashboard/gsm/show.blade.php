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
            padding: 10mm;
            border: 1px solid #D3D3D3;
            border-radius: 5px;
            background-color: white;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .header-content {
            margin-left: 10mm;
            margin-right: 10mm;
            position: relative;
            z-index: 10;
            padding-bottom: 10mm;
            display: flex;
            flex-direction: column;
            align-items: center;
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

    @if ($gsm->idPerihal == '1') <!-- FCO -->
        <!-- Recent Sales Start -->

        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="/dashboard/gsm" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
                Kembali</a>
            {{-- <a href="/dashboard/gsm/{{ $gsm->id }}/cetak" class="btn btn-secondary" target="_blank"><i
                    class="bi bi-printer"></i> Cetak</a> --}}
            <button id="download-pdf" class="btn btn-primary">Cetak</button>
        </div>
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $gsm->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content">
                    {{-- <center style="margin-top: 50px;"> --}}
                    <table width="545">
                        <tr>
                            <td style="text-align: left">Jakarta, {{ formatDateIndonesian($gsm->tglSurat) }}</td>
                        </tr>
                    </table>
                    <br><br>
                    <table width="545">
                        <tr>
                            <td style="text-align: left;font-weight: bold; text-transform: uppercase;">
                                {{ $gsm->pttujuan }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;font-weight: bold;"> {!! $gsm->alamat !!} </td>
                        </tr>
                    </table>
                    <br>
                    <table width="545">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold; text-transform: uppercase;"
                                class="text">
                                <u>{{ $gsm->perihal }}</u>
                            </td>

                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold; font:italic">{{ $gsm->prefix }}</td>
                        </tr>
                    </table>
                    <br>
                    <table width="545">
                        <tr>
                            <td>Dear {{ $gsm->pttujuan }} </td>
                        </tr>
                        <tr>
                            <td>Hereby, we are pleased to confirm with Full Corporate authority and responsibilty to
                                provide
                                you the following commodity herein after descrived upon the terms and conditions as
                                stated
                                bellow :</td>
                        </tr>
                    </table>
                    <br /><br />
                    <table width="545">
                        <td width="20"> 1. </td>
                        <td width="200">Commodity</td>
                        <td width="10">:</td>
                        <td width="335">{{ $gsm->commodity }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <td width="20"> 2. </td>
                        <td width="200">Source</td>
                        <td width="10">:</td>
                        <td width="335">{{ $gsm->source }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <td width="20"> 3. </td>
                        <td width="200">Country of Origin</td>
                        <td width="10">:</td>
                        <td width="335">{{ $gsm->country }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <td width="20"> 4. </td>
                        <td width="200">Typical Specification</td>
                        <td width="10">:</td>
                        <td width="335">{{ $gsm->spec }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <td width="20"> 5. </td>
                        <td width="200">Validity Offer</td>
                        <td width="10">:</td>
                        <td width="335">{{ $gsm->vo }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <td width="20"> 6. </td>
                        <td width="200">Quantity</td>
                        <td width="10">:</td>
                        <td width="335">{{ $gsm->qty }} MT (+/- 10%) for two barge</td>
                        </tr>
                    </table>
                    <table width="545">
                        <td width="20"> 7. </td>
                        <td width="200">Loading Port</td>
                        <td width="10">:</td>
                        <td width="335">{{ $gsm->lp }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <td width="20"> 8. </td>
                        <td width="200">Destination Port</td>
                        <td width="10">:</td>
                        <td width="335">{{ $gsm->dp }}</td>
                        </tr>
                    </table>
                    @if ($gsm->matauang == 'DOLLAR')
                        <table width="545">
                            <tr>

                                <td width="5"> 9. </td>
                                <td width="120">Price Scheme</td>
                                <td width="5">:</td>
                                @if ($gsm->cif !== null)
                                    <td width="30">CIF</td>
                                    <td width="175"> $ {{ number_format($gsm->cif, 0, '.', ',') }} </td>
                                @endif
                            </tr>
                        </table>
                        <table width="545">
                            <tr>
                                @if ($gsm->fob !== null)
                                    <td width="150"></td>
                                    <td width="1">FOB</td>
                                    <td width="185">$ {{ number_format($gsm->fob, 0, '.', ',') }}
                                @endif
                                </td>
                            </tr>
                        </table>
                        <table width="545">
                            <tr>
                                @if ($gsm->freight !== null)
                                    <td width="185"> </td>
                                    <td width="40">FREIGHT</td>
                                    <td width="200">$ {{ number_format($gsm->freight, 0, '.', ',') }}
                                    </td>
                                @endif
                            </tr>
                        </table>
                    @endif

                    @if ($gsm->matauang == 'IDR')
                        <table width="545">
                            <tr>

                                <td width="5"> 9. </td>
                                <td width="120">Price Scheme</td>
                                <td width="5">:</td>
                                @if ($gsm->cif !== null)
                                    <td width="30">CIF</td>
                                    <td width="175"> RP {{ number_format($gsm->cif, 0, '.', ',') }} </td>
                                @endif
                            </tr>
                        </table>
                        <table width="545">
                            <tr>
                                @if ($gsm->fob !== null)
                                    <td width="150"></td>
                                    <td width="1">FOB</td>
                                    <td width="185"> RP {{ number_format($gsm->fob, 0, '.', ',') }}
                                @endif
                                </td>
                            </tr>
                        </table>
                        <table width="545">
                            <tr>
                                @if ($gsm->freight !== null)
                                    <td width="185"> </td>
                                    <td width="40">FREIGHT</td>
                                    <td width="200"> RP {{ number_format($gsm->freight, 0, '.', ',') }}
                                    </td>
                                @endif
                            </tr>
                        </table>
                    @endif

                    </tr>
                    </table>
                    <table width="545">
                        <td width="20">10. </td>
                        <td width="200">Shipping Schedule</td>
                        <td width="10">:</td>
                        <td width="335">{{ $gsm->shipschedule }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <td width="20">11. </td>
                        <td width="200">Term of Coal Delivery</td>
                        <td width="10">:</td>
                        <td width="335">{{ $gsm->tcd }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <td width="20">12. </td>
                        <td width="200">Surveyor</td>
                        <td width="10">:</td>
                        <td width="335">{{ $gsm->surveyor }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <tr>
                            <td width="20">13. </td>
                            <td width="200">Quality and Specification</td>
                            <td width="10">:</td>
                            <td width="335"></td>
                        </tr>
                    </table> <br>
                    <table width="545">
                        <tr>
                            <td width="335" class="table-keterangan">{!! $gsm->qas !!}</td>
                        </tr>
                    </table>
                    <br>
                    <table width="545">
                        <tr>
                            <td width="20">14. </td>
                            <td width="200">Term of Payment</td>
                            <td width="10">:</td>
                            <td width="335">{{ $gsm->top }}</td>
                        </tr>
                    </table>
                    <br>
                    <table width="545">
                        <tr>
                            <td>We look forward to receiving your favorable reply. Thank you for your attention and
                                corporation.</td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <br>
                    <table width="545" style="font-weight:bold;">
                        <tr>
                            <td>On Behalf,</td>
                        </tr>
                        <tr>
                            <td>PT. GLOBAL ENERGI LESTARI</td>
                        </tr>
                    </table>

                    <br><br>
                    @if ($gsm->approve == '1')
                        <table width="635" style="font-weight:bold;">
                            <tr>
                                <td><img style="height:125px; weigth:125px;padding-left:45px;"
                                        src="{{ asset('img/qrcodes/' . $gsm->qr) }}" alt="QR Code"></td>
                            </tr>
                        </table>
                    @endif
                    <br><br><br>
                    <table width="545" style="font-weight:bold;">
                        <tr>
                            <td>Ervina W</td>
                        </tr>
                        <tr>
                            <td>GSM Ops Mgr</td>
                        </tr>
                    </table>

                    {{-- </center> --}}
                </div>
                @if($gsm->kop == "GEL")
                <div class="footer-page">
                    <img src="{{ asset('img/' . $gsm->kop . '-bottom-kop.png') }}"
                        style="max-width: 100%; height: auto;">
                </div>
                @endif
            </div>
        </div>
        <!-- Recent Sales End -->

    @endif

    @if ($gsm->idPerihal == '2')
        <!-- Surat Izin Masuk Tambang -->
        <!-- Recent Sales Start -->
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="/dashboard/gsm" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
                Kembali</a>
            {{-- <a href="/dashboard/gsm/{{ $gsm->id }}/cetak" class="btn btn-secondary" target="_blank"><i
                    class="bi bi-printer"></i> Cetak</a> --}}
            <button id="download-pdf" class="btn btn-primary">Cetak</button>
        </div>
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $gsm->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content">


                    <table width="545">
                        <tr>
                            <td style="text-align: right">Jakarta, {{ formatDateIndonesian($gsm->tglSurat) }}</td>
                        </tr>
                    </table>
                    <br><br>
                    <table width="545">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; font-weight: bold; text-transform:uppercase"
                                class="text">
                                {{ $gsm->pttujuan }}
                            </td>
                        </tr>
                        <tr>
                            <td>{!! $gsm->alamat !!}</td>
                        </tr>
                    </table>
                    <br>
                    <table width="545">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold; text-transform:uppercase"
                                class="text">
                                <u>{{ $gsm->perihal }} {{ $gsm->ptkunjungan }}</u>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $gsm->prefix }}
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table width="545">
                        <tr>
                            <td>Dear {{ $gsm->pttujuan }} </td>
                        </tr>
                        <tr>
                            <td>Kami PT. Global Energi Lestari (GEL) sebagai pemilik tambang batubara. Menindaklanjuti
                                pengajuan permintaan kunjungan yang akan dilakukan oleh {{ $gsm->pttujuan }} di tambang
                                {{ $gsm->ptkunjungan }} pada tanggal {{ $gsm->tglSurat }}. Berikut nama yang akan
                                melakukan kunjungan:</td>
                        </tr>
                    </table>
                    <br><br>
                    <table class="table-keterangan" width="545">
                        <tr>
                            <td style="border: 0px;">{!! $gsm->keterangan !!}</td>
                        </tr>
                    </table>
                    <br><br>
                    <table width="545">
                        <tr>
                            <td>Demikianlah surat izin kunjungan ini kami buat. Mohon dapat dipergunakan sebagaimana
                                mestinya.</td>
                        </tr>
                    </table>
                    <br /><br />
                    <table width="545">
                        <tr>
                            <td>Hormat Kami,</td>
                        </tr>
                    </table>
                    @if ($gsm->approve == '1')
                        <table width="635" style="font-weight:bold;">
                            <tr>
                                <td><img style="height:125px; weigth:125px;padding-left:45px;"
                                        src="{{ asset('img/qrcodes/' . $gsm->qr) }}" alt="QR Code"></td>
                            </tr>
                        </table>
                    @endif
                    <br>

                </div>
                @if($gsm->kop == "GEL")
                <div class="footer-page">
                    <img src="{{ asset('img/' . $gsm->kop . '-bottom-kop.png') }}"
                        style="max-width: 100%; height: auto;">
                </div>
                @endif
            </div>
        </div>
        <!-- Recent Sales End -->
    @endif

    @if ($gsm->idPerihal == '3')
        <!-- Berita Acara -->
        <!-- Recent Sales Start -->
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="/dashboard/gsm" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
                Kembali</a>
            {{-- <a href="/dashboard/gsm/{{ $gsm->id }}/cetak" class="btn btn-secondary" target="_blank"><i
                    class="bi bi-printer"></i> Cetak</a> --}}
            <button id="download-pdf" class="btn btn-primary">Cetak</button>
        </div>
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <style>
                    table {
                        border-collapse: collapse;
                        width: 545px;
                        /* Optional: set width here if you want */
                    }

                    table td {
                        border: 2px solid;
                        padding: 8px;
                    }

                    .ini-content td {
                        border: 0px;
                        padding: 0px;
                        width: 0px;
                    }
                </style>
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $gsm->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content">
                    {{-- <center style="margin-top: 50px;"> --}}
                    <table width="545" class="ini-content">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; text-transform:uppercase; font-weight: bold"
                                class="text">
                                <u>BERITA ACARA {{ $gsm->perihalBA }}</u>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $gsm->prefix }}
                            </td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <table width="545" class="ini-content">
                        <tr>
                            <td style="text-align: right">Jakarta, {{ formatDateIndonesian($gsm->tglSurat) }}</td>
                        </tr>
                    </table>
                    <br><br>

                    {!! $gsm->keterangan !!}

                    {{-- <table class="table-keterangan" width="545">
                        <tr>
                            <td style="border: 0px;">{!! $gsm->keterangan !!}</td>
                        </tr>
                    </table> --}}
                    <br>
                    <br /><br /><br /><br /><br><br>
                    <table width="545" class="ini-content">
                        <tr style="">
                            <td style="padding-left: 45px;">Dibuat</td>
                            <td style="padding-left: 100px;">Mengetahui</td>
                        </tr>
                        <tr>
                            <td>Sales Departement,</td>

                        </tr>
                        @if ($gsm->approve == '1')
                            <tr>
                                <td> <img style="height:125px; weigth:125px;padding-left:45px;"
                                        src="{{ asset('img/qrcodes/' . $gsm->qr) }}" alt="QR Code"></td>
                            </tr>
                        @endif
                    </table>
                    <br /><br />
                    <br>
                    <br /><br />
                    <br>
                    <br /><br />
                    <br>
                    <br /><br />
                    <br>
                    {{-- </center> --}}
                </div>
                <div class="footer-page">
                    <img src="{{ asset('img/' . $gsm->kop . '-bottom-kop.png') }}"
                        style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->
    @endif

    @if ($gsm->idPerihal == '4')
        <!-- Tanda Terima -->
        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="/dashboard/gsm" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
                {{-- <a href="/dashboard/gsm/{{ $gsm->id }}/cetak" class="btn btn-secondary" target="_blank"><i
                        class="bi bi-printer"></i> Cetak</a> --}}
                <button id="download-pdf" class="btn btn-primary">Cetak</button>

            </div>
            <div class="contentToConvert">
                <div class="page">
                    <div class="header" id="header">
                        <img src="{{ asset('img/' . $gsm->kop . '-kop-atas.png') }}"
                            style="max-width: 100%; height: auto;">
                        <br><br>
                    </div>
                    <div class="header-content">
                        {{-- <center style="margin-top: 50px;"> --}}
                            <br><br><br>
                            @if ($gsm->kop = 'QIN')
                                <br><br><br>
                            @endif
                            <table width="545">
                                <tr>
                                    <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; text-transform:uppercase; font-weight: bold"
                                        class="text">
                                        <u>TANDA TERIMA</u>
                                </tr>
                                <tr>
                                    <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $gsm->prefix }}
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <br>
                            <br>
                            <br><br>
                            <table class="table-keterangan" width="545">
                                <tr>
                                    <td style="border: 0px;">{!! $gsm->keterangan !!}</td>
                                </tr>
                                <table width="545">
                                    <tr style="">
                                        <td style="text-align: left">Pengirim</td>


                                        <td style="text-align: right">Diterima Oleh</td>
                                    </tr>
                                </table>
                                <br><br><br /><br /><br />
                                <table width="545">
                                    <tr style="">
                                        <td style="text-align: right">Jakarta, {{ formatDateIndonesian($gsm->tglSurat) }}</td>
                                    </tr>
                                </table>

                        {{-- </center> --}}
                    </div>

            </div>
        </div>
        <!-- Recent Sales End -->
    @endif

    @if ($gsm->idPerihal == '5')
        <!-- Permohonan Revisi Invoice dan Pembatalan Faktur Pajak GEL -->
        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="/dashboard/gsm" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
                {{-- <a href="/dashboard/gsm/{{ $gsm->id }}/cetak" class="btn btn-secondary" target="_blank"><i
                        class="bi bi-printer"></i> Cetak</a> --}}
                <button id="download-pdf" class="btn btn-primary">Cetak</button>

            </div>
            <div id="contentToConvert" class="contentToConvert">
                <div class="page">
                    <div class="header" id="header">
                        <img src="{{ asset('img/' . $gsm->kop . '-kop-atas.png') }}"
                            style="max-width: 100%; height: auto;">
                        <br><br>
                    </div>
                    <div class="header-content">
                        {{-- <center style="margin-top: 50px;"> --}}
                            <br><br> <br>
                            <br><br>
                            <table width="545">
                                <tr>
                                    <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; text-transform:uppercase; font-weight: bold"
                                        class="text">
                                        <u>BERITA ACARA {{ $gsm->perihalBA }}</u>
                                </tr>
                                <tr>
                                    <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $gsm->prefix }}
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <?php
                            // Get the date from the $gsm object
                            $date = $gsm->tglSurat;

                            // Get the day of the week (in English)
                            $dayOfWeek = date('l', strtotime($date));

                            // Define an array for Indonesian day names
                            $indonesianDayNames = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];

                            // Translate the English day name to Indonesian
                            $indonesianDay = $indonesianDayNames[$dayOfWeek];
                            ?>

                            <table width="545">
                                <tr>
                                    <td style="text-align: right"><?php echo $indonesianDay . ', ' . formatDateIndonesian($date); ?></td>
                                </tr>
                            </table>

                            <br>
                            <br>
                            <br><br>
                            <table class="table-keterangan" width="545">
                                <tr>
                                    <td style="border: 0px;">{!! $gsm->keterangan !!}</td>
                                </tr>
                            </table>
                            <br>
                            <br /><br /><br /><br /><br><br><br /><br /><br /><br /><br><br>
                            <table width="545">
                                <tr>
                                    <td style="text-align: left">Dibuat Oleh</td>
                                    <td style="text-align: right">Diterima Oleh</td>
                                </tr>
                                @if ($gsm->approve == '1')
                                    <tr>
                                        <td style="text-align: left"> <img style="height:125px; weigth:125px;"
                                                src="{{ asset('img/qrcodes/' . $gsm->qr) }}" alt="QR Code"></td>
                                        <td></td>
                                    </tr>
                                @endif
                            </table>

                        {{-- </center> --}}

            </div>
        </div>
        <!-- Recent Sales End -->
    @endif

    @if ($gsm->idPerihal == '6')
        <!-- Letter of Intent -->
        <!-- Recent Sales Start -->
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="/dashboard/gsm" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
                Kembali</a>
            {{-- <a href="/dashboard/gsm/{{ $gsm->id }}/cetak" class="btn btn-secondary" target="_blank"><i
                    class="bi bi-printer"></i> Cetak</a> --}}
            <button id="download-pdf" class="btn btn-primary">Cetak</button>
        </div>
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $gsm->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content">
                    {{-- <center style="margin-top: 50px;"> --}}
                        <table width="545">
                            <tr>
                                <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; text-transform:uppercase; font-weight: bold"
                                    class="text">
                                    <span>RE:</span> {{ $gsm->perihal }}
                                <td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $gsm->prefix }}
                                </td>
                            </tr>
                        </table>
                        <br><br>
                        <table class="table-keterangan" width="545">
                            <tr>
                                <td style="border: 0px;">{!! $gsm->keterangan !!}</td>
                            </tr>
                        </table>
                        <br>

                        <table width="545">
                            <tr>
                                <td style="padding-left:50px;">COMMODITY</td>
                                <td width="10">:</td>
                                <td width="250">{{ $gsm->commodity }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <tr>
                                <td style="padding-left:50px;">SPECIFICATION</td>
                                <td width="10">:</td>
                                <td width="250">{{ $gsm->spec }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <tr>
                                <td style="padding-left:50px;">COUNTRY OF ORIGIN</td>
                                <td width="10">:</td>
                                <td width="250">{{ $gsm->country }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <tr>
                                <td style="padding-left:50px;">QUANTITY</td>
                                <td width="10">:</td>
                                <td width="250">{{ $gsm->qty }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <tr>
                                <td style="padding-left:50px;">DELIVERY BASIS</td>
                                <td width="10">:</td>
                                <td width="250">{{ $gsm->delivery_basis }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <tr>
                                <td style="padding-left:50px;">CONTRACT DURATION</td>
                                <td width="10">:</td>
                                <td width="250">{{ $gsm->contract_dur }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <tr>
                                <td style="padding-left:50px;">PRICE OFFER</td>
                                <td width="10">:</td>
                                <td width="250">{{ $gsm->po }}</td>
                            </tr>
                        </table>

                        <br>
                        <table width="545">
                            <tr>
                                <td>We will be looking forward to receiving feedback from your company and we thank you in
                                    advance for your co-operation and promprt feedback. Look forward to working with you soon.
                                </td>
                            </tr>
                        </table>
                        <br /><br />
                        <table width="545">
                            <tr style="">
                                <td style="padding-left: 45px;">Regrad,</td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;">GLOBAL COAL RESOURCES Pte Ltd.</td>
                            </tr>

                        </table>
                        <br /><br /><br /><br />
                        <table width="545">
                            <tr>
                                <td style="font-weight:bold;"><u>LUHENDRI</u></td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;">Director</td>
                            </tr>
                        </table>
                    {{-- </center> --}}
            </div>
        </div>
        <!-- Recent Sales End -->
    @endif
    <br /><br />
    <br>
    <br /><br />
    <br>

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
                html2canvas: {
                    scale: 3,
                    backgroundColor: '#ffffff'
                },
                jsPDF: {
                    unit: 'cm',
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
