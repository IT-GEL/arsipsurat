

<!DOCTYPE html>
<html lang="en">
  <head>
  <head>
    <title>{{ $tax->perihal }}
        @if($tax->idPerihal == '3')
        {{ $tax->perihalBA }}
        @endif
    </title>
    <link rel="icon" type="image/png" href="{{ asset('dashmin/img/GEL.png') }}">
    <style>
    /* General Body Styles */
    @page {
        size: A4; /* Specify A4 size */
        margin: 0; /* Remove default margins */
    }

    body {
        font-family: 'Times New Roman', Times, serif;
        background-image: url('{{ asset('img/' . $tax->kop . '-kop.png') }}');
        background-size: 100% 100%; /* Adjusts the image to fit within the body without stretching */
        background-repeat: repeat-y; /* Prevents the image from repeating */
        background-position: center; /* Centers the image */
        padding-top: 10;
        height: 98vh; /* Ensures the body takes the full height */
    }

    /* Ensure background image is printed */
    @media print {
        body {
            -webkit-print-color-adjust: exact; /* Ensure color and background images are printed */
            print-color-adjust: exact;
        }
        table {
                page-break-inside: avoid;
            }
    }

    .table-keterangan {
            border-collapse: collapse;
            width: 545px; /* Optional: set width here if you want */
        }

        .table-keterangan td {
            border: 2px solid;
            padding: 8px;
        }

