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
    <?php \Carbon\Carbon::setLocale('id'); ?>

    @if ($mss->idPerihal == '1') <!-- FCO -->
        <!-- Recent Sales Start -->

        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
                Kembali</a>
            <div class="ml-auto">
                @if (auth()->user()->name == 'IT Support')
                    <form action="{{ route('it.approve', $mss->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">
                        <button class="btn btn-primary {{ $mss->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $mss->approve }}"
                            onclick="{{ $mss->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $mss->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i> Approve
                        </button>
                    </form>
                @endif
                <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                    href="{{ url('/dashboard/it/' . $mss->id . '/edit') }}"
                    @if ($mss->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
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
                    <img src="{{ asset('img/' . $mss->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>

                <div class="header-content" style="align-items: center;">
                    {{-- <center style="margin-top: 50px;"> --}}
                    <div style="width: 545px;">
                        <div style="text-align: left">Jakarta, {{ formatDateIndonesian($mss->tglSurat) }}</div>
                    </div>
                    <br><br>
                    <div style="width: 545px;">
                        <div style="text-align: left;font-weight: bold; text-transform: uppercase;">
                            {{ $mss->pttujuan }}
                        </div>
                        <div style="text-align: left;font-weight: bold;"> {!! $mss->alamat !!} </div>
                    </div>
                    <br>
                    <div style="width: 545px;">
                        <div style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold; text-transform: uppercase;"
                            class="text">
                            <u>{{ $mss->perihal }}</u>
                        </div>
                        <div style="text-align: center; font-weight: bold; font:italic">{{ $mss->prefix }}</div>
                    </div>
                    <br>
                    <div style="width: 545px;">
                        <div>Dear {{ $mss->pttujuan }} </div>
                        <div>Hereby, we are pleased to confirm with Full Corporate authority and responsibility to
                            provide
                            you the following commodity herein after described upon the terms and conditions as
                            stated
                            below :</div>
                    </div>
                    <br /><br />
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">1.</div>
                            <div style="width: 195px;">Commodity</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">{{ $mss->commodity }}</div>
                        </div>
                    </div>
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">2.</div>
                            <div style="width: 195px;">Source</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">{{ $mss->source }}</div>
                        </div>
                    </div>
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">3.</div>
                            <div style="width: 195px;">Country of Origin</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">{{ $mss->country }}</div>
                        </div>
                    </div>
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">4.</div>
                            <div style="width: 195px;">Typical Specification</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">{{ $mss->spec }}</div>
                        </div>
                    </div>
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">5.</div>
                            <div style="width: 195px;">Validity Offer</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">{{ \Carbon\Carbon::parse($mss->vo)->format('F j, Y') }}</div>
                        </div>
                    </div>
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">6.</div>
                            <div style="width: 195px;">Quantity</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">{{ number_format($mss->qty, 0, '.', ',') }} MT</div>
                        </div>
                    </div>
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">7.</div>
                            <div style="width: 195px;">Loading Port</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">{{ $mss->lp }}</div>
                        </div>
                    </div>
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">8.</div>
                            <div style="width: 195px;">Destination Port</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">{{ $mss->dp }}</div>
                        </div>
                    </div>
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">9.</div>
                            <div style="width: 195px;">Price Scheme</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">
                                <div style="display: flex; flex-direction: column;">
                                    @if ($mss->cif !== null)
                                        <div>{{ $mss->matauang == 'DOLLAR' ? 'CIF $' : 'CIF Rp.' }}
                                            {{ number_format($mss->cif, 0, '.', ',') }}</div>
                                    @endif
                                    @if ($mss->fob !== null)
                                        <div>{{ $mss->matauang == 'DOLLAR' ? 'FOB $' : 'FOB Rp.' }}
                                            {{ number_format($mss->fob, 0, '.', ',') }}</div>
                                    @endif
                                    @if ($mss->freight !== null)
                                        <div>{{ $mss->matauang == 'DOLLAR' ? 'FREIGHT $' : 'FREIGHT Rp.' }}
                                            {{ number_format($mss->freight, 0, '.', ',') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">10.</div>
                            <div style="width: 195px;">Shipping Schedule</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">{{ \Carbon\Carbon::parse($mss->shipschedule)->format('F j, Y') }}
                            </div>
                        </div>
                    </div>
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">11.</div>
                            <div style="width: 195px;">Term of Coal Delivery</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">{{ $mss->tcd }}</div>
                        </div>
                    </div>
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">12.</div>
                            <div style="width: 195px;">Surveyor</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">{{ $mss->surveyor }}</div>
                        </div>
                    </div>
                    <br><br><br><br><br><br><br><br>
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">13.</div>
                            <div style="width: 195px;">Quality and Specification</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;"></div>
                        </div>
                    </div>
                    <br>
                    <figure class="table" style="float:left;width:404.75pt;">
                        <table style="border-collapse:collapse;border-style:none;margin-left:6.75pt;margin-right:6.75pt;"
                            border="1" cellspacing="0" cellpadding="0" width="540">
                            <tbody>
                                <tr style="height:11.05pt;">
                                    <td style="border-color:windowtext;border-width:1.0pt;height:11.05pt;padding:0cm 5.4pt;vertical-align:top;width:152.75pt;"
                                        width="204">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>PARAMETERS</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:none;border-right-style:solid;border-top-style:solid;border-width:1.0pt;height:11.05pt;padding:0cm 5.4pt;vertical-align:top;width:53.35pt;"
                                        width="71">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>UNIT</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:none;border-right-style:solid;border-top-style:solid;border-width:1.0pt;height:11.05pt;padding:0cm 5.4pt;vertical-align:top;width:95.15pt;"
                                        width="127">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>TYPICAL</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:none;border-right-style:solid;border-top-style:solid;border-width:1.0pt;height:11.05pt;padding:0cm 5.4pt;vertical-align:top;width:103.5pt;"
                                        width="138">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>Rejection</strong></span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:22.7pt;">
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:152.75pt;"
                                        width="204">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>Gross Calorific Value (ARB)</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:53.35pt;"
                                        width="71">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>Kcal/kg</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:95.15pt;"
                                        width="127">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['gross_caloric_value_typical'] }}</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:103.5pt;"
                                        width="138">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US">
                                                <strong>{{ $qas['gross_caloric_value_rejection'] ?? 'No Rejection' }}</strong>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:22.15pt;">
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:22.15pt;padding:0cm 5.4pt;vertical-align:top;width:152.75pt;"
                                        width="204">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>Ash Content (ADB)</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.15pt;padding:0cm 5.4pt;vertical-align:top;width:53.35pt;"
                                        width="71">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>%</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.15pt;padding:0cm 5.4pt;vertical-align:top;width:95.15pt;"
                                        width="127">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['ash_content_typical'] }}</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.15pt;padding:0cm 5.4pt;vertical-align:top;width:103.5pt;"
                                        width="138">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['ash_content_rejection'] ?? 'No Rejection' }}</strong></span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:22.7pt;">
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:152.75pt;"
                                        width="204">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>Total Sulphur (ADB)</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:53.35pt;"
                                        width="71">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>%</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:95.15pt;"
                                        width="127">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['total_sulphur_typical'] }}</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:103.5pt;"
                                        width="138">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['total_sulphur_rejection'] ?? 'No Rejection' }}</strong></span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:22.7pt;">
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:152.75pt;"
                                        width="204">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>Total Moisture (ARB)</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:53.35pt;"
                                        width="71">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>%</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:95.15pt;"
                                        width="127">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['total_moisture_typical'] }}</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:103.5pt;"
                                        width="138">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['total_moisture_rejection'] ?? 'No Rejection' }}</strong></span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:22.7pt;">
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:152.75pt;"
                                        width="204">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>HGI</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:53.35pt;"
                                        width="71">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            &nbsp;
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:95.15pt;"
                                        width="127">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['hgi_typical'] }}</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:103.5pt;"
                                        width="138">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['hgi_rejection'] ?? 'No Rejection' }}</strong></span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:22.7pt;">
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:152.75pt;"
                                        width="204">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>Inherent Moisture (ADB)</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:53.35pt;"
                                        width="71">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>%</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:95.15pt;"
                                        width="127">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['inherent_moisture_typical'] }}</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:103.5pt;"
                                        width="138">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['inherent_moisture_rejection'] ?? 'No Rejection' }}</strong></span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:22.7pt;">
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:152.75pt;"
                                        width="204">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>Volatile Matter (ADB)</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:53.35pt;"
                                        width="71">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>%</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:95.15pt;"
                                        width="127">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['volatile_matter_typical'] }}</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:103.5pt;"
                                        width="138">
                                                <p
                                                    style="line-height:107%;margin-bottom:8pt;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                                    <span
                                                        style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                        lang="EN-US"><strong>{{ $qas['volatile_matter_rejection'] ?? 'No Rejection' }}</strong></span>
                                                </p>
                                    </td>
                                </tr>
                                <tr style="height:22.7pt;">
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:152.75pt;"
                                        width="204">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>Fixed Carbon (ADB)</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:53.35pt;"
                                        width="71">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>%</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:95.15pt;"
                                        width="127">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['fixed_carbon_typical'] }}</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:103.5pt;"
                                        width="138">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['fixed_carbon_rejection'] ?? 'No Rejection' }}</strong></span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:22.7pt;">
                                    <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:152.75pt;"
                                        width="204">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>Size Raw Coal (0-100)</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:53.35pt;"
                                        width="71">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>%</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:95.15pt;"
                                        width="127">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['size_raw_coal_typical'] }}</strong></span>
                                        </p>
                                    </td>
                                    <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:103.5pt;"
                                        width="138">
                                        <p
                                            style="line-height:107%;margin-bottom:8pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-autospace:ideograph-numeric ideograph-other;">
                                            <span
                                                style="font-family:&quot;Aptos Narrow&quot;,sans-serif;font-size:12.0pt;line-height:107%;"
                                                lang="EN-US"><strong>{{ $qas['size_raw_coal_rejection'] ?? 'No Rejection' }}</strong></span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </figure>
                    <br>
                    <div style="width: 545px;">
                        <div style="display: flex;">
                            <div style="width: 25px;">14.</div>
                            <div style="width: 195px;">Term of Payment</div>
                            <div style="width: 10px;">:</div>
                            <div style="width: 335px;">{{ $mss->top }}</div>
                        </div>
                    </div>
                    <br>
                    <div style="width: 545px;">
                        <div>We look forward to receiving your favorable reply. Thank you for your attention and
                            cooperation.</div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div style="width: 545px; font-weight:bold;">
                        <div>On Behalf,</div>
                        <div>PT. GLOBAL ENERGI LESTARI</div>
                    </div>

                    <br><br>
                    @if ($mss->approve == '1')
                        <div style="width: 635px; font-weight:bold;">
                            <div><img style="height:125px; width:125px;padding-left:45px;"
                                    src="{{ asset('img/qrcodes/' . $mss->qr) }}" alt="QR Code"></div>
                        </div>
                    @endif
                    <br><br><br>
                    <div style="width: 545px; font-weight:bold;">
                        <div>Ervina Wijaya</div>
                        <div>MSS Ops Mgr</div>
                    </div>

                    {{-- </center> --}}
                </div>
                @if ($mss->kop == 'GEL')
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $mss->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>
        </div>
        <!-- Recent Sales End -->

    @endif

    @if ($mss->idPerihal == '2')
        <!-- Surat Izin Masuk Tambang -->
        <!-- Recent Sales Start -->
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i
                    class="bi bi-arrow-left-square"></i>
                Kembali</a>
            <div class="ml-auto">
                @if (auth()->user()->name == 'IT Support')
                    <form action="{{ route('it.approve', $mss->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">
                        <button class="btn btn-primary {{ $mss->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $mss->approve }}"
                            onclick="{{ $mss->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $mss->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i> Approve
                        </button>
                    </form>
                @endif
                <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                    href="{{ url('/dashboard/it/' . $mss->id . '/edit') }}"
                    @if ($mss->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
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
                    <img src="{{ asset('img/' . $mss->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style="align-items: center;">


                    <table width="545">
                        <tr>
                            <td style="text-align: right">Jakarta, {{ formatDateIndonesian($mss->tglSurat) }}</td>
                        </tr>
                    </table>
                    <br><br>
                    <table width="545">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; font-weight: bold; text-transform:uppercase"
                                class="text">
                                {{ $mss->pttujuan }}
                            </td>
                        </tr>
                        <tr>
                            <td>{!! $mss->alamat !!}</td>
                        </tr>
                    </table>
                    <br>
                    <table width="545">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold; text-transform:uppercase"
                                class="text">
                                <u>{{ $mss->perihal }} {{ $mss->ptkunjungan }}</u>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $mss->prefix }}
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table width="545">
                        <tr>
                            <td>Dear {{ $mss->pttujuan }} </td>
                        </tr>
                        <tr>
                            <td>Kami PT. Global Energi Lestari (GEL) sebagai pemilik tambang batubara. Menindak lanjuti
                                pengajuan permintaan kunjungan yang akan dilakukan oleh {{ $mss->pttujuan }} di tambang
                                {{ $mss->ptkunjungan }} pada tanggal {{ formatDateIndonesian($mss->tglSurat) }}. Berikut
                                nama yang akan
                                melakukan kunjungan:</td>
                        </tr>
                    </table>
                    <br><br>
                    <table class="table-keterangan" width="545">
                        <tr>
                            <td style="border: 0px;">{!! $mss->keterangan !!}</td>
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
                    @if ($mss->approve == '1')
                        <table width="635" style="font-weight:bold;">
                            <tr>
                                <td><img style="height:125px; weigth:125px;padding-left:45px;"
                                        src="{{ asset('img/qrcodes/' . $mss->qr) }}" alt="QR Code"></td>
                            </tr>
                        </table>
                    @endif
                    <br>

                </div>
                @if ($mss->kop == 'GEL')
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $mss->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>
        </div>
        <!-- Recent Sales End -->
    @endif

    @if ($mss->idPerihal == '3')
        <!-- Berita Acara -->
        <!-- Recent Sales Start -->
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i
                    class="bi bi-arrow-left-square"></i>
                Kembali</a>
            <div class="ml-auto">
                @if (auth()->user()->name == 'IT Support')
                    <form action="{{ route('it.approve', $mss->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">
                        <button class="btn btn-primary {{ $mss->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $mss->approve }}"
                            onclick="{{ $mss->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $mss->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i> Approve
                        </button>
                    </form>
                @endif
                <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                    href="{{ url('/dashboard/it/' . $mss->id . '/edit') }}"
                    @if ($mss->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
                <button id="download-pdf" class="btn btn-primary" style="margin-left:10px;">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Unduh
                </button>
            </div>
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
                    @if ($mss->kop !== null)
                        <img src="{{ asset('img/' . $mss->kop . '-kop-atas.png') }}"
                            style="max-width: 100%; height: auto;">
                    @endif
                    <br><br>
                </div>
                <div class="header-content" style="align-items: center;">
                    {{-- <center style="margin-top: 50px;"> --}}
                    <table width="545" class="ini-content">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; text-transform:uppercase; font-weight: bold"
                                class="text">
                                <u>BERITA ACARA {{ $mss->perihalBA }}</u>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold; font-style: italic;">
                                {{ $mss->prefix }}
                            </td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <table style="width:635;" class="ini-content">
                        <tr>
                            <td style="text-align: right">Jakarta, {{ formatDateIndonesian($mss->tglSurat) }}</td>
                        </tr>
                    </table>
                    <br><br>

                    {{-- {!! $mss->keterangan !!} --}}

                    <table class="table-keterangan" id="table-keterangan" width="545">
                        <tr>
                            <td style="border: 0px;">{!! $mss->keterangan !!}</td>
                        </tr>
                    </table>
                    <br>
                    <br />


                    <table style="width:635;" class="ini-content">
                        <tr style="">
                            <td style="padding-left: 45px;">Dibuat</td>
                            <td style="text-align: right;">Mengetahui</td>
                        </tr>
                        <tr>
                            <td>Sales Departement,</td>

                        </tr>
                        @if ($mss->approve == '1')
                            <tr>
                                <td> <img style="height:70px; padding-left:155;"
                                        src="{{ asset('img/qrcodes/' . $mss->qr) }}" alt="QR Code"></td>
                            </tr>
                        @endif
                    </table>
                    <br><br><br><br>


                    <table style="width:635;" class="ini-content">
                        <tr>
                            <td style="padding-left: 45px;">{{ $mss->ttd }}</td>
                            <td style="text-align: right;">{{ $mss->namaTtd }}</td>
                        </tr>
                    </table>
                </div>
                <div class="footer-page">
                    @if ($mss->kop !== null)
                        <img src="{{ asset('img/' . $mss->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    @endif
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->
    @endif

    @if ($mss->idPerihal == '4')
        <!-- Tanda Terima -->
        <!-- Recent Sales Start -->
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i
                    class="bi bi-arrow-left-square"></i>
                Kembali</a>
            <div class="ml-auto">
                @if (auth()->user()->name == 'IT Support')
                    <form action="{{ route('it.approve', $mss->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">
                        <button class="btn btn-primary {{ $mss->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $mss->approve }}"
                            onclick="{{ $mss->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $mss->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i> Approve
                        </button>
                    </form>
                @endif
                <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                    href="{{ url('/dashboard/it/' . $mss->id . '/edit') }}"
                    @if ($mss->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
                <button id="download-pdf" class="btn btn-primary" style="margin-left:10px;">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Unduh
                </button>
            </div>
        </div>
        <div class="contentToConvert" id="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $mss->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style=" align-items: center;">
                    {{-- <center style="margin-top: 50px;"> --}}
                    <br><br><br>
                    @if ($mss->kop = 'QIN')
                        <br><br><br>
                    @endif
                    <table width="545">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; text-transform:uppercase; font-weight: bold"
                                class="text">
                                <u>TANDA TERIMA</u>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $mss->prefix }}
                            </td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <br>
                    <br><br>
                    <table class="table-keterangan" width="545">
                        <tr>
                            <td style="border: 0px;">{!! $mss->keterangan !!}</td>
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
                                <td style="text-align: right">Jakarta, {{ formatDateIndonesian($mss->tglSurat) }}</td>
                            </tr>
                        </table>
                        {{-- </center> --}}
                    </table>
                </div>
            </div>
            <div id="viewerContainer"></div>
        </div>
        <!-- Recent Sales End -->
    @endif

    @if ($mss->idPerihal == '5')
        <!-- Permohonan Revisi Invoice dan Pembatalan Faktur Pajak GEL -->
        <!-- Recent Sales Start -->
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i
                    class="bi bi-arrow-left-square"></i>
                Kembali</a>
            <div class="ml-auto">
                @if (auth()->user()->name == 'IT Support')
                    <form action="{{ route('it.approve', $mss->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">
                        <button class="btn btn-primary {{ $mss->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $mss->approve }}"
                            onclick="{{ $mss->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $mss->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i> Approve
                        </button>
                    </form>
                @endif
                <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                    href="{{ url('/dashboard/it/' . $mss->id . '/edit') }}"
                    @if ($mss->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
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
                    <img src="{{ asset('img/' . $mss->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style="align-items: center;">
                    {{-- <center style="margin-top: 50px;"> --}}
                    <br><br> <br>
                    <br><br>
                    <table width="545">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; text-transform:uppercase; font-weight: bold"
                                class="text">
                                <u>BERITA ACARA {{ $mss->perihalBA }}</u>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $mss->prefix }}
                            </td>
                        </tr>
                    </table>
                    <br>
                    <?php
                    // Get the date from the $mss object
                    $date = $mss->tglSurat;

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
                            <td style="border: 0px;">{!! $mss->keterangan !!}</td>
                        </tr>
                    </table>
                    <br>
                    <br /><br /><br /><br /><br><br><br /><br /><br /><br />
                    <table width="545">
                        <tr>
                            <td style="text-align: left">Dibuat Oleh</td>
                            <td style="text-align: right">Diterima Oleh</td>
                        </tr>
                        @if ($mss->approve == '1')
                            <tr>
                                <td style="text-align: left"> <img style="height:125px; weigth:125px;"
                                        src="{{ asset('img/qrcodes/' . $mss->qr) }}" alt="QR Code"></td>
                                <td></td>
                            </tr>
                        @endif
                    </table>

                    {{-- </center> --}}

                </div>
            </div>
        </div>
        <!-- Recent Sales End -->
    @endif

    @if ($mss->idPerihal == '6')
        <!-- Letter of Intent -->
        <!-- Recent Sales Start -->
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i
                    class="bi bi-arrow-left-square"></i>
                Kembali</a>
            <div class="ml-auto">
                @if (auth()->user()->name == 'IT Support')
                    <form action="{{ route('it.approve', $mss->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">
                        <button class="btn btn-primary {{ $mss->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $mss->approve }}"
                            onclick="{{ $mss->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $mss->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i> Approve
                        </button>
                    </form>
                @endif
                <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                    href="{{ url('/dashboard/it/' . $mss->id . '/edit') }}"
                    @if ($mss->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
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
                    <img src="{{ asset('img/' . $mss->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style="align-items: center;">
                    {{-- <center style="margin-top: 50px;"> --}}
                    <table width="545">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; text-transform:uppercase; font-weight: bold"
                                class="text">
                                <span>RE:</span> {{ $mss->perihal }}
                            <td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $mss->prefix }}
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table class="table-keterangan" width="545">
                        <tr>
                            <td style="border: 0px;">{!! $mss->keterangan !!}</td>
                        </tr>
                    </table>
                    <br>

                    <table width="545">
                        <tr>
                            <td style="padding-left:50px;">COMMODITY</td>
                            <td width="10">:</td>
                            <td width="250">{{ $mss->commodity }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <tr>
                            <td style="padding-left:50px;">SPECIFICATION</td>
                            <td width="10">:</td>
                            <td width="250">{{ $mss->spec }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <tr>
                            <td style="padding-left:50px;">COUNTRY OF ORIGIN</td>
                            <td width="10">:</td>
                            <td width="250">{{ $mss->country }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <tr>
                            <td style="padding-left:50px;">QUANTITY</td>
                            <td width="10">:</td>
                            <td width="250">{{ $mss->qty }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <tr>
                            <td style="padding-left:50px;">DELIVERY BASIS</td>
                            <td width="10">:</td>
                            <td width="250">{{ $mss->delivery_basis }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <tr>
                            <td style="padding-left:50px;">CONTRACT DURATION</td>
                            <td width="10">:</td>
                            <td width="250">{{ $mss->contract_dur }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <tr>
                            <td style="padding-left:50px;">PRICE OFFER</td>
                            <td width="10">:</td>
                            <td width="250">{{ $mss->po }}</td>
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
                            <td style="">Regard,</td>
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
        </div>
        <!-- Recent Sales End -->
    @endif

    @if ($mss->idPerihal == '7')
        <!-- SPKD -->
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i
                    class="bi bi-arrow-left-square"></i>
                Kembali</a>
            <div class="ml-auto">
                @if (auth()->user()->name == 'IT Support')
                    <form action="{{ route('it.approve', $mss->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">
                        <button class="btn btn-primary {{ $mss->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $mss->approve }}"
                            onclick="{{ $mss->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $mss->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i> Approve
                        </button>
                    </form>
                @endif
                <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                    href="{{ url('/dashboard/it/' . $mss->id . '/edit') }}"
                    @if ($mss->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
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
                    <img src="{{ asset('img/' . $mss->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" id="header-content"
                    style="padding-left:1in; padding-right:1in; align-items: normal;">
                    <h1
                        style="margin: 0px 0px 0px 1px; text-align: center; text-indent: -1px; line-height: 107%; break-after: avoid; font-size: 19px; font-family: Cambria, serif; color: black; text-decoration: underline;">
                        <span lang="IN" style="font-family: Arial, sans-serif;">SURAT
                            PERNYATAAN KEBENARAN DOKUMEN (SPKD)</span>
                    </h1>

                    <h2
                        style="margin: 0px 0px 0px 1px; text-align: center; text-indent: -1px; line-height: 107%; break-after: avoid; font-size: 16px; font-family: Cambria, serif; color: black; font-weight: normal;">
                        <strong><span lang="IN"
                                style="font-family: Arial, sans-serif;">{{ $mss->prefix }}</span></strong>
                    </h2>

                    <p class="MsoNormal"
                        style="margin: 0px 0px 15px; font-size: 15px; font-family: Calibri, sans-serif; line-height: 107%;">
                        <span lang="IN" style="font-family: Arial, sans-serif;"><span>&nbsp;</span></span><br>
                    </p>

                    <p class="MsoNormal"
                        style="margin: 0px 0px 13px; line-height: 115%; font-size: 15px; font-family: Calibri, sans-serif;">
                        <span lang="EN-US" style="font-family: Arial, sans-serif;">Yang bertandatangan dibawah ini :
                        </span>
                    </p>

                    @if ($mss->kop == 'ERA')
                        <div style="display: flex; align-items: baseline; font-size: 15px;">
                            <div style="width: 250px;">Nama</div>
                            <div style="margin-right: 10px;">:</div>
                            <div>HARYADY WIJAYA PUTRO</div>
                        </div>
                        <div style="display: flex; align-items: baseline; font-size: 15px;">
                            <div style="width: 250px;">Jabatan</div>
                            <div style="margin-right: 10px;">:</div>
                            <div>DIREKTUR UTAMA</div>
                        </div>
                        <div style="display: flex; align-items: baseline; font-size: 15px;">
                            <div style="width: 250px;">Perusahaan</div>
                            <div style="margin-right: 10px;">:</div>
                            <div>PT. ERA PERKASA MINING</div>
                        </div>
                        <div style="display: flex; align-items: baseline; font-size: 15px;">
                            <div style="width: 250px;">Alamat Perusahaan</div>
                            <div style="margin-right: 10px;">:</div>
                            <div>JL. KAYU MANIS NO. 27 D<br>KEC. PAYUNG SEKAKI, PEKANBARU INDONESIA</div>
                        </div>
                    @elseif ($mss->kop == 'QIN')
                        <div style="display: flex; align-items: baseline; font-size: 15px;">
                            <div style="width: 250px;">Nama</div>
                            <div style="margin-right: 10px;">:</div>
                            <div>SYAHRIAL</div>
                        </div>
                        <div style="display: flex; align-items: baseline; font-size: 15px;">
                            <div style="width: 250px;">Jabatan</div>
                            <div style="margin-right: 10px;">:</div>
                            <div>DIREKTUR UTAMA</div>
                        </div>
                        <div style="display: flex; align-items: baseline; font-size: 15px;">
                            <div style="width: 250px;">Perusahaan</div>
                            <div style="margin-right: 10px;">:</div>
                            <div>PT. QUASAR INTI NUSANTARA</div>
                        </div>
                        <div style="display: flex; align-items: baseline; font-size: 15px;">
                            <div style="width: 250px;">Alamat Perusahaan</div>
                            <div style="margin-right: 10px;">:</div>
                            <div>JL. TUANKU TAMBUSAI NO. 323 <br>KOTA PEKANBARU - INDONESIA</div>
                        </div>
                    @endif

                    <p class="MsoNormal"
                        style="margin: 0px 0px 13px; line-height: 115%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">
                        <span lang="EN-US" style="font-family: Arial, sans-serif;"><br clear="all">
                            Menyatakan bahwa semua dokumen yang diberikan kepada surveyor yang ditetapkan
                            Ditjen Minerba {{ $mss->ptkunjungan }} adalah Benar. Untuk penerbitan Laporan Hasil
                            Verifikasi (LHV) pengapalan batubara ke domestik sebagai berikut : </span>
                    </p>

                    <div style="display: flex; align-items: baseline; font-size: 15px;">
                        <div style="width: 250px;">Pelabuhan Tujuan</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>{{ $mss->pelabuhanTujuan }}</div>
                    </div>
                    <div style="display: flex; align-items: baseline; font-size: 15px;">
                        <div style="width: 250px;">Vessel</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>
                            @if ($mss->vessel == null)
                                -
                            @else
                                {{ $mss->vessel }}
                            @endif
                        </div>
                    </div>
                    <div style="display: flex; align-items: baseline; font-size: 15px;">
                        <div style="width: 250px;">Barge/Tug Boat</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>{{ $mss->btb }}</div>
                    </div>
                    <div style="display: flex; align-items: baseline; font-size: 15px;">
                        <div style="width: 250px;">Tanggal Pengapalan</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>{{ \Carbon\Carbon::parse($mss->tglPengapalan)->translatedFormat('d F Y') }}</div>
                    </div>
                    <div style="display: flex; align-items: baseline; font-size: 15px;">
                        <div style="width: 250px;">Pelabuhan Muat</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>{{ $mss->pelabuhanMuat }}</div>
                    </div>

                    <p class="MsoNormal"
                        style="margin: 0px 0px 13px; font-size: 15px; font-family: Calibri, sans-serif; line-height: 107%;">
                        <span lang="EN-US" style="font-family: Arial, sans-serif;"><br clear="all">
                            <span>&nbsp;</span></span>
                    </p>

                    <p class="MsoNormal"
                        style="line-height: 115%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 14px;">
                        <span lang="EN-US" style="font-family: Arial, sans-serif;">Adalah
                            benar sesuai ketentuan perundang-undangan yang berlaku. Apabila terdapat
                            kesalahan yang disengaja kami siap dituntut dan diberi sanksi sesuai dengan
                            ketentuan yang berlaku. </span>
                    </p>

                    <p class="MsoNormal"
                        style="line-height: 115%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 14px;">
                        <span lang="EN-US" style="font-family: Arial, sans-serif;">Demikian
                            surat pernyataan ini dibuat dengan sungguh-sungguh untuk dipergunakan
                            sebagaimana mestinya. </span>
                    </p>

                    <p class="MsoNormal"
                        style="margin: 0px; line-height: 115%; font-size: 15px; font-family: Calibri, sans-serif;"><span
                            lang="EN-US" style="font-family: Arial, sans-serif;">Pekanbaru, <a
                                name="_Hlk147052373"><span>&nbsp;</span></a>{{ \Carbon\Carbon::parse($mss->tglSurat)->translatedFormat('d F Y') }}</span>
                    </p>

                    <p class="MsoNormal"
                        style="margin: 0px; line-height: 115%; font-size: 15px; font-family: Calibri, sans-serif;"><span
                            lang="EN-US" style="font-family: Arial, sans-serif;">Hormat Kami </span></p>

                    <p class="MsoNormal"
                        style="margin: 0px; line-height: 115%; font-size: 15px; font-family: Calibri, sans-serif;"><span
                            lang="EN-US" style="font-family: Arial, sans-serif;">
                            @if ($mss->kop == 'QIN')
                                PT Quasar Inti Nusantara
                            @elseif ($mss->kop == 'ERA')
                                PT. Era Perkasa Mining
                            @endif
                        </span></p>

                    <p class="MsoNormal"
                        style="margin: 0px 0px 13px; font-size: 15px; font-family: Calibri, sans-serif; line-height: 107%;">
                        <span lang="EN-US" style="font-family: Arial, sans-serif;">&nbsp;</span><br>
                    </p>

                    <p class="MsoNormal"
                        style="margin: 0px 0px 13px; font-size: 15px; font-family: Calibri, sans-serif; line-height: 107%;">
                        <span lang="EN-US" style="font-family: Arial, sans-serif;"><span>&nbsp;</span></span><br>
                    </p>

                    <p class="MsoNormal"
                        style="margin: 0px; font-size: 15px; font-family: Calibri, sans-serif; line-height: 107%;"><span
                            lang="EN-US" style="font-family: Arial, sans-serif;">&nbsp;</span><br></p>

                    <p class="MsoNormal"
                        style="margin: 0px; font-size: 15px; font-family: Calibri, sans-serif; line-height: 107%;"><span
                            lang="EN-US" style="font-family: Arial, sans-serif;">&nbsp;</span><br></p>

                    <p class="MsoNormal"
                        style="margin: 0px; font-size: 15px; font-family: Calibri, sans-serif; line-height: 107%;"><span
                            lang="EN-US" style="font-family: Arial, sans-serif;">&nbsp;</span><br></p>

                    <p class="MsoNormal"
                        style="margin: 0px; font-size: 15px; font-family: Calibri, sans-serif; line-height: 107%;">
                        @if ($mss->kop == 'QIN')
                            <strong><u><span lang="EN-US"
                                        style="font-family: Arial, sans-serif;">Syahrial</span></u></strong>
                    </p>
                @elseif ($mss->kop == 'ERA')
                    <strong><u><span lang="EN-US" style="font-family: Arial, sans-serif;">Haryady Wijaya
                                Putro</span></u></strong></p>
    @endif

    <p class="MsoNormal" style="margin: 0px; line-height: 115%; font-size: 15px; font-family: Calibri, sans-serif;"><span
            lang="EN-US" style="font-family: Arial, sans-serif;">Direktur </span></p>
    @if ($mss->kop == 'ERA')
        <div class="footer-page">
            <img src="{{ asset('img/' . $mss->kop . '-bottom-kop.png') }}" style="max-width: 100%; height: auto;">
        </div>
    @endif
    </div>
    </div>
    </div>
    @endif

    @if ($mss->idPerihal == '8')
        <!-- SKAB -->
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i
                    class="bi bi-arrow-left-square"></i>
                Kembali</a>
            <div class="ml-auto">
                @if (auth()->user()->name == 'IT Support')
                    <form action="{{ route('it.approve', $mss->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">
                        <button class="btn btn-primary {{ $mss->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $mss->approve }}"
                            onclick="{{ $mss->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $mss->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i> Approve
                        </button>
                    </form>
                @endif
                <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                    href="{{ url('/dashboard/it/' . $mss->id . '/edit') }}"
                    @if ($mss->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
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
                    <img src="{{ asset('img/' . $mss->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" id="header-content"
                    style="padding-left:1in; padding-right:1in; align-items: normal;">
                    <p style="margin:0cm;text-align:center;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:14.0pt;"><span lang="EN-US"
                                dir="ltr"><strong>SURAT KETERANGAN ASAL BARANG (SKAB)</strong></span></span>
                    </p>
                    <p style="margin:0cm;text-align:center;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="EN-US"
                                dir="ltr"><strong>Nomor: {{ $mss->prefix }}</strong></span></span>
                    </p>
                    <p style="line-height:115%;margin:0cm 0cm 10pt;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:11pt;"><u>
                                <o:p><span style="text-decoration:none;"> </span></o:p>
                            </u></span>
                    </p>
                    <p style="line-height:115%;margin:0cm 0cm 10pt;text-align:justify;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:11pt;"><span lang="EN-US"
                                dir="ltr">Yang bertanda tangan di bawah ini, Direktur PT. Quasar Inti Nusantara,
                                sebagai pemegang Izin Usaha Pertambangan Operasi Produksi (IUP – OP), Keputusan Bupati
                                Kuantan Singingi, Provinsi Riau dengan Nomor : 406 Tahun 2009.</span></span>
                    </p>
                    <p style="line-height:115%;margin:0cm 0cm 10pt;text-align:justify;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:11pt;"><span lang="EN-US"
                                dir="ltr">Surat Keterangan asal Barang (SKAB) ini sebagai dokumen resmi sahnya
                                pengiriman Batubara yang berasal dari area IUP PT. Quasar Inti Nusantara kepada penerima
                                batubara sebagaimana nama dan alamat yang dimaksud dalam SKAB ini, sebagai berikut
                                :</span></span>
                    </p>
                    <div style="display: flex; align-items: baseline;">
                        <div style="width: 150px;">Asal Barang</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>PT. QUASAR INTI NUSANTARA</div>
                    </div>
                    <div style="display: flex; align-items: baseline;">
                        <div style="width: 150px;">Shipper</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>PT. GLOBAL ENERGI LESTARI<br>JL. SM AMIN NO. 11/8A DELIMA</div>
                    </div>
                    <div style="display: flex; align-items: baseline;">
                        <div style="width: 150px;">Nama Penerima</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>{{ $mss->namaPenerima }}</div>
                    </div>
                    @if ($mss->kop == 'ERA')
                        <div style="display: flex; align-items: baseline;">
                            <div style="width: 150px;">Notify</div>
                            <div style="margin-right: 10px;">:</div>
                            <div>{{ $mss->notify }}</div>
                        </div>
                    @endif
                    <div style="display: flex; align-items: baseline;">
                        <div style="width: 150px;">Jenis Muatan</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>INDONESIAN STEAM COAL</div>
                    </div>
                    <div style="display: flex; align-items: baseline;">
                        <div style="width: 150px;">Tonase</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>{{ $mss->tonase }}</div>
                    </div>
                    <div style="display: flex; align-items: baseline;">
                        <div style="width: 150px;">Tanggal Pemuatan</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>{{ \Carbon\Carbon::parse($mss->tglPemuatan)->translatedFormat('d F Y') }}</div>
                    </div>
                    <div style="display: flex; align-items: baseline;">
                        <div style="width: 150px;">Sarana Angkutan</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>{{ $mss->saranaAngkutan }}</div>
                    </div>
                    <div style="display: flex; align-items: baseline;">
                        <div style="width: 150px;">Pelabuhan Muat</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>{{ $mss->pelabuhanMuat }}</div>
                    </div>
                    <div style="display: flex; align-items: baseline;">
                        <div style="width: 150px;">Pelabuhan Tujuan</div>
                        <div style="margin-right: 10px;">:</div>
                        <div>{{ $mss->pelabuhanTujuan }}</div>
                    </div>
                    <p style="line-height:115%;margin:0cm 0cm 10pt;">
                        &nbsp;
                    </p>
                    <p style="line-height:115%;margin:0cm 0cm 10pt;text-align:justify;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:11pt;"><span lang="EN-US"
                                dir="ltr">Pengiriman dan pengangkutan batubara yang berasal dari tambang atas nama PT.
                                Quasar Inti Nusantara tanpa Surat Keterangan Asal Barang (SKAB) ini adalah tidak sah dan
                                dianggap tidak pernah terjadi pengiriman dan pengangkutan batubara.</span></span>
                    </p>
                    <p style="line-height:115%;margin:0cm 0cm 10pt;">
                        &nbsp;
                    </p>
                    <p style="margin:0cm;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:11pt;"><span lang="EN-US"
                                dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Pekanbaru,
                                {{ \Carbon\Carbon::parse($mss->tglSurat)->translatedFormat('d F Y') }}</span></span>
                    </p>
                    <p style="margin:0cm;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:11pt;"><span lang="EN-US"
                                dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @if ($mss->kop == 'QIN')
                                    PT Quasar Inti Nusantara
                                @elseif ($mss->kop == 'ERA')
                                    PT. Era Perkasa Mining
                                @endif
                            </span></span>
                    </p>
                    <p style="margin:0cm;">
                        &nbsp;
                    </p>
                    <p style="margin:0cm;">
                        &nbsp;
                    </p>
                    <p style="margin:0cm;">
                        &nbsp;
                    </p>
                    <p style="margin:0cm;">
                        &nbsp;
                    </p>
                    <p style="margin:0cm;tab-stops:365.25pt;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:11pt;"><span lang="EN-US"
                                dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
                    </p>
                    <p style="margin:0cm;">
                        &nbsp;
                    </p>
                    <p
                        style="margin:0cm;tab-stops:36.0pt 72.0pt 108.0pt 144.0pt 180.0pt 216.0pt 252.0pt 288.0pt 354.75pt;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:11pt;"><span lang="EN-US"
                                dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
                    </p>
                    <p style="margin:0cm;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:11pt;"><span lang="EN-US"
                                dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
                    </p>
                    <p style="margin:0cm;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:11pt;"><span lang="EN-US"
                                dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp; <u>SYAHRIAL</u></span></span>
                    </p>
                    <p style="margin:0cm;">
                        <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:11pt;"><span lang="EN-US"
                                dir="ltr">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;KTT</span></span>
                    </p>
                </div>
                @if ($mss->kop == 'ERA')
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $mss->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>
        </div>
    @endif

    @if ($mss->idPerihal == '9')
        <!-- SPKB -->
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i
                    class="bi bi-arrow-left-square"></i>
                Kembali</a>
            <div class="ml-auto">
                @if (auth()->user()->name == 'IT Support')
                    <form action="{{ route('it.approve', $mss->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">
                        <button class="btn btn-primary {{ $mss->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $mss->approve }}"
                            onclick="{{ $mss->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $mss->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i> Approve
                        </button>
                    </form>
                @endif
                <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                    href="{{ url('/dashboard/it/' . $mss->id . '/edit') }}"
                    @if ($mss->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
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
                    <img src="{{ asset('img/' . $mss->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" id="header-content"
                    style="padding-left:1in; padding-right:1in; align-items: normal;">

                    <h1
                        style='margin-top:0cm;margin-right:.45pt;margin-bottom:.0001pt;margin-left:0cm;text-align:center;text-indent:0cm;font-size:19px;font-family:"Cambria",serif;color:black;text-decoration:underline;'>
                        <span style='font-family:"Arial",sans-serif;'>SURAT PERNYATAAN KUALITAS BARANG (SPKB)</span>
                    </h1>
                    <h2
                        style='margin-top:0cm;margin-right:.35pt;margin-bottom:0cm;margin-left:.5pt;text-align:center;text-indent:-.5pt;font-size:16px;font-family:"Cambria",serif;color:black;font-weight:normal;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>{{ $mss->prefix }}</span></strong>
                    </h2>
                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:-.25pt;'><span
                            style='font-family:"Arial",sans-serif;'>Yang bertandatangan dibawah ini :&nbsp;</span></p>
                    <table style="border: none;width: 551px;border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td style="width: 156.05pt;padding: 0cm;height: 16.1pt;vertical-align: top;">
                                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>Nama &nbsp;</span>
                                    </p>
                                </td>
                                <td style="width: 257.3pt;padding: 0cm;height: 16.1pt;vertical-align: top;">
                                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>:
                                            @if ($mss->kop == 'ERA')
                                                Haryady Wijaya Putro&nbsp;
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                SYAHRIAL
                                            @endif
                                        </span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 156.05pt;padding: 0cm;height: 20.2pt;vertical-align: top;">
                                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>Jabatan &nbsp;</span>
                                    </p>
                                </td>
                                <td style="width: 257.3pt;padding: 0cm;height: 20.2pt;vertical-align: top;">
                                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>:
                                            @if ($mss->kop == 'ERA')
                                                Direktur Utama&nbsp;
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                DIREKTUR
                                            @endif
                                        </span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 156.05pt;padding: 0cm;height: 20.2pt;vertical-align: top;">
                                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>Perusahaan&nbsp;</span>
                                    </p>
                                </td>
                                <td style="width: 257.3pt;padding: 0cm;height: 20.2pt;vertical-align: top;">
                                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>:
                                            @if ($mss->kop == 'ERA')
                                                PT. ERA PERKASA MINING
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                PT. QUASAR INTI NUSANTARA
                                            @endif &nbsp;
                                        </span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 156.05pt;padding: 0cm;height: 20.2pt;vertical-align: top;">
                                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>Alamat Perusahaan &nbsp;
                                            &nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td style="width: 257.3pt;padding: 0cm;height: 20.2pt;vertical-align: top;">
                                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>:
                                            @if ($mss->kop == 'ERA')
                                                Jl. Kayu Manis No. 27 D
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                JL. TUANKU TAMBUSAI NO. 323
                                                KOTA &nbsp; &nbsp;&nbsp;PEKANBARU - INDONESIA
                                            @endif &nbsp;
                                        </span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 156.05pt;padding: 0cm;height: 16.1pt;vertical-align: top;">
                                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                                    </p>
                                </td>
                                <td style="width: 257.3pt;padding: 0cm;height: 16.1pt;vertical-align: top;">
                                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>&nbsp;
                                            @if ($mss->kop == 'ERA')
                                                Kec. Payung Sekaki, Pekanbaru
                                                Indonesia &nbsp;
                                            @endif
                                        </span>
                                    </p>
                                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:-.25pt;'><span
                            style='font-family:"Arial",sans-serif;'>Menyatakan bahwa batubara yang akan dijual domestik
                            oleh
                            @if ($mss->kop == 'ERA')
                                PT. Era Perkasa Mining
                            @endif
                            @if ($mss->kop == 'QIN')
                                PT. Quasar Inti Nusantara
                            @endif memiliki spesifikasi batubara sebagai berikut :&nbsp;
                        </span></p>
                    <table style="border: none;width: 637px;margin-left: 0.2pt;border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td rowspan="3"
                                    style="width:26.6pt;border:solid black 1.0pt;padding:2.55pt 4.3pt 0cm 5.4pt;height:15.65pt;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:1.2pt;line-height:106%;'>
                                        <strong><span style="font-family:Calibri;">NO&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 124.05pt;border-top: 1pt solid black;border-left: none;border-bottom: 1pt solid black;border-right: none;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-bottom:8.0pt;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 150.45pt;border-top: 1pt solid black;border-left: none;border-bottom: 1pt solid black;border-right: none;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:4.8pt;line-height:106%;'>
                                        <strong><span style="font-family:Calibri;">ASAL BATUBARA&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 108pt;border-top: 1pt solid black;border-right: 1pt solid black;border-bottom: 1pt solid black;border-image: initial;border-left: none;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-bottom:8.0pt;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                                    </p>
                                </td>
                                <td rowspan="2"
                                    style="width: 68.7pt;border-top: 1pt solid black;border-right: 1pt solid black;border-bottom: 1pt solid black;border-image: initial;border-left: none;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:Calibri;">URAIAN BARANG&nbsp;</span></strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="width: 124.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.9pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:5.0pt;line-height:106%;'>
                                        <strong><span style="font-family:Calibri;">NAMA PERUSAHAAN&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 150.45pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.9pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-right:1.5pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">NOMOR IUP&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 108pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.9pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-right:1.45pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">NPWP&nbsp;</span></strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="width: 124.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-right:1.25pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">(a)&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 150.45pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-right:1.25pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">(b)&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 108pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-right:1.25pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">(c)&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 68.7pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-right:1.05pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">(d)&nbsp;</span></strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="width:26.6pt;border:solid black 1.0pt;border-top:none;padding:2.55pt 4.3pt 0cm 5.4pt;height:29.05pt;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:2.0pt;line-height:106%;'>
                                        <span style="font-family:Calibri;">1&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 124.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 29.05pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">
                                            @if ($mss->kop == 'ERA')
                                                PT. Era Perkasa Mining
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                PT. Quasar Inti Nusantara
                                            @endif
                                        </span>
                                    </p>
                                </td>
                                <td
                                    style="width: 150.45pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 29.05pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>
                                            @if ($mss->kop == 'ERA')
                                                Kpts.80/DPMPTSP/2020
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                503/DPMPTSP/IZIN
                                                ESDM/35
                                            @endif
                                        </span>
                                    </p>
                                </td>
                                <td
                                    style="width: 108pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 29.05pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">
                                            @if ($mss->kop == 'ERA')
                                                02.481.749.6-216.000
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                02.623.177.9
                                                213.001
                                            @endif
                                        </span>
                                    </p>
                                </td>
                                <td
                                    style="width: 68.7pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 29.05pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">INDONESIA STEAM COAL&nbsp;</span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="width: 26.6pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 124.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 150.45pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 108pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 68.7pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 2.55pt 4.3pt 0cm 5.4pt;height: 15.65pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'><span
                            style='font-family:"Arial",sans-serif;'>&nbsp;</span></p>
                    <table style="border: none;width: 637px;margin-left: 0.5pt;border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td rowspan="3"
                                    style="width:37.9pt;border:solid black 1.0pt;padding:3.45pt 5.6pt 0cm 5.5pt;height:20.75pt;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:4.8pt;line-height:106%;'>
                                        <strong><span style="font-family:Calibri;">NO&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td rowspan="3"
                                    style="width:74.3pt;border:solid black 1.0pt;border-left:none;padding:3.45pt 5.6pt 0cm 5.5pt;height:20.75pt;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.1pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">TONASE&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 57.55pt;border-top: 1pt solid black;border-left: none;border-bottom: 1pt solid black;border-right: none;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 20.75pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-bottom:8.0pt;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 49pt;border-top: 1pt solid black;border-left: none;border-bottom: 1pt solid black;border-right: none;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 20.75pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-bottom:8.0pt;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                                    </p>
                                </td>
                                <td colspan="3"
                                    style="width: 168.95pt;border-top: 1pt solid black;border-left: none;border-bottom: 1pt solid black;border-right: none;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 20.75pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:15.2pt;line-height:106%;'>
                                        <strong><span style="font-family:Calibri;">KUALITAS BATUBARA&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td colspan="2"
                                    style="width: 90.05pt;border-top: 1pt solid black;border-right: 1pt solid black;border-bottom: 1pt solid black;border-image: initial;border-left: none;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 20.75pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-bottom:8.0pt;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="width: 57.55pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.15pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">TM (%)&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 49pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:3.4pt;line-height:106%;'>
                                        <strong><span style="font-family:Calibri;">IM(%)&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 63.85pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.15pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">ASH (%)&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 55.15pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:4.2pt;line-height:106%;'>
                                        <strong><span style="font-family:Calibri;">VM(%)&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 49.9pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.3pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">TS (%)&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td colspan="2"
                                    style="width: 90.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.3pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">GCV(Kcal/Kg)&nbsp;</span></strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="width: 57.55pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.35pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">AR&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 49pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.25pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">ADB&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 63.85pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.25pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">ADB&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 55.15pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-right:.1pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">ADB&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 49.9pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.25pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">ADB&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 44.85pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.3pt;text-align:center;line-height:106%;'>
                                        <strong><span style="font-family:  Calibri;">AR&nbsp;</span></strong>
                                    </p>
                                </td>
                                <td
                                    style="width: 45.15pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:5.2pt;line-height:106%;'>
                                        <strong><span style="font-family:Calibri;">ADB&nbsp;</span></strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="width: 37.9pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.45pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.25pt;text-align:center;line-height:106%;'>
                                        <span style="font-family:Calibri;">1&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 74.3pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.45pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;text-align:center;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>{{ $mss->tonase }}</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 57.55pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.45pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.3pt;text-align:center;line-height:106%;'>
                                        <span style="font-family:Calibri;">
                                            @if ($mss->kop == 'ERA')
                                                40.06
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                22.84
                                            @endif
                                        </span>
                                    </p>
                                </td>
                                <td
                                    style="width: 49pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.45pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.45pt;text-align:center;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>
                                            @if ($mss->kop == 'ERA')
                                                16.07
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                10.55
                                            @endif
                                        </span>
                                    </p>
                                </td>
                                <td
                                    style="width: 63.85pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.45pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.1pt;text-align:center;line-height:106%;'>
                                        <span style='font-family:"Arial",sans-serif;'>
                                            @if ($mss->kop == 'ERA')
                                                6.09
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                7.71
                                            @endif
                                        </span>
                                    </p>
                                </td>
                                <td
                                    style="width: 55.15pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.45pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.1pt;text-align:center;line-height:106%;'>
                                        <span style="font-family:Calibri;">
                                            @if ($mss->kop == 'ERA')
                                                39.65&nbsp;
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                43.76
                                            @endif
                                        </span>
                                    </p>
                                </td>
                                <td
                                    style="width: 49.9pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.45pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:.45pt;text-align:center;line-height:106%;'>
                                        <span style="font-family:Calibri;">
                                            @if ($mss->kop == 'ERA')
                                                0.30
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                0.55
                                            @endif
                                        </span>
                                    </p>
                                </td>
                                <td
                                    style="width: 44.85pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.45pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:2.6pt;line-height:106%;'>
                                        <span style="font-family:Calibri;">
                                            @if ($mss->kop == 'ERA')
                                                3.760
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                5.197
                                            @endif
                                        </span>
                                    </p>
                                </td>
                                <td
                                    style="width: 45.15pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.45pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:2.6pt;line-height:106%;'>
                                        <span style="font-family:Calibri;">
                                            @if ($mss->kop == 'ERA')
                                                5.265
                                            @endif
                                            @if ($mss->kop == 'QIN')
                                                6.023
                                            @endif
                                        </span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="width: 37.9pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 74.3pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 57.55pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 49pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 63.85pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 55.15pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 49.9pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 44.85pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                                <td
                                    style="width: 45.15pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 3.45pt 5.6pt 0cm 5.5pt;height: 16.4pt;vertical-align: top;">
                                    <p
                                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                                        <span style="font-family:Calibri;">&nbsp;&nbsp;</span>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p
                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-bottom:10.9pt;line-height:106%;'>
                        <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                    </p>
                    <p
                        style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-top:0cm;margin-right:0cm;margin-bottom:10.4pt;margin-left:-.25pt;'>
                        <span style='font-family:"Arial",sans-serif;'>Demikian surat pernyataan ini dibuat dengan
                            sungguh-sungguh untuk dipergunakan sebagaimana mestinya.&nbsp;</span>
                    </p>

                    @if ($mss->kop == 'ERA')
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:-.25pt;'>
                            <span style='font-family:"Arial",sans-serif;'>Pekanbaru,
                                {{ \Carbon\Carbon::parse($mss->tglSurat)->translatedFormat('d F Y') }}</span>
                        </p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:-.25pt;'><span
                                style='font-family:"Arial",sans-serif;'>Hormat Kami&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:-.25pt;'><span
                                style='font-family:"Arial",sans-serif;'>PT. Era Perkasa Mining&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'><span
                                style='font-family:"Arial",sans-serif;'>&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'><span
                                style='font-family:"Arial",sans-serif;'>&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'><span
                                style='font-family:"Arial",sans-serif;'>&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'><span
                                style='font-family:"Arial",sans-serif;'>&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'><span
                                style='font-family:"Arial",sans-serif;'>&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                            <strong><u><span style='font-family:"Arial",sans-serif;'>Haryady Wijaya
                                        Putro</span></u></strong>
                        </p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:-.25pt;'><span
                                style='font-family:"Arial",sans-serif;'>Direktur Utama</span></p>
                    @endif

                    @if ($mss->kop == 'QIN')
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:-.25pt;'>
                            <span style='font-family:"Arial",sans-serif;'>Pekanbaru,
                                {{ \Carbon\Carbon::parse($mss->tglSurat)->translatedFormat('d F Y') }}</span>
                        </p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:-.25pt;'><span
                                style='font-family:"Arial",sans-serif;'>Hormat Kami&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:-.25pt;'><span
                                style='font-family:"Arial",sans-serif;'>PT. Quasar Inti Nusantara&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'><span
                                style='font-family:"Arial",sans-serif;'>&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'><span
                                style='font-family:"Arial",sans-serif;'>&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'><span
                                style='font-family:"Arial",sans-serif;'>&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'><span
                                style='font-family:"Arial",sans-serif;'>&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'><span
                                style='font-family:"Arial",sans-serif;'>&nbsp;</span></p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;line-height:106%;'>
                            <strong><u><span style='font-family:"Arial",sans-serif;'>Syahrial</span></u></strong>
                        </p>
                        <p style='margin:0cm;font-size:15px;font-family:"Tahoma",sans-serif;margin-left:-.25pt;'><span
                                style='font-family:"Arial",sans-serif;'>Direktur</span></p>
                    @endif
                </div>
                @if ($mss->kop == 'ERA')
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $mss->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>
        </div>
    @endif


    <br /><br />
    <br>
    <br /><br />
    <br>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const documentContainer = document.getElementById('contentToConvert');
            const pageHeight = 900; // Height of A4 in mm

            function paginateContent() {
                const pages = Array.from(document.querySelectorAll('.page'));

                pages.forEach(page => {
                    let content = page.querySelector('.header-content');
                    let contentHeight = content.scrollHeight;
                    console.log("pages")

                    while (contentHeight > pageHeight) {
                        // Create a new page
                        let newPage = document.createElement('div');
                        newPage.className = 'page';

                        // Clone the header for the new page
                        let headerClone = document.querySelector('.header').cloneNode(true);
                        let footerClone = document.querySelector('.footer-page')?.cloneNode(true);
                        newPage.appendChild(headerClone);

                        let newContent = document.createElement('div');
                        newContent.className = 'header-content';

                        // Move overflowing content to the new page
                        while (content.scrollHeight > pageHeight && content.lastChild) {
                            newContent.insertBefore(content.lastChild, newContent.firstChild);
                        }

                        // Append the new content to the new page
                        newPage.appendChild(newContent);
                        footerClone ? newPage.appendChild(footerClone) : null;

                        documentContainer.appendChild(newPage);

                        // Recalculate content height for the current page
                        contentHeight = content.scrollHeight;
                        //paginateContent();
                    }
                });
            }

            document.addEventListener("DOMContentLoaded", paginateContent);

            paginateContent();

            var pdfjsLib = window['pdfjs-dist/build/pdf'];
            pdfjsLib.GlobalWorkerOptions.workerSrc =
                'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';
            @if (file_exists(public_path('uploads/' . $mss->lampiran)))
                pdfjsLib.getDocument('{{ asset('uploads/' . $mss->lampiran) }}').promise.then(function(pdf) {
                    for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                        pdf.getPage(pageNum).then(function(page) {
                            var canvas = document.createElement('canvas');
                            canvas.className = 'page';
                            var container = document.getElementById('viewerContainer');
                            container.appendChild(canvas);

                            var viewport = page.getViewport({
                                scale: 1
                            });
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            var ctx = canvas.getContext('2d');
                            var renderContext = {
                                canvasContext: ctx,
                                viewport: viewport
                            };

                            page.render(renderContext);
                        });
                    }
                });
            @endif

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
@endsection
