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

    @if ($it->idPerihal == '1')
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
                Kembali</a>
            <div class="ml-auto">
                @if (auth()->user()->name == 'IT Support')
                    <form action="{{ route('it.approve', $it->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">
                        <button class="btn btn-primary {{ $it->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $it->approve }}"
                            onclick="{{ $it->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $it->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i> Approve
                        </button>
                    </form>
                @endif
                <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                    href="{{ url('/dashboard/it/' . $it->id . '/edit') }}"
                    @if ($it->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
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
                    <img src="{{ asset('img/' . $it->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content" style="padding-left:1in; padding-right:1in;">

                    <p style="line-height:115%;margin:0cm;">
                        &nbsp;
                    </p>
                    <p style="line-height:115%;margin:0cm;text-align:center;">
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:18pt;"><span lang="EN-US"
                                dir="ltr"><u>BERITA ACARA</u></span></span>
                    </p>
                    <p style="line-height:115%;margin:0cm;text-align:center;">
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN"
                                dir="ltr">{{ $it->prefix }}</span></span>
                    </p>
                    <p style="line-height:115%;margin:0cm;text-align:center;">
                        &nbsp;
                    </p>
                    <p style="line-height:115%;margin:0cm;">
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN"
                                dir="ltr">Jakarta, {{ formatDateIndonesian($it->tglSurat) }}</span></span><br>
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN"
                                dir="ltr">Perihal : {{ $it->perihalLanjutan }}</span></span>
                    </p>
                    <p style="line-height:115%;margin:0cm;">
                        &nbsp;
                    </p>
                    <p style="line-height:115%;margin:0cm;">
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN"
                                dir="ltr">Kami yang bertanda tangan di bawah ini:</span></span>
                    </p>
                    <p style="line-height:115%;margin:0cm;">
                        &nbsp;
                    </p>
                    <div style="display: flex; align-items: center;">
                        <div style="width: 250px; font-family:'Times New Roman', serif;font-size:12pt;">
                            <strong>Nama</strong>
                        </div>
                        <div style="margin-right: 10px; font-family:'Times New Roman', serif;font-size:12pt;">
                            <strong>:</strong>
                        </div>
                        <div style="font-family:'Times New Roman', serif;font-size:12pt;"><strong>Habib Herbianto</strong>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <div style="width: 250px; font-family:'Times New Roman', serif;font-size:12pt;">
                            <strong>Department</strong>
                        </div>
                        <div style="margin-right: 10px; font-family:'Times New Roman', serif;font-size:12pt;">
                            <strong>:</strong>
                        </div>
                        <div style="font-family:'Times New Roman', serif;font-size:12pt;"><strong>IT</strong></div>
                    </div>
                    <p style="line-height:115%;margin:0cm;">
                        &nbsp;
                    </p>
                    <p style="line-height:115%;margin:0cm;">
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN"
                                dir="ltr">Menyatakan bahwa berdasarkan hasil pemeriksaan terhadap laptop yang digunakan
                                oleh karyawan atas nama :</span></span>
                    </p>
                    <p style="line-height:115%;margin:0cm;">
                        &nbsp;
                    </p>
                    <div style="display: flex; align-items: center;">
                        <div style="width: 250px; font-family:'Times New Roman', serif;font-size:12pt;">
                            <strong>Nama</strong>
                        </div>
                        <div style="margin-right: 10px; font-family:'Times New Roman', serif;font-size:12pt;">
                            <strong>:</strong>
                        </div>
                        <div style="font-family:'Times New Roman', serif;font-size:12pt;"><strong>{{ $it->nama }}
                                @if ($it->noKaryawan !== null)
                                    ({{ $it->noKaryawan }})
                                @endif
                            </strong></div>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <div style="width: 250px; font-family:'Times New Roman', serif;font-size:12pt;">
                            <strong>Department</strong>
                        </div>
                        <div style="margin-right: 10px; font-family:'Times New Roman', serif;font-size:12pt;">
                            <strong>:</strong>
                        </div>
                        <div style="font-family:'Times New Roman', serif;font-size:12pt;">
                            <strong>{{ $it->departement }}</strong>
                        </div>
                    </div>
                    <p style="line-height:115%;margin:0cm;">
                        &nbsp;
                    </p>
                    <p style="line-height:115%;margin:0cm;">
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN"
                                dir="ltr">Ditemukan permasalahan sebagai berikut :</span></span>
                    </p>
                    <ol style="padding-left:48px;">
                        @if ($it->hardware !== null)
                            <li>
                                <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                                    <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span
                                            lang="IN" dir="ltr"><strong>Kedala Hardware
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                :&nbsp; </strong>{{ $it->hardware }}</span></span>
                                </p>
                            </li>
                        @endif
                        @if ($it->software !== null)
                            <li>
                                <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                                    <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span
                                            lang="IN" dir="ltr"><strong>Kedala Software
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                :&nbsp; </strong>{{ $it->software }}</span></span>
                                </p>
                            </li>
                        @endif
                        @if ($it->specProblem !== null)
                            <li>
                                <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                                    <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span
                                            lang="IN" dir="ltr"><strong>Spesifikasi tidak memadai</strong>
                                            &nbsp;&nbsp;<strong>:</strong> {{ $it->specProblem }}</span></span>
                                </p>
                            </li>
                        @endif
                    </ol>
                    <p style="line-height:115%;margin:0cm;">
                        &nbsp;
                    </p>
                    <p style="line-height:115%;margin:0cm;">
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN"
                                dir="ltr">{!! $it->keterangan !!}</span></span>
                    </p>

                    <p style="line-height:115%;margin:0cm;">
                        &nbsp;
                    </p>
                    <p style="line-height:115%;margin:0cm;">
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN"
                                dir="ltr">Dibuat,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                                Mengetahui,</span></span><br>
                        <br>

                    </p>
                    <p style="line-height:115%;margin:0cm;">
                        <img style="height:125px; weigth:125px;padding-left:45px;"
                            src="{{ asset('img/qrcodes/' . $it->qr) }}" alt="QR Code">
                    </p>
                    <p style="line-height:115%;margin:0cm;">
                        <br>
                        <br>
                        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN"
                                dir="ltr"><strong>Habib
                                    Herbianto</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </span><span lang="EN-US" dir="ltr"><strong>&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    (Johnson Hartawan )&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    &nbsp;</strong></span></span>
                    </p>
                </div>
                @if ($it->kop !== null)
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $it->kop . '-bottom-kop.png') }}"
                            style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>
        </div>
    @endif

    @if ($it->idPerihal == '2')
        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
                    <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i
                            class="bi bi-arrow-left-square"></i>
                        Kembali</a>
                    <div class="ml-auto">
                        @if (auth()->user()->name == 'IT Support')
                            <form action="{{ route('it.approve', $it->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('put')
                                <input type="hidden" name="approve" value="yes">
                                <button class="btn btn-primary {{ $it->approve ? 'btn-success' : 'btn-secondary' }}"
                                    data-approved="{{ $it->approve }}"
                                    onclick="{{ $it->approve ? 'return false;' : 'berhasil(this);' }}"
                                    {{ $it->approve ? 'disabled' : '' }}>
                                    <i class="bi bi-check2-square"></i> Approve
                                </button>
                            </form>
                        @endif
                        <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                            href="{{ url('/dashboard/it/' . $it->id . '/edit') }}"
                            @if ($it->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        <button id="download-pdf" class="btn btn-primary" style="margin-left:10px;">
                            <i class="bi bi-file-earmark-pdf-fill"></i> Unduh
                        </button>
                    </div>
                </div>
                <center style="margin-top: 50px;">
                    <!-- Header -->
                    <table style="align-content: center">
                        <tr>
                            <td><img src="{{ asset('dashmin/img/GEL.png') }}" width="110" height="110" /></td>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 13px">
                                <center>
                                    <font size="5"><b>GLOBAL ENERGI LESTARI</b></font><br />
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr style="border: 1px solid" />
                            </td>
                        </tr>
                    </table>
                    <br />

                    <!-- Title and Reference Number -->
                    <table width="545">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold"
                                class="text">
                                <u>FORMULIR KEBUTUHAN BASIS IT</u>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center">Nomor :
                                {{ $it->prefix }}</td>
                        </tr>
                    </table>
                    <br>

                    <!-- Applicant Details -->
                    <table width="545">
                        <tr>
                            <td>Saya yang bertandatangan dibawah ini :</td>
                        </tr>
                    </table>
                    <br /><br />
                    <table width="545">
                        <tr>
                            <td width="200">Nama</td>
                            <td width="10">:</td>
                            <td width="335">{{ $it->nama }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <tr>
                            <td width="200">Jabatan</td>
                            <td width="10">:</td>
                            <td width="335">{{ $it->jabatan }}</td>
                        </tr>
                    </table>
                    <table width="545">
                        <tr>
                            <td width="200">Divisi</td>
                            <td width="10">:</td>
                            <td width="335">{{ $it->divisi }}</td>
                        </tr>
                    </table>
                    <br /><br />

                    <!-- Request Details -->
                    <table width="545">
                        <tr>
                            <td>Dengan ini mengajukan ijin untuk {{ $it->perihal }} :</td>
                        </tr>
                    </table>
                    <table width="545">
                        <tr>
                            <td>
                                {!! $it->keterangan !!}
                            </td>
                        </tr>
                    </table>
                    <br /><br />

                    <!-- Footer -->
                    <br /><br /><br />
                    <table width="545">
                        <tr>
                            <td style="text-align: left">Pada Hari & Tanggal : {{ formatDateIndonesian($it->tglSurat) }}
                            </td>
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
                            <td>
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
            </div>
        </div>
        <!-- Recent Sales End -->
    @endif

    @if ($it->idPerihal == '3')
        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="{{ url()->previous() }}" class="btn btn-success"><i
                    class="bi bi-arrow-left-square"></i>
                Kembali</a>
            <div class="ml-auto">
                @if (auth()->user()->name == 'IT Support')
                    <form action="{{ route('it.approve', $it->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">
                        <button class="btn btn-primary {{ $it->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $it->approve }}"
                            onclick="{{ $it->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $it->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i> Approve
                        </button>
                    </form>
                @endif
                <button class="btn btn-primary btn-warning" style="margin-left:10px;"
                    href="{{ url('/dashboard/it/' . $it->id . '/edit') }}"
                    @if ($it->approve == '1') style="pointer-events:none; opacity:0.5;" @endif>
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
                <button id="download-pdf" class="btn btn-primary" style="margin-left:10px;">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Unduh
                </button>
            </div>
        </div>
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <table border="0" cellpadding="0" cellspacing="0" width="652" style="width: 651px;border:1px solid black;">


                    <tbody>
                        <tr height="25" style="height: 25px;">
                            <td colspan="11" height="25" class="xl93" width="652" style="text-align: center; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 25px; width: 651px;">FORMULIR KEBUTUHAN BASIS IT</td>
                        </tr>
                        <tr height="24" style="height: 25px;">
                            <td colspan="11" height="24" class="xl96" style="text-align: center; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 25px;">{{ $it->prefix }}</td>
                        </tr>
                        <tr height="40" style="height: 40px;">
                            <td height="40" class="xl65" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 40px;">&nbsp;<br></td>
                            <td class="xl78" colspan="5" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Saya yang bertandatangan
                                dibawah ini,</td>
                            <td class="xl74" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl74" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl74" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl74" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl67" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="40" style="height: 40px;">
                            <td height="40" class="xl82" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 40px;">&nbsp;<br></td>
                            <td class="xl81" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Nama</td>
                            <td class="xl77" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">:</td>
                            <td class="xl76" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">{{ $it->nama }}<br></td>
                        </tr>
                        <tr height="40" style="height: 40px;">
                            <td height="40" class="xl82" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 40px;">&nbsp;<br></td>
                            <td class="xl77" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Jabatan</td>
                            <td class="xl77" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">:</td>
                            <td class="xl76" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">{{ $it->jabatan }}<br></td>
                        </tr>
                        <tr height="40" style="height: 40px;">
                            <td height="40" class="xl82" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 40px;">&nbsp;<br></td>
                            <td class="xl77" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Divisi</td>
                            <td class="xl77" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">:</td>
                            <td class="xl76" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">{{ $it->divisi}}<br></td>
                        </tr>
                        <tr height="40" style="height: 40px;">
                            <td height="40" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 40px;">&nbsp;<br></td>
                            <td class="xl85" colspan="3" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Dengan ini mengajukan
                                ijin untuk (Jelaskan rincian permintaan/alasan) :</td>
                            <td class="xl74" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl66" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl66" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl66" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl66" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl67" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="40" style="height: 40px;">
                            <td height="40" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 40px;">&nbsp;<br></td>
                            <td colspan="9" class="xl99" width="640" style="text-align: left; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; width: 637px;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="37" style="height: 37px;">
                            <td height="37" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 37px;">&nbsp;<br></td>
                            <td colspan="9" class="xl102" style="text-align: left; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="29" style="height: 29px;">
                            <td height="29" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 29px;">&nbsp;<br></td>
                            <td class="xl92" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl72" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="40" style="height: 40px;">
                            <td height="40" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 40px;">&nbsp;<br></td>
                            <td colspan="9" class="xl105" width="640" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; width: 637px;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="29" style="height: 29px;">
                            <td height="29" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 29px;">&nbsp;<br></td>
                            <td class="xl92" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl72" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="29" style="height: 29px;">
                            <td height="29" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 29px;">&nbsp;<br></td>
                            <td class="xl92" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl72" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="40" style="height: 40px;">
                            <td height="40" class="xl82" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 40px;">&nbsp;<br></td>
                            <td class="xl81" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Pada Hari &amp; Tanggal</td>
                            <td class="xl86" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl90" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl86" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl86" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl86" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl86" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl86" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl87" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl80" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="20" style="height: 20px;">
                            <td height="20" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 20px;">&nbsp;<br></td>
                            <td class="xl83" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Dept.</td>
                            <td class="xl83" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Mengetahui,</td>
                            <td class="xl66" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl66" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl67" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl83" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Menyetujui</td>
                            <td class="xl65" colspan="2" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Menyetujui,</td>
                            <td class="xl67" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="20" style="height: 20px;">
                            <td height="20" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 20px;">&nbsp;<br></td>
                            <td class="xl73" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl88" colspan="3" style="text-align: left; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Talent &amp; Culture</td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl73" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">General Manager - FAT</td>
                            <td class="xl68" colspan="3" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Direktur
                                PT GELTECH</td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="20" style="height: 20px;">
                            <td height="20" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 20px;">&nbsp;<br></td>
                            <td class="xl73" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl89" style="text-align: center; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl73" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="20" style="height: 20px;">
                            <td height="20" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 20px;">&nbsp;<br></td>
                            <td class="xl73" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl89" style="text-align: center; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl73" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="20" style="height: 20px;">
                            <td height="20" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 20px;">&nbsp;<br></td>
                            <td class="xl73" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl89" style="text-align: center; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl73" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="20" style="height: 20px;">
                            <td height="20" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 20px;">&nbsp;<br></td>
                            <td class="xl73" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl89" style="text-align: center; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl73" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="20" style="height: 20px;">
                            <td height="20" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 20px;">&nbsp;<br></td>
                            <td class="xl73" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl89" style="text-align: center; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl73" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;"><br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>
                        <tr height="20" style="height: 20px;">
                            <td height="20" class="xl68" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; height: 20px;">&nbsp;<br></td>
                            <td class="xl84" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Tanggal :</td>
                            <td class="xl84" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Tanggal :</td>
                            <td class="xl71" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl91" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl72" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl84" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Tanggal :</td>
                            <td class="xl70" colspan="2" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">Tanggal :</td>
                            <td class="xl72" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                            <td class="xl69" style="padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap;">&nbsp;<br></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    @endif

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

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                swalWithBootstrapButtons.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form if confirmed
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelled",
                            text: "Your imaginary file is safe :)",
                            icon: "error"
                        });
                    }
                });
            });
        });

        function berhasil(button) {
            const isApproved = button.getAttribute('data-approved') === 'true';

            if (!isApproved) {
                button.classList.remove('btn-secondary');
                button.classList.add('btn-success');
                button.setAttribute('data-approved', 'true');
                button.disabled = true; // Disable to prevent double submissions

                Swal.fire({
                    title: "Approved!",
                    text: "Berhasil di approve",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    button.closest('form').submit(); // Submit the form
                });
            } else {
                Swal.fire({
                    title: "Already Approved!",
                    text: "This document has already been approved.",
                    icon: "info",
                    confirmButtonText: "OK"
                });
            }
        }
    </script>

@endsection
