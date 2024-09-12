
<!DOCTYPE html>
<html lang="en">
  <head>
  <head>
    <title>FORMULIR KEBUTUHAN BASIS IT | {{ $it->perihal }}</title>
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
      <table width="450">
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
                            <td>Dengan ini mengajukan ijin untuk {{ $it->perihal }} : </td>
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
  </body>
</html>
