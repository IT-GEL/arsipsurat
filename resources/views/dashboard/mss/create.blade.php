@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Buat Surat Keterangan Marketing Sales Shipping</h6>
                    <form method="post" action="/dashboard/mss" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" id="approve" name="approve" value="0">

                        <div class="mb-3">
                            <label for="kop" class="form-label">Pilih Kop Surat PT </label>
                            <select class="form-select @error('kop') is-invalid @enderror" id="kop" name="kop"
                                autofocus>
                                <option value="" selected>Tanpa Kop</option>
                                <option value="GEL">GEL</option>
                                <option value="QIN">QIN</option>
                                <option value="ERA">ERA</option>
                                <option value="GCR">GCR</option>
                            </select>
                            @error('kop')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idPerihal" class="form-label">Perihal Surat</label>
                            <select class="form-select @error('idPerihal') is-invalid @enderror" id="idPerihal"
                                name="idPerihal" required autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Surat</option>
                                <option value="1">Full Corporate Offer</option>
                                <option value="2">Surat Izin Masuk Tambang</option>
                                <option value="3">Berita Acara</option>
                                <option value="4">Tanda Terima</option>
                                <option value="5">Permohonan Revisi Invoice dan Pembatalan FP GEL</option>
                                <option value="6">Letter of Intent</option>
                            </select>
                            <input type="hidden" id="perihal" name="perihal" value="{{ old('perihal') }}">
                            @error('idPerihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="perihalBAClass" style="display: none;">
                            <label for="perihalBA" class="form-label">Perihal Berita Acara</label>
                            <select class="form-select @error('perihalBA') is-invalid @enderror" id="perihalBA"
                                name="perihalBA">
                                <option value="" disabled selected>Pilih Berita Acara</option>
                                <option value="Surveyor">Berita Acara Surveyor</option>
                                <option value="Pembatalan PVR">Berita Acara Pembatalan PVR</option>
                                <option value="Keterlambatan Pengajuan PVR">Berita Acara Keterlambatan Pengajuan PVR
                                </option>
                                <option value="Kegiatan Cleaning Batubara">Berita Acara Kegiatan Cleaning Batubara</option>
                            </select>
                            @error('perihalBA')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat</label>
                            <input type="hidden" class="form-control @error('noSurat') is-invalid @enderror" id="noSurat"
                                name="noSurat" placeholder="Urutan Nomor Surat Terbaru" required
                                value="{{ old('noSurat') }}">
                            <br>
                            <input type="text" class="form-control" id="prefix" name="prefix" readonly>
                            @error('noSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div id="surat-izin" class="mb-3" style="display: none;">
                            <label for="ptkunjungan" class="form-label">PT yang akan Mengunjungi Tambang </label>
                            <input type="text" class="form-control @error('ptkunjungan') is-invalid @enderror"
                                placeholder="Isi PT Kunjungan..." id="ptkunjungan" name="ptkunjungan"
                                value="{{ old('ptkunjungan') }}">
                            @error('ptkunjungan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="pttujuanClass" class="mb-3">
                            <label for="pttujuan" class="form-label">PT yang akan di Kunjungi</label>
                            <input type="text" class="form-control @error('pttujuan') is-invalid @enderror"
                                placeholder="Isi PT Tujuan..." id="pttujuan" name="pttujuan" value="">
                            @error('pttujuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <script>
                            // Function to update PT Tujuan based on selected Perihal Surat
                            function updatePTTujuan() {
                                const perihalSelect = document.getElementById('idPerihal');
                                const pttujuanInput = document.getElementById('pttujuan');

                                if (perihalSelect.value === '6') {
                                    pttujuanInput.value = 'PT BUKIT ASAM tbk';
                                } else {
                                    pttujuanInput.value = ''; // Clear the input if other options are selected
                                }
                            }

                            // Add event listener for change event on page load
                            document.addEventListener('DOMContentLoaded', () => {
                                const perihalSelect = document.getElementById('idPerihal');
                                perihalSelect.addEventListener('change', updatePTTujuan);
                            });
                        </script>

                        <div id="alamatClass"class="mb-3">
                            <label for="alamat" class="form-label">Alamat PT Tujuan</label>
                            <trix-editor class="form-control @error('alamat') is-invalid @enderror" input="alamat"
                                value="{{ old('alamat') }}" placeholder="Alamat PT Tujuan"></trix-editor>

                            <input type="hidden" id="alamat" name="alamat" value="{{ old('alamat') }}">

                            <script>
                                document.addEventListener('trix-change', function(event) {
                                    const editor = event.target;
                                    const hiddenInput = document.getElementById('alamat');
                                    hiddenInput.value = editor.editor.getDocument()
                                        .toString(); // Update the hidden input with the editor's content
                                });

                                // Function to set the Trix editor value based on the select value
                                function updateTrixValue() {
                                    const perihalSelect = document.getElementById('idPerihal');
                                    const editor = document.querySelector("trix-editor");

                                    if (perihalSelect.value === '6') {
                                        const newValue = `Jl. H.R. Rasuna Said No. 15\nJakarta Selatan`;
                                        editor.editor.loadHTML(newValue); // Set the new value in the Trix editor
                                    } else {
                                        editor.editor.loadHTML(''); // Clear or set another value for other selections
                                    }
                                }

                                // Add event listener to the select element
                                document.getElementById('idPerihal').addEventListener('change', updateTrixValue);
                            </script>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="attclass" class="mb-3" style="display: none;">
                            <label for="att" class="form-label">Ditujukan Kepada</label>
                            <input type="text" class="form-control @error('att') is-invalid @enderror"
                                placeholder="Ditujukan Kepada..." id="att" name="att">
                            @error('att')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <script>
                            function updateATT() {
                                const perihalSelect = document.getElementById('idPerihal');
                                const ATTInput = document.getElementById('att');

                                console.log('Selected value:', perihalSelect.value); // Debug log

                                if (perihalSelect.value === '6') {
                                    ATTInput.value = 'Bapak Rafli Yandra';
                                } else {
                                    ATTInput.value = ''; // Clear the input if other options are selected
                                }
                            }

                            // Add event listener for change event on page load
                            document.addEventListener('DOMContentLoaded', () => {
                                const perihalSelect = document.getElementById('idPerihal');
                                perihalSelect.addEventListener('change', updateATT);
                            });
                        </script>

                        <div id="keterangan-field" class="mb-3" style="display: none;">
                            <label for="keterangan" class="form-label">Isi Surat / Keterangan</label>
                            <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">

                        </textarea>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const keterangan = Jodit.make('#keterangan');
                                    new DragAndDrop(keterangan);
                                    const perihalSelect = document.getElementById('idPerihal');
                                    const perihalBA = document.getElementById('perihalBA');



                                    function updateKeterangan() {
                                        if (perihalSelect.value === '6') {
                                            keterangan.value =
                                                "<p>Dear Sir,</p><br><p>We, GLOBAL COAL RESOURCES Pte, Ltd., hereby state that we are in a position of an LOI and ready, willing and request for a long term contract of One – Year to purchase of coal as terms that mentioned below:</p>";
                                        } else if (perihalBA.value === 'Surveyor') {
                                            keterangan.value =
                                                `<p style="text-align: justify;">Sesuai arahandari Bapak Dypo untuk COA TB Kasih Power 2000-1/BG Rimau 3016 dengan quantity
                                                     8.451,191 MT dengan tujuan Jetty Senamas, Kalteng-Jetty Gresik bahwa COA tersebut
                                                    dipakai untuk dua surveyor, yaitu PT Asiatrust Technovima Qualiti dan PT
                                                    Calmaint Global Riset.</p>
                                                    <br style="text-align: justify;">
                                                    <p style="text-align: justify;">Demikian
                                                    berita acara ini dibuat dengan sebenarnya sebagai dokumen pendukung untuk permintaan pengajuan PVR di
                                                    bagian finance. Atas perhatian dan kerjasamanya, kami ucapkan
                                                    terimakasih.</p>`;
                                        } else if (perihalBA.value === 'Pembatalan PVR') {
                                            keterangan.value =
                                                `
                                            <p style="text-align: justify;">Pada hari ini
                                                <strong>Kamis</strong> tanggal <strong>Duapuluh Lima</strong>
                                                bulan Januari tahun <strong>Dua Ribu Dua Puluh Empat&nbsp;</strong>
                                                telah diajukan permohonan pembatalan PVR Sales PT Global Energi Lestari PVR No. 0268/PVR/LE/10/2023 dengan invoice No. 01/INV/X/RUJ/-GEL/50%/2023 tanggal 30 Oktober 2023 yang telah diajukan pada tanggal 30 Oktober 2023 dibatalkan dengan alasan shipment batal bahwa pengajuan tersebut ditagihkan ke PT Recalay Usaha Jaya.</p>
                                            <p style="text-align: justify;">Berikut ini Table List Permintaan Pembatalan PVR Sales :&nbsp;</p>
                                            <br><br>
                                            <p style="text-align: justify;">Demikian berita acara ini dibuat dengan sebenarnya sebagai dokumen pendukung untuk permintaan pengajuan PVR di bagian finance. Atas perhatian dan kerjasamanya, kami ucapkan terimakasih..</p>
                                            `


                                        } else if (perihalBA.value === 'Kegiatan Cleaning Batubara') {
                                            keterangan.value =
                                                `<p style="text-align: justify;">Pada hari Rabu Tanggal 31 Bulan Juli 2024 adanya kwitansi penagihan atas biaya cleaning blok dan Operator Abby [GEL-113-2024] TB. NELLY 63 BG. NELLY 110 at Pod : PLTU Suralaya. Commenced discharge tanggal 28/7/24 jam 20.55 lt Total cargo terbongkar 9.295,606 mt. Harga mengalami perubahan dikarenakam Batubara berukuran besar-besar sehingga menyulitkan proses cleaning. Dalam proses pembongkoran tersebut dilakukan perngawasan oleh Rubby H Hutagalung agar proses bongkar berjalan dengan lancar.
                                                    <br><br>
                                                    <strong>Atas Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : Rubby H Hutagalung
                                                        <br>Nomor Rekening&nbsp; &nbsp; &nbsp; &nbsp; : 539301013438539
                                                        <br>Bank&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: BRI</strong>
                                                </p>
                                                <p><br></p>
                                                <p style="text-align: justify;">Demikian berita acara ini dibuat agar dapat digunakan sebagaimana mestinya. Terimakasih&nbsp;</p>`;
                                        } else {
                                            keterangan.value = ""; // Reset or set other values based on different selections
                                        }
                                    }

                                    // Initial check
                                    updateKeterangan();

                                    // Update keterangan when the dropdown value changes
                                    perihalSelect.addEventListener('change', updateKeterangan);
                                    perihalBA.addEventListener('change', updateKeterangan);
                                });
                            </script>
                        </div>

                        <div id="surat-fco">
                            <div class="fco-field mb-3" style="display: none;" id="commodity">
                                <label for="commodity" class="form-label">Commodity</label>
                                <input type="text" class="form-control @error('commodity') is-invalid @enderror"
                                    placeholder="Commodity..." id="commodity" name="commodity"
                                    value="{{ old('commodity') }}">
                                @error('commodity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="source" class="form-label">Source</label>
                                <input type="text" class="form-control @error('source') is-invalid @enderror"
                                    placeholder="Source..." id="source" name="source" value="{{ old('source') }}">
                                @error('source')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;" id="country">
                                <label for="country" class="form-label">Country of Origin</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror"
                                    placeholder="Country..." id="country" name="country"
                                    value="{{ old('country') }}">
                                @error('country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;" id="spec">
                                <label for="spec" class="form-label">
                                    Typical Specification
                                </label>
                                <input type="text" class="form-control @error('spec') is-invalid @enderror"
                                    placeholder="Specification..." id="spec" name="spec"
                                    value="{{ old('spec') }}">
                                @error('spec')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="vo" class="form-label">Validity Offer</label>
                                <input type="date" class="form-control @error('vo') is-invalid @enderror"
                                    id="vo" name="vo" value="{{ old('vo') }}">
                                @error('vo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;" id="qty">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="number" class="form-control @error('qty') is-invalid @enderror"
                                    placeholder="Quantity..." id="qty" name="qty"
                                    value="{{ old('qty') }}">
                                @error('qty')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="loi-field mb-3" style="display: none;" id="delivery_basis">
                                <label for="delivery_basis" class="form-label">Delivery Basis</label>
                                <input type="text" class="form-control @error('delivery_basis') is-invalid @enderror"
                                    placeholder="Delivery Basis..." id="delivery_basis" name="delivery_basis"
                                    value="{{ old('delivery_basis') }}">
                                @error('delivery_basis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="loi-field mb-3" style="display: none;" id="contract_dur">
                                <label for="contract_dur" class="form-label">Contract Duration</label>
                                <input type="text" class="form-control @error('contract_dur') is-invalid @enderror"
                                    placeholder="Contract Duration..." id="contract_dur" name="contract_dur"
                                    value="{{ old('contract_dur') }}">
                                @error('contract_dur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="loi-field mb-3" style="display: none;" id="po">
                                <label for="po" class="form-label">Price Offered</label>
                                <input type="text" class="form-control @error('po') is-invalid @enderror"
                                    placeholder="Price Offered..." id="po" name="po"
                                    value="{{ old('po') }}">
                                @error('po')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="lp" class="form-label">Loading Port</label>
                                <input type="text" class="form-control @error('lp') is-invalid @enderror"
                                    placeholder="Loading Port..." id="lp" name="lp"
                                    value="{{ old('lp') }}">
                                @error('lp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="dp" class="form-label">Destination Port</label>
                                <input type="text" class="form-control @error('dp') is-invalid @enderror"
                                    placeholder="Destination Port..." id="dp" name="dp"
                                    value="{{ old('dp') }}">
                                @error('dp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3">
                                <label for="matauang" class="form-label">Pilih Mata Uang Price Schemes</label>
                                <select class="form-select @error('matauang') is-invalid @enderror" id="matauang"
                                    name="matauang">
                                    <option value="" disabled selected>Pilih Mata Uang</option>
                                    <option value="IDR">Rupiah</option>
                                    <option value="DOLLAR">Dollar</option>
                                </select>
                            </div>

                            <div class="fco-field mb-3">
                                <label for="toggle" class="form-label">Price Schemes</label>
                                <br>
                                <button id="toggleCIF" class="toggle-button btn btn-primary">CIF</button>
                                <button id="toggleFOB" class="toggle-button btn btn-primary">FOB</button>
                                <button id="toggleFREIGHT" class="toggle-button btn btn-primary">Freight</button>
                            </div>


                            <div class="mb-3 price-scheme-fields" id="cifField" style="display: none;">
                                <label for="cif" class="form-label">Price Scheme (CIF)</label>
                                <input type="number" class="form-control" placeholder="CIF..." id="cif"
                                    name="cif">
                            </div>

                            <div class="mb-3 price-scheme-fields" id="fobField" style="display: none;">
                                <label for="fob" class="form-label">Price Scheme (FOB)</label>
                                <input type="number" class="form-control" placeholder="FOB..." id="fob"
                                    name="fob">
                            </div>

                            <div class="mb-3 price-scheme-fields" id="freightField" style="display: none;">
                                <label for="freight" class="form-label">Price Scheme (FREIGHT)</label>
                                <input type="number" class="form-control" placeholder="FREIGHT..." id="freight"
                                    name="freight">
                            </div>




                            <div class="fco-field mb-3" style="display: none;">
                                <label for="shipschedule" class="form-label">Shipping Schedule</label>
                                <input type="date" class="form-control @error('shipschedule') is-invalid @enderror"
                                    id="shipschedule" name="shipschedule" value="{{ old('shipschedule') }}">
                                @error('shipschedule')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="tcd" class="form-label">Term of Coal Delivery</label>
                                <input type="text" class="form-control @error('tcd') is-invalid @enderror"
                                    placeholder="Term of Coal Delivery..." id="tcd" name="tcd"
                                    value="{{ old('tcd') }}">
                                @error('tcd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="surveyor" class="form-label">Surveyor</label>
                                <input type="text" class="form-control @error('surveyor') is-invalid @enderror"
                                    placeholder="Surveyor..." id="surveyor" name="surveyor"
                                    value="{{ old('surveyor') }}">
                                @error('surveyor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="qas" class="form-label">Quality and Specification</label>
                                <textarea id="qas" name="qas" class="form-control @error('qas') is-invalid @enderror"></textarea>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const qas = Jodit.make('#qas');
                                        new DragAndDrop(qas);
                                        const perihalSelect = document.getElementById('idPerihal');

                                        function updateqas() {
                                            if (perihalSelect.value === '1') {
                                                qas.value =
                                                    `<table style="border-collapse:collapse;width: 100%;"><tbody>
                                                        <tr>
                                                            <td style="width: 25%;"><br></td>
                                                            <td style="width: 25%;"><br></td>
                                                            <td style="width: 25%;"><br></td>
                                                            <td style="width: 25%;"><br></td></tr>
                                                        <tr>
                                                            <td style="width: 25%;"><br></td>
                                                            <td style="width: 25%;"><br></td>
                                                            <td style="width: 25%;"><br></td>
                                                            <td style="width: 25%;"><br></td></tr>
                                                        <tr>
                                                            <td style="width: 25%;"><br></td>
                                                            <td style="width: 25%;"><br></td>
                                                            <td style="width: 25%;"><br></td>
                                                            <td style="width: 25%;"><br></td></tr></tbody>
                                                    </table>`;
                                            } else {
                                                qas.value = ""; // Reset or set other values based on different selections
                                            }
                                        }

                                        // Initial check
                                        updateqas();

                                        // Update keterangan when the dropdown value changes
                                        perihalSelect.addEventListener('change', updateqas);
                                    });
                                </script>
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="top" class="form-label">Term of Payment</label>
                                <input type="text" class="form-control @error('top') is-invalid @enderror"
                                    placeholder="Term of Payment..." id="top" name="top"
                                    value="{{ old('top') }} ">
                                <div class="invalid-feedback">
                                    @error('top')
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="mb-3 mt-3">
                            <label for="tglSurat" class="form-label">Tanggal Surat</label>
                            <input type="date" class="form-control @error('tglSurat') is-invalid @enderror"
                                id="tglSurat" name="tglSurat" required value="{{ old('tglSurat') }}">
                            @error('tglSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var today = new Date().toISOString().split('T')[0];
                                document.getElementById('tglSurat').value = today;
                            });
                        </script>

                        <div class="mb-3">
                            <label for="ttd" class="form-label">TTD Yang Membuat</label>
                            <input type="text" class="form-control @error('ttd') is-invalid @enderror" id="ttd"
                                name="ttd" required value="{{ old('ttd') }}">
                            @error('ttd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="namaTtd" class="form-label">Mengetahui</label>
                            <input type="text" class="form-control @error('namaTtd') is-invalid @enderror"
                                id="namaTtd" name="namaTtd" required value="{{ old('namaTtd') }}">
                            @error('namaTtd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <script>
                            function updatenamaTTD() {
                                const BAPerihal = document.getElementById('perihalBA');
                                const namaTTDinput = document.getElementById('namaTtd');

                                console.log('Selected value:', BAPerihal.value); // Debug log

                                if (BAPerihal.value === 'Surveyor') {
                                    namaTTDinput.value = 'Dypo Fitramadhan';
                                } else {
                                    namaTTDinput.value = ''; // Clear the input if other options are selected
                                }
                            }

                            // Add event listener for change event on page load
                            document.addEventListener('DOMContentLoaded', () => {
                                const BAPerihal = document.getElementById('perihalBA');
                                BAPerihal.addEventListener('change', updatenamaTTD);
                            });
                        </script>


                        <div class="mb-3">
                            <label for="lampiran" class="form-label">Upload Lampiran (Optional)</label>
                            <input type="file" class="form-control @error('lampiran') is-invalid @enderror"
                                id="lampiran" name="lampiran" multiple>
                            @error('lampiran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Buat Surat</button>

                    </form>
                </div>
            </div>
        </div>
        <script>
            class DragAndDrop {
                constructor(jodit) {
                    this.jodit = jodit;
                    this.init();
                }

                init() {
                    const editorArea = this.jodit.container;

                    editorArea.addEventListener('dragover', (event) => {
                        event.preventDefault();
                        editorArea.classList.add('drag-over');
                    });

                    editorArea.addEventListener('dragleave', () => {
                        editorArea.classList.remove('drag-over');
                    });

                    editorArea.addEventListener('drop', (event) => {
                        event.preventDefault();
                        editorArea.classList.remove('drag-over');

                        const files = event.dataTransfer.files;
                        if (files.length > 0) {
                            for (const file of files) {
                                if (file.type.startsWith('image/')) {
                                    this.handleImageUpload(file);
                                }
                            }
                        }
                    });
                }

                handleImageUpload(file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = `<img src="${e.target.result}" alt="Uploaded Image" style="max-width: 100%;" />`;
                        this.jodit.selection.insertHTML(img);
                    };
                    reader.readAsDataURL(file);
                }
            }
            document.addEventListener('DOMContentLoaded', function() {
                const perihalSelect = document.getElementById('idPerihal');
                const noSuratInput = document.getElementById('noSurat');
                const suratizinGroup = document.getElementById('surat-izin');
                const keteranganField = document.getElementById('keterangan-field');
                const ket = document.getElementById('keterangan');
                const pttujuanClass = document.getElementById('pttujuanClass');
                const attclass = document.getElementById('attclass');
                const alamatClass = document.getElementById('alamatClass');
                const suratfcoGroups = document.querySelectorAll('#surat-fco .fco-field');
                const prefixInput = document.getElementById('prefix');
                const tglSuratInput = document.getElementById('tglSurat');
                const BAClass = document.getElementById('perihalBAClass');
                const suratLOIGroups = document.querySelectorAll('#surat-fco .loi-field');

                const maxValues = {
                    '1': {{ $maxNoSuratFCO }},
                    '2': {{ $maxNoSuratSI }},
                    '3': {{ $maxNoSuratBA }},
                    '4': {{ $maxNoSuratTT }},
                    '5': {{ $maxNoSuratRIPFP }},
                    '6': {{ $maxNoSuratLOI }},
                };

                const PADDING_LENGTH = 3;

                const visibilityMap = {
                    '1': () => {
                        showFields(suratfcoGroups);
                        showFields([pttujuanClass, alamatClass]);
                    },
                    '2': () => {
                        showFields([suratizinGroup, keteranganField, pttujuanClass, alamatClass]);
                    },
                    '3': () => {
                        showFields([keteranganField, BAClass]);
                    },
                    '4': () => showFields([keteranganField]),
                    '5': () => showFields([keteranganField]),
                    '6': () => {
                        showFields([
                            ...suratLOIGroups,
                            pttujuanClass,
                            alamatClass,
                            attclass,
                            keteranganField,
                            document.getElementById('commodity'),
                            document.getElementById('qty'),
                            document.getElementById('country'),
                            document.getElementById('spec')
                        ]);
                    }
                };

                function showFields(elements) {
                    elements.forEach(el => {
                        if (el instanceof HTMLElement) {
                            el.style.display = 'block';
                        } else if (typeof el === 'string') {
                            const element = document.getElementById(el);
                            if (element) {
                                element.style.display = 'block';
                            } else {
                                console.warn(`Element with ID '${el}' not found.`);
                            }
                        }
                    });
                }

                function hideFields(elements) {
                    elements.forEach(el => {
                        if (el instanceof HTMLElement) {
                            el.style.display = 'none';
                        } else if (typeof el === 'string') {
                            const element = document.getElementById(el);
                            if (element) {
                                element.style.display = 'none';
                            }
                        }
                    });
                }

                function hideAllFields() {
                    hideFields([suratizinGroup, keteranganField, pttujuanClass, alamatClass, BAClass, attclass]);
                    suratfcoGroups.forEach(group => {
                        if (group) group.style.display = 'none';
                    });
                }

                function setInitialNoSurat() {
                    const currentType = perihalSelect.value;
                    noSuratInput.value = (maxValues[currentType] || 0) + 1;
                }

                function updateVisibleFields() {
                    hideAllFields();
                    visibilityMap[perihalSelect.value]?.();
                }

                function toggleField(fieldId) {
                    const field = document.getElementById(fieldId + 'Field');
                    if (field) {
                        field.style.display = field.style.display === 'block' ? 'none' : 'block';
                    }
                }

                ['CIF', 'FOB', 'FREIGHT'].forEach(type => {
                    document.getElementById('toggle' + type).addEventListener('click', () => toggleField(type
                        .toLowerCase()));
                });

                perihalSelect.addEventListener('change', function() {
                    const selectedValue = this.value;
                    const perihalInput = document.getElementById('perihal');

                    const perihalMap = {
                        '1': 'Full Corporate Offer',
                        '2': 'Surat Izin Masuk Tambang',
                        '3': 'Berita Acara',
                        '4': 'Tanda Terima',
                        '5': 'Permohonan Revisi Invoice dan Pembatalan FP GEL',
                        '6': 'Letter of Intent (LOI) for Coal Purchase in'
                    };
                    perihalInput.value = perihalMap[selectedValue] || '';
                    handleFieldUpdates();
                });

                function updatePrefix() {
                    const noSurat = String(noSuratInput.value || '0').padStart(PADDING_LENGTH, '0');
                    const tglSurat = new Date(tglSuratInput.value);
                    const romanMonth = toRoman(tglSurat.getMonth() + 1);
                    const year = tglSurat.getFullYear();
                    const kop = document.getElementById('kop').value;

                    const perihal = perihalSelect.value;
                    const perihalBA = document.getElementById('perihalBA').value;

                    const prefixMap = {
                        '1': `Ref. No:MSS/${kop}/FCO-${noSurat}/${romanMonth}/${year}`,
                        '2': `Ref. No:MSS/${kop}/BA-${noSurat}/${romanMonth}/${year}`,
                        '3': `BA-${noSurat}/INV-SALES/${romanMonth}/${year}`,
                        '4': `Tanda Terima-${noSurat}/${romanMonth}/${year}`,
                        '5': `${year}/${kop}-PLN/SAL-${noSurat}`,
                        '6': `No: MSS/${kop}/LOI-${noSurat}/${romanMonth}/${year}`
                    };

                    // Add the new condition for specific case
                    if (perihal === '3' && perihalBA === 'Kegiatan Cleaning Batubara') {
                        prefixInput.value = `No:BA-${noSurat}/INV-SALES/${romanMonth}/${year}`;
                    } else {
                        prefixInput.value = prefixMap[perihal] || '';
                    }
                }

                function toRoman(num) {
                    const roman = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
                    return roman[num - 1] || '';
                }

                function handleFieldUpdates() {
                    setInitialNoSurat();
                    updateVisibleFields();
                    updatePrefix();

                }

                [perihalBA, perihalSelect, tglSuratInput, noSuratInput].forEach(element => {
                    element.addEventListener('change', handleFieldUpdates);
                });

                // Initialize
                handleFieldUpdates();
            });
        </script>
    @endsection
