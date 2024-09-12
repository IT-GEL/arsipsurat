
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

    $monthNumber = date('n', strtotime($mss->tglSurat));
    $romanMonth = monthToRoman($monthNumber);
@endphp

<!DOCTYPE html>
<html lang="en">
  <head>
  <head>
    <title>FORMULIR KEBUTUHAN BASIS MSS | {{ $mss->perihal }}</title>
    <link rel="icon" type="image/png" href="{{ asset('dashmin/img/GEL.png') }}">
    <style>
        /* General Body Styles */
        body {
            margin: 0 auto;
            width: 600px;
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
  </head>
  <body onload="window.print()">
    <center>
      <table width="450">
        <tr>
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
                                <td style="text-align: left">Jakarta, {{ formatDateIndonesian($mss->tglSurat) }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold; font:uppercase" class="text">
                                <u>{{ $mss->perihal }}</u>
                            </td>
                            </tr>
                            <tr>
                            <td style="text-align: center; font-weight: bold; font:italic">Ref. No:MSS/GEL/BA-{{ $mss->noSurat }}/{{ $romanMonth }}/2024</td>
                            </tr>
                        </table> 
                        <br>
                        <table width="545">
                            <tr>
                            <td>Dear {{ $mss->pttujuan }} </td>
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
                            <td width="335">{{ $mss->nama }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 2. </td>
                            <td width="200">Source</td>
                            <td width="10">:</td>
                            <td width="335">{{ $mss->Source }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 3. </td>
                            <td width="200">Country of Origin</td>
                            <td width="10">:</td>
                            <td width="335">{{ $mss->country }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 4. </td>
                            <td width="200">Typical Specification</td>
                            <td width="10">:</td>
                            <td width="335">{{ $mss->spec }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 5. </td>
                            <td width="200">Validity Offer</td>
                            <td width="10">:</td>
                            <td width="335">{{ $mss->vo }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 6. </td>
                            <td width="200">Quantity</td>
                            <td width="10">:</td>
                            <td width="335">{{ $mss->qty }} (+/- 10%) for two barge</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 7. </td>
                            <td width="200">Loading Port</td>
                            <td width="10">:</td>
                            <td width="335">{{ $mss->lp }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 8. </td>
                            <td width="200">Destination Port</td>
                            <td width="10">:</td>
                            <td width="335">{{ $mss->dp }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 9. </td>
                            <td width="200">Price Scheme</td>
                            <td width="10">:</td>
                            <td width="335">{{ $mss->cif }}</td>
                        <table width="545">
                            <td width="200"></td>
                            <td width="10"></td>
                            <td width="335">{{ $mss->fob }}</td>
                        </table>
                        <table width="545">
                            <td width="200"> </td>
                            <td width="10"></td>
                            <td width="335">{{ $mss->freight }}</td>
                        </table>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20">10. </td>
                            <td width="200">Shipping Schedule</td>
                            <td width="10">:</td>
                            <td width="335">{{ $mss->shipschedule }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20">11. </td>
                            <td width="200">Term of Coal Delivery</td>
                            <td width="10">:</td>
                            <td width="335">{{ $mss->tcd }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20">12. </td>
                            <td width="200">Surveyor</td>
                            <td width="10">:</td>
                            <td width="335">{{ $mss->surveyor }}</td>
                            </tr>
                        </table>
                        <br>
                    </center>
  </body>
</html>
