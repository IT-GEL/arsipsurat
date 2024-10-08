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

    @if ($prc->idPerihal == '1')
        <!-- Surat Keagenan -->
        <!-- Recent Sales Start -->

        <div class="d-flex align-items-center justify-content-between mb-4 pt-4 px-4">
            <a id="backBtn" href="/dashboard/prc" class="btn btn-success"><i class="bi bi-arrow-left-square"></i>
                Kembali</a>
            {{-- <a href="/dashboard/prc/{{ $prc->id }}/cetak" class="btn btn-secondary" target="_blank"><i
                    class="bi bi-printer"></i> Cetak</a> --}}
            <div>
                <a href="/dashboard/prc/{{ $prc->id }}/cetak" id="download-pdf" class="btn btn-secondary"
                    target="_blank"><i class="bi bi-printer"></i> Cetak</a>
                <a class="btn btn-primary" href="{{ url('/dashboard/prc/' . $prc->id . '/edit') }}"><i
                        class="bi bi-pencil-square"></i>Edit</a>
                @if (auth()->user()->name == 'Ervina Wijaya')
                    <form action="{{ route('prc.approve', $prc->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('put')
                        <input type="hidden" name="approve" value="yes">

                        <button class="btn {{ $prc->approve ? 'btn-success' : 'btn-secondary' }}"
                            data-approved="{{ $prc->approve }}"
                            onclick="{{ $prc->approve ? 'return false;' : 'berhasil(this);' }}"
                            {{ $prc->approve ? 'disabled' : '' }}>
                            <i class="bi bi-check2-square"></i>Approve{{ $prc->approve ? 'd' : '' }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
        <div id="contentToConvert" class="contentToConvert">
            <div class="page">
                <div class="header" id="header">
                    <img src="{{ asset('img/' . $prc->kop . '-kop-atas.png') }}" style="max-width: 100%; height: auto;">
                    <br><br>
                </div>
                <div class="header-content">
                    {{-- <center style="margin-top: 50px;"> --}}


                        <br><br><br>
                        <b><u>{{ $prc->perihal }}</u></b>
                        <br>
                    <div>
                        <table style="border-collapse: collapse; width: 600; font-size:12px;">
                            <tr>
                                <td style="text-align: left; width: 15%;">Date</td>
                                <td style="text-align: left; padding-right: 5;">:</td>
                                <td style="text-align: left; width: 55%;">{{ $prc->tglSurat }}</td>

                                <td style="text-align: left; width: 15%;">PO No</td>
                                <td style="text-align: left; padding-right: 5;">:</td>
                                <td style="text-align: left; width: 40%;">{{ $prc->preifx }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: left; width: 15%;">Vendor</td>
                                <td style="text-align: left; padding-right: 5;">:</td>
                                <td style="text-align: left; width: 40%;">{{ $prc->vendor }}</td>

                                <td style="text-align: left; width: 15%;">PR No</td>
                                <td style="text-align: left; padding-right: 5;">:</td>
                                <td style="text-align: left; width: 40%;">{{ $prc->preifxPR }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: left; width: 15%;">Fax No.</td>
                                <td style="text-align: left; padding-right: 5;">:</td>
                                <td style="text-align: left; width: 40%;">{{ $prc->fax_no }}</td>

                                <td style="text-align: left; width: 15%;">Quote Reff</td>
                                <td style="text-align: left; padding-right: 5;">:</td>
                                <td style="text-align: left; width: 40%;">{{ $prc->preifxQuote }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: left; width: 15%;">Att.</td>
                                <td style="text-align: left; padding-right: 5;">:</td>
                                <td style="text-align: left; width: 40%;">{{ $prc->att }}</td>

                                <td style="text-align: left; width: 15%;">Term of Payment</td>
                                <td style="text-align: left; padding-right: 5;">:</td>
                                <td style="text-align: left; width: 40%;">{{ $prc->top }}</td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="thead">
                        <table style="border-collapse: collapse; width: 100%; font-size:12px;">
                            <tr>
                                <td style="border: 1px solid black; padding: 4px;">No</td>
                                <td style="border: 1px solid black; padding: 4px;">DESCRIPTION</td>
                                <td style="border: 1px solid black; padding: 4px;">PART NUMBER</td>
                                <td style="border: 1px solid black; padding: 4px;">QTY</td>
                                <td style="border: 1px solid black; padding: 4px;">UNIT</td>
                                <td style="border: 1px solid black; padding: 4px;">UNIT PRICE</td>
                                <td style="border: 1px solid black; padding: 4px;">AMOUNT</td>
                                <td style="border: 1px solid black; padding: 4px;">SUPPLY (ETA)</td>
                            </tr>
                        </table>
                    </div>


                    <div class="tbody">
                        <table style="border-collapse: collapse; width: 100%; font-size:12px;">
                            @foreach ($items as $id => $item)
                            <tr>

                                <td style="border: 1px solid black; padding: 4px;">{{ $id }}</td>
                                <td style="border: 1px solid black; padding: 4px;">{{ $item['deskripsi'] }}</td>
                                <td style="border: 1px solid black; padding: 4px;">PART NUMBER</td>
                                <td style="border: 1px solid black; padding: 4px;">{{ $item['qty'] }}</td>
                                <td style="border: 1px solid black; padding: 4px;">{{ $item['satuan'] }}</td>
                                <td style="border: 1px solid black; padding: 4px;">{{ $item['harga'] }}</td>
                                <td style="border: 1px solid black; padding: 4px;">{{ $item['total'] }}</td>
                                <td style="border: 1px solid black; padding: 4px;">SUPPLY (ETA)</td>

                            </tr>
                            @endforeach
                        </table>
                    </div>


                    <div class="terbilang">
                    <table style="border-collapse: collapse; width: 100%;font-weight:bold; font-size:12px;">
                        <tr style="border: 1px solid black; padding: 4px; ">
                            <td style="border: 1px solid black; padding: 4px;" colspan="5" rowspan="5">
                                <i><u>Terbilang :</u> Satu Juta Tiga Ratus Delapan Puluh Tujuh Ribu Lima Ratus Rupiah</i>
                            </td>
                            <td style="border: 1px solid black; padding: 4px;">Sub-Total</td>
                            <td style="border: 1px solid black; padding: 4px;"></td>
                            <td style="border: 1px solid black; padding: 4px;"></td>
                        </tr>
                        <tr style="border: 1px solid black; padding: 4px;" >
                            <td style="border: 1px solid black; padding: 15px;"></td>
                            <td style="border: 1px solid black; padding: 15px;"></td>
                            <td style="border: 1px solid black; padding: 15px;"></td>
                        </tr>
                        <tr style="border: 1px solid black; padding: 4px;">

                            <td style="border: 1px solid black; padding: 4px;">NETTO</td>
                            <td style="border: 1px solid black; padding: 4px;">TEST</td>
                            <td style="border: 1px solid black; padding: 4px;"></td>
                        </tr>
                        <tr style="border: 1px solid black; padding: 4px;">

                            <td style="border: 1px solid black; padding: 4px;">PPN 11%</td>
                            <td style="border: 1px solid black; padding: 4px;">TEST</td>
                            <td style="border: 1px solid black; padding: 4px;"></td>
                        </tr>
                        <tr style="border: 1px solid black; padding: 4px;">
                            <td style="border: 1px solid black; padding: 4px;">GRAND TOTAL</td>
                            <td style="border: 1px solid black; padding: 4px;">TEST</td>
                            <td style="border: 1px solid black; padding: 4px;"></td>
                        </tr>

                        <tr style=" padding: 4px;">
                            <td style="padding: 4px;" colspan="4"><u>Delivery Date :</u></td>
                            <td style="padding: 4px; text-align:right;"><u>Delivery To :</u></td>
                            <td style="padding: 4px; text-transform: uppercase;" colspan="3">PT Tempirai Energy</td>




                        </tr>
                        <tr style="padding: 4px;">
                            <td style="padding: 4px; text-transform: uppercase;" colspan="5"><i># FOR KALIBRASI ALAT TS SOUTH TYPE NTS-352L</i></td>
                            <td style="padding: 4px; font-weight:normal;" colspan="3">Gedung Artha Graha</td>


                        </tr>
                        <tr style=" padding: 4px;">
                            <td style=" padding: 4px; text-transform: uppercase;" colspan="5"><i># HARGA FRANCO SITE MADHUCON</i></td>
                            <td style=" padding: 4px; font-weight:normal;" colspan="3">Jl Jendral Sudirman</td>



                        </tr>
                    </table>
                    </div>


                    {{-- </center> --}}
                </div>
                @if ($prc->kop !== null)
                    <div class="footer-page">
                        <img src="{{ asset('img/' . $prc->kop . '-bottom-kop.png') }}"
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
