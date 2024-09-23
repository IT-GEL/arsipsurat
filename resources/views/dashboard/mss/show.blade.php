@extends('dashboard.layouts.main')

@section('container')

@if ( $mss->idPerihal  == "1")
<!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4" 
                style="
                        background-image: url('{{ asset('img/' . $mss->kop . '-kop.png') }}');
                        background-size: contain; /* Adjusts the image to fit within the body without stretching */
                        background-repeat: no-repeat; /* Prevents the image from repeating */
                        background-position: center; /* Centers the image */    
                ">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="/dashboard/mss" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
                        <a href="/dashboard/mss/{{ $mss->noSurat }}/cetak" class="btn btn-secondary" target="_blank"><i class="bi bi-printer"></i> Cetak</a>
                    </div>
                    <center style="margin-top: 50px;">
                        <br>
                        <br />
                        <table width="545">
                            <tr>
                                <td style="text-align: left">Jakarta, {{ formatDateIndonesian($mss->tglSurat) }}</td>
                            </tr>
                        </table>
                        <br><br>
                        <table width="545">
                            <tr>
                                <td style="text-align: left;font-weight: bold; text-transform: uppercase;"> {{ $mss->pttujuan }} </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;font-weight: bold;"> {!! $mss->alamat !!} </td>
                            </tr>
                        </table>
                        <br>
                        <table width="545">
                            <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold; text-transform: uppercase;" class="text">
                                <u>{{ $mss->perihal }}</u>
                            </td>

                            </tr>
                            <tr>
                            <td style="text-align: center; font-weight: bold; font:italic">{{ $mss->prefix }}</td>
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
                            <td width="335">{{ $mss->commodity }}</td>
                            </tr>
                        </table>
                        <table width="545">
                            <td width="20"> 2. </td>
                            <td width="200">Source</td>
                            <td width="10">:</td>
                            <td width="335">{{ $mss->source }}</td>
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
                            <td width="335">CIF {{ $mss->cif }}</td>
                        <table width="545">
                            <td width="200"></td>
                            <td width="35"></td>
                            <td width="335">FOB {{ $mss->fob }}</td>
                        </table>
                        <table width="545">
                            <td width="200"> </td>
                            <td width="35"></td>
                            <td width="335">FREIGHT {{ $mss->freight }}</td>
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
                        <br><br><br><br><br>
                    </center>
                </div>
            </div>
<!-- Recent Sales End -->

@endif

@if ( $mss->idPerihal  == "2")
<!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="/dashboard/mss" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
                        <a href="/dashboard/mss/{{ $mss->id }}/cetak" class="btn btn-secondary" target="_blank" ><i class="bi bi-printer"></i> Cetak</a>
                    </div>
                    <center style="margin-top: 50px;">
                        <table style="align-content: center">
                            <tr>
                            <td><img src="{{ asset('dashmin/img/GEL.png') }}" width="110" height="110" /></td>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 13px">
                                <center>
                                <font size="5"><b>GLOBAL ENERGI LESTARI</b> </font>
                                </center>
                            </td>
                            </tr>
                            <tr>
                            <td colspan="2"><hr style="border: 1px solid" /></td>
                            </tr>
                        </table>

                        <table width="545">
                            <tr>
                                <td style="text-align: right">Jakarta, {{ formatDateIndonesian($mss->tglSurat) }}</td>
                            </tr>
                        </table>
                        <br><br>
                        <table width="545">
                            <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; font-weight: bold; text-transform:uppercase" class="text">
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
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold; text-transform:uppercase" class="text">
                                <u>{{ $mss->perihal }} {{ $mss->ptkunjungan }}</u>
                            </td>
                            </tr>
                            <tr>
                            <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $mss->prefix }}</td>
                            </tr>
                        </table> 
                        <br>
                        <table width="545">
                            <tr>
                            <td>Dear {{ $mss->pttujuan }} </td>
                            </tr>
                            <tr>
                            <td>Kami PT. Global Energi Lestari (GEL) sebagai pemilik tambang batubara. Menindaklanjuti pengajuan permintaan kunjungan yang akan dilakukan oleh {{ $mss->pttujuan }} di tambang {{ $mss->ptkunjungan }} pada tanggal {{ $mss->tglSurat }}. Berikut nama yang akan melakukan kunjungan:</td>
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
                    </center>
                </div>
            </div>
<!-- Recent Sales End -->

@endif

@if ( $mss->idPerihal  == "3")
<!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4" 
                style="
                        background-image: url('{{ asset('img/' . $mss->kop . '-kop.png') }}');
                        background-size: contain; /* Adjusts the image to fit within the body without stretching */
                        background-repeat: no-repeat; /* Prevents the image from repeating */
                        background-position: center; /* Centers the image */    
                ">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="/dashboard/mss" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
                        <a href="/dashboard/mss/{{ $mss->id }}/cetak" class="btn btn-secondary" target="_blank"><i class="bi bi-printer"></i> Cetak</a>

                    </div>
                    <center style="margin-top: 50px;">
                        <br><br>
                    <table width="545">
                            <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; text-transform:uppercase; font-weight: bold" class="text">
                                <u>BERITA ACARA {{ $mss->perihalBA }}</u>
                            </tr>
                            <tr>
                            <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $mss->prefix }}</td>
                            </tr>
                        </table> 
                        <br>
                        <br>
                        <table width="545">
                            <tr>
                                <td style="text-align: right">Jakarta, {{ formatDateIndonesian($mss->tglSurat) }}</td>
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
                      <td> <img style="height:50px; weigth:50px;padding-left:45px;" src="{{ asset('img/qrcodes/' . $mss->qr ) }}" alt="QR Code"></td>
                        </tr>
                            <tr>
                            <td>Sales Departement,</td>
                        
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
                    </center>
                </div>
            </div>
<!-- Recent Sales End -->

@endif

@if ( $mss->perihal  == "Berita Acara Pembatalan PVR")
<!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4" 
                style="
                        background-image: url('{{ asset('img/' . $mss->kop . '-kop.png') }}');
                        background-size: contain; /* Adjusts the image to fit within the body without stretching */
                        background-repeat: no-repeat; /* Prevents the image from repeating */
                        background-position: center; /* Centers the image */    
                ">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="/dashboard/mss" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
                        <a href="/dashboard/mss/{{ $mss->id }}/cetak" class="btn btn-secondary" target="_blank"><i class="bi bi-printer"></i> Cetak</a>

                    </div>
                    <center style="margin-top: 50px;">
                    <table width="545">
                            <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; text-transform:uppercase; font-weight: bold" class="text">
                                <u>BERITA ACARA PEMBATALAN PVR</u>
                            </tr>
                            <tr>
                            <td style="text-align: center; font-weight: bold; font-style: italic;">{{ $mss->prefix }}</td>
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
                        <table width="545">
                            <tr>
                            <td>Demikian berita acara ini dibuat dengan sebenarnya sebagai dokumen pendukung untuk permintaan pembatalan PVR di bagian finance. Atas perhatian dan kerjasamanya, kami ucapkan terimakasih..</td>
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
                        </table>
                        <br /><br />
                        <br>
                        <br /><br />
                        <br>
                        <br /><br />
                        <br>
                        <br /><br />
                        <br>
                    </center>
                </div>
            </div>
<!-- Recent Sales End -->
@endif

@endsection