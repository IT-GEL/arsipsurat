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

    @if ($tnc->idPerihal == '1')
        <!-- Surat Internal Memo -->
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
