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

    @if ($finap->idPerihal == '1')
        <!-- Surat Internal Memo -->
        <!-- Recent Sales Start -->

        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="/dashboard/finap" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
                Kembali</a>
            {{-- <a href="/dashboard/finap/{{ $finap->id }}/cetak" class="btn btn-secondary" target="_blank"><i
                    class="bi bi-printer"></i> Cetak</a> --}}
            <div>
                <a href="/dashboard/finap/{{ $finap->id }}/cetak" id="download-pdf" class="btn btn-secondary"
                    target="_blank"><i class="bi bi-printer"></i> Cetak</a>
                <a class="btn btn-primary" href="{{ url('/dashboard/finap/' . $finap->id . '/edit') }}"><i
                        class="bi bi-pencil-square"></i>Edit</a>
                @if (auth()->user()->name == 'Finance AP')
                    <form action="{{ route('finap.approve', $finap->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">

                        <button class="btn {{ $finap->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $finap->approve }}"
                            onclick="{{ $finap->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $finap->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i>Approve{{ $finap->approve ? 'd' : '' }}
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/GEL-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content">
                    {{-- <center style="margin-top: 50px;"> --}}

                    <table width="600">
                        <tr>
                            <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold; text-transform: uppercase;"
                                class="text">
                                <u>{{ $finap->perihal }}</u>
                            </td>

                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold; font:italic">{{ $finap->prefix }}</td>
                        </tr>
                    </table>

                    <br>



                    <table style="border-collapse: collapse; width: 600; font-size:15px;">
                        <tr>
                            <td style="text-align: left; width: 15%;">Vendor</td>
                            <td style="text-align: left; padding-right: 5;">:</td>
                            <td style="text-align: left; width: 55%;">{{ $finap->vendor }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; width: 15%;">Departement</td>
                            <td style="text-align: left; padding-right: 5;">:</td>
                            <td style="text-align: left; width: 55%;">{{ $finap->departement }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; width: 15%;">Tanggal</td>
                            <td style="text-align: left; padding-right: 5;">:</td>
                            <td style="text-align: left; width: 55%;">{{ $finap->tglSurat }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; width: 15%;font-weight:bold;">Due Date</td>
                            <td style="text-align: left; padding-right: 5;font-weight:bold;">:</td>
                            <td style="text-align: left; width: 55%;font-weight:bold;">{{ $finap->dueDate }}</td>

                            <td style="text-align: left; width: 15%;">COA</td>
                            <td style="text-align: left; padding-right: 5;">:</td>
                            <td style="text-align: left; width: 40%;">{{ $finap->coa }}</td>
                        </tr>
                    </table>
                    <br>
                    <table width="700" style="font-size:15px;">
                        <tr>
                            <td>Dengan Ini Kami Mengajukan Pembayaran Untuk :</td>
                        </tr>
                    </table>

                    <table style="border-collapse: collapse; width: 700;font-size:15px;">
                        <tr style="text-align:center;">
                            <th style="border: 1px solid black;">NO</th>
                            <th style="border: 1px solid black;">KETERANGAN</th>
                            <th style="border: 1px solid black;">JUMLAH</th>
                        </tr>
                        @foreach ($items as $index => $item)
                            <tr>
                                <td style="border-left: 1px solid black;"></td>
                                <td style="border-left: 1px solid black; border-right: 1px solid black; text-transform:uppercase;">{{ $item['deskripsi'] }}</td>
                                <td style="border-right: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="border-left: 1px solid black;text-align:center;">1</td>
                                <td style="border-left: 1px solid black; border-right: 1px solid black;">Pokok</td>
                                <td style="border-left: 1px solid black; border-right: 1px solid black; text-align: left;padding-left:5px;">
                                    Rp <span style="float: right; right; padding-right:5px;">{{ number_format($item['pokok'] ?? 0, 0, ',', '.') ?: '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-left: 1px solid black; text-align:center;">2</td>
                                <td style="border-left: 1px solid black; border-right: 1px solid black;">Bunga</td>
                                <td style="border-right: 1px solid black;padding-left:5px;">
                                    Rp <span style="float: right; right; padding-right:5px;">{{ number_format($item['bunga'] ?? 0, 0, ',', '.') ?: '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-left: 1px solid black;text-align:center;">3</td>
                                <td style="border-left: 1px solid black; border-right: 1px solid black;">Admin</td>
                                <td style="border-right: 1px solid black;padding-left:5px;">
                                    Rp <span style="float: right; right; padding-right:5px;">{{ number_format($item['admin'] ?? 0, 0, ',', '.') ?: '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-left: 1px solid black;text-align:center;">4</td>
                                <td style="border-left: 1px solid black; border-right: 1px solid black;">Denda</td>
                                <td style="border-right: 1px solid black;padding-left:5px;">
                                    Rp <span style="float: right; right; padding-right:5px;">{{ number_format($item['denda'] ?? 0, 0, ',', '.') ?: '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;text-align:center;"><br></td>
                                <td style="border-bottom: 1px solid black; border-right: 1px solid black;"><br></td>
                                <td style="border-bottom: 1px solid black; border-right: 1px solid black;"><br></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td><br></td>
                                <td style="border: 1px solid black;padding-left:5px;"><b>Rp <span style="float: right; padding-right:5px;">{{ number_format($finap->total ?? 0, 0, ',', '.') ?: '-' }} </span></b></td>
                            </tr>
                        @endforeach
                    </table>
                    <br><br>
                    <table style="width:700;text-align:left;font-size:15px;">
                        <tr>
                            <td style="width:100;">Terbilang </td>
                            <td style="width:5;">:</td>
                            <td style="width:500;"> <i>{{ $finap->terbilang }}</i></td>
                        </tr>
                    </table>
                    <table style="width:400px;text-align:left;border: 3px solid black;margin-right:300px;font-size:15px;font-weight:bold;">
                        <tr>
                            <td style="width:120;">Ket </td>
                            <td style="width:5;"></td>
                            <td style="width:300;">{{ $finap->ket }}</td>
                        </tr>
                        <tr>
                            <td style="width:120;"><i>Atas nama </i></td>
                            <td style="width:5;">:</td>
                            <td style="width:300;text-transform: uppercase;">{{ $finap->a_nama }}</td>
                        </tr>
                        <tr>
                            <td style="width:120;"><i>Bank </i></td>
                            <td style="width:5;">:</td>
                            <td style="width:300;">{{ $finap->bank }}</td>
                        </tr>
                        <tr>
                            <td style="width:120;"><i>No Rek </i></td>
                            <td style="width:5;">:</td>
                            <td style="width:300;">{{ $finap->norek }}</td>
                        </tr>
                    </table>
                    <br><br>
                    <table style="width:700px;font-size:15px;">
                        <tr>
                            <td style="width:350px;">Dibuat</td>
                            <td style="width:250px;">Diperiksa</td>
                            <td style="width:150px;">Disetujui</td>
                        </tr>
                        <tr style="border-bottom:1px solid black;">
                            <td ><br><br><br><br><br></td>
                        </tr>
                        <tr>
                            <td ><br></td>
                        </tr>
                        <tr>
                            <td >Catatan :</td>
                        </tr>
                    </table>



                    @if ($finap->approve == '1')
                        <table width="600" style="font-weight:bold;">
                            <tr>
                                <td><img style="height:125px; weigth:125px;padding-left:15px;"
                                        src="{{ asset('img/qrcodes/' . $finap->qr) }}" alt="QR Code"></td>
                            </tr>
                        </table>
                    @else
                        <br><br><br><br>
                    @endif

                    <table width="600" style="font-weight:bold;">
                        <tr>
                            <td><u>{{ $finap->ttd }}</u></td>
                        </tr>
                        <tr>
                            <td>{{ $finap->jabatan }}</td>
                        </tr>
                    </table>

                    {{-- </center> --}}
                </div>
                @if ($finap->kop !== null)
                    <div class="footer-page">
                        <img src="{{ asset('img/GEL-bottom-kop.png') }}"
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