</style>
  </head>
  <body onload="window.print()"><br><br><br><br><br><br><br>
  <center>

  @if ( $tax->idPerihal  == "1")
  <br><br>
  @if ( $tax->kop  == "QIN")
                        <br /><br /><br />
                        @endif
                        @if ( $tax->kop  == "ERA")
                        <br /><br />
                        @endif
                        <table width="545">
                            <tr>
                                <td style="text-align: left">Jakarta, {{ formatDateIndonesian($tax->tglSurat) }}</td>
                            </tr>
                        </table>
                        <br><br>
                        <table width="545">
                            <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold; font:uppercase" class="text">
                                <u>{{ $tax->perihal }}</u>
                            </td>
                            </tr>
                            <tr>
                            <td style="text-align: center; font-weight: bold; font:italic">{{ $tax->prefix }}</td>
                            </tr>
                        </table>
                        <br>
                        <table width="545">
                            <tr>
                            <td>Dear {{ $tax->pttujuan }} </td>
                            </tr>
                            <tr>
                            <td>Hereby, we are pleased to confirm with Full Corporate authority and responsibilty to provide you the following commodity herein after descrived upon the terms and conditions as stated bellow :</td>
                            </tr>
                        </table>
                        <br /><br />
                        <table width="545">
                            <td width="20"> 1. </td>
                            <td width="200">Commodity</td>
                            <td width="10">:</td>
                            <td width="335">{{ $tax->nama }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 2. </td>
                            <td width="200">Source</td>
                            <td width="10">:</td>
                            <td width="335">{{ $tax->Source }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 3. </td>
                            <td width="200">Country of Origin</td>
                            <td width="10">:</td>
                            <td width="335">{{ $tax->country }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 4. </td>
                            <td width="200">Typical Specification</td>
                            <td width="10">:</td>
                            <td width="335">{{ $tax->spec }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 5. </td>
                            <td width="200">Validity Offer</td>
                            <td width="10">:</td>
                            <td width="335">{{ $tax->vo }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 6. </td>
                            <td width="200">Quantity</td>
                            <td width="10">:</td>
                            <td width="335">{{ $tax->qty }} (+/- 10%) for two barge</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 7. </td>
                            <td width="200">Loading Port</td>
                            <td width="10">:</td>
                            <td width="335">{{ $tax->lp }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 8. </td>
                            <td width="200">Destination Port</td>
                            <td width="10">:</td>
                            <td width="335">{{ $tax->dp }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 9. </td>
                            <td width="200">Price Scheme</td>
                            <td width="10">:</td>
                            <td width="335">CIF {{ $tax->cif }}</td>
                        <table width="545">
                            <td width="200"></td>
                            <td width="35"></td>
                            <td width="335">FOB {{ $tax->fob }}</td>
                        </table>
                        <table width="545">
                            <td width="200"> </td>
                            <td width="35"></td>
                            <td width="335">FREIGHT {{ $tax->freight }}</td>
                        </table>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20">10. </td>
                            <td width="200">Shipping Schedule</td>
                            <td width="10">:</td>
                            <td width="335">{{ $tax->shipschedule }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20">11. </td>
                            <td width="200">Term of Coal Delivery</td>
                            <td width="10">:</td>
                            <td width="335">{{ $tax->tcd }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20">12. </td>
                            <td width="200">Surveyor</td>
                            <td width="10">:</td>
                            <td width="335">{{ $tax->surveyor }}</td>
                            </tr>
                        </table>

                        <div style="page-break-after: always; "></div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        @if ( $tax->kop  == "QIN")
                        <br /><br /><br /><br>
                        @endif
                        @if ( $tax->kop  == "ERA")
                        <br /><br /><br /><br />
                        @endif

                        <table width="545" >
                            <tr>
                            <td width="20">13. </td>
                            <td width="200">Quality and Specification</td>
                            <td width="10">:</td>
                            <td width="335"></td>
                            </tr>
                        </table> <br>
                        <table width="545" >
                            <tr>
                            <td width="335" class="table-keterangan">{!! $tax->qas !!}</td>
                            </tr>
                        </table>
                        <br>
                        <table width="545">
                            <td width="20">14. </td>
                            <td width="200">Term of Payment</td>
                            <td width="10">:</td>
                            <td width="335">{{ $tax->top }}</td>
                            </tr>
                        </table>
                        <br>
                        <table width="545">
                            <tr>
                            <td>We look forward to receiving your favorable reply. Thank you for your attention and corporation.</td>
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
                        <table width="545" style="font-weight:bold;">
                            <tr>
                            <td><img style="height:50px; weigth:50px;padding-left:45px;" src="{{ asset('img/qrcodes/' . $tax->qr ) }}" alt="QR Code"></td>
                            </tr>
                        </table>
                        <br><br><br>
                        <table width="545" style="font-weight:bold;">
                            <tr>
                            <td>Ervina W</td>
                            </tr>
                            <tr>
                            <td>tax Ops Mgr</td>
                            </tr>
                        </table>
                        <br><br><br><br><br>

@endif







  @if ( $tax->idPerihal  == "2")
  <br><br><br>
                        <table width="545">
                            <tr>
                                <td style="text-align: right">Jakarta, {{ formatDateIndonesian($tax->tglSurat) }}</td>
                            </tr>
                        </table>
                        <br><br>
                        <table width="545">
                            <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; font-weight: bold; text-transform:uppercase" class="text">
                                {{ $tax->pttujuan }}
                            </td>
                            </tr>
                            <tr>
                            <td>{!! $tax->alamat !!}</td>
                            </tr>
                        </table>
                        <br>
                        <table width="545">
                            <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold; text-transform:uppercase" class="text">
                                <u>{{ $tax->perihal }} {{ $tax->ptkunjungan }}</u>
                            </td>
                            </tr>
                            <tr>
                            <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $tax->prefix }}</td>
                            </tr>
                        </table>
                        <br>
                        <table width="545">
                            <tr>
                            <td>Dear {{ $tax->pttujuan }} </td>
                            </tr>
                            <tr>
                            <td>Kami PT. Global Energi Lestari (GEL) sebagai pemilik tambang batubara. Menindaklanjuti pengajuan permintaan kunjungan yang akan dilakukan oleh {{ $tax->pttujuan }} di tambang {{ $tax->ptkunjungan }} pada tanggal {{ $tax->tglSurat }}. Berikut nama yang akan melakukan kunjungan:</td>
                            </tr>
                        </table>
                        <br><br>
                        <table class="table-keterangan" width="545">
                            <tr>
                            <td style="border: 0px;">{!! $tax->keterangan !!}</td>
                            </tr>
                        </table>
                        <br><br>
                        <table width="545">
                            <tr>
                            <td>Demikianlah surat izin kunjungan ini kami buat. Mohon dapat dipergunakan sebagaimana mestinya.</td>
                            </tr>
                        </table>
                        <br /><br />
                        <table width="545">
                            <tr>
                            <td>Hormat Kami,</td>
                            </tr>
                        </table>
                        <br>
                    @endif



                    @if ( $tax->idPerihal  == "3")
                    <br><br><br>
                        <table width="545">
                            <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; text-transform:uppercase; font-weight: bold" class="text">
                                <u>BERITA ACARA</u>
                            </tr>
                            <tr>
                            <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $tax->prefix }}</td>
                            </tr>
                        </table>
                        <br>
                        <br>
                        <table width="545">
                            <tr>
                                <td style="text-align: right">Jakarta, {{ formatDateIndonesian($tax->tglSurat) }}</td>
                            </tr>
                        </table>
                        <br><br>
                        <table class="table-keterangan" width="545">
                            <tr>
                            <td style="border: 0px;">{!! $tax->keterangan !!}</td>
                            </tr>
                        </table>
                        <br>
                        <table width="545">
                            <tr>
                            <td>Demikian berita acara ini dibuat dengan sebenarnya sebagai dokumen pendukung untuk permintaan pengajuan PVR di bagian finance. Atas perhatian dan kerjasamanya, kami ucapkan terimakasih..</td>
                            </tr>
                        </table>
                        <br /><br /><br /><br /><br><br>
                        <table width="545">
                        <tr style="">
                            <td style="padding-left: 45px;">Dibuat</td>
                            <td style="padding-left: 100px;">Mengetahui</td>
                        </tr>
                            <tr>
                            <td>Sales Departement,</td>
                            </tr>
                            <tr>
                      <td> <img style="height:50px; weigth:50px;padding-left:45px;" src="{{ asset('img/qrcodes/' . $tax->qr ) }}" alt="QR Code"></td>
                        </tr>
                        </table>
                        <br /><br />
                        <br>
                        <br /><br />
                        <br>
                        <br /><br />
                        <br>
                        <br /><br />
                        <br>
                    @endif

        </center>
  </body>
</html>

