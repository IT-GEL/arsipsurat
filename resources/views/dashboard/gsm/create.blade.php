@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 mx-auto p-4" style="width: 210mm;">
                    <h6 class="mb-4">Buat Surat Keterangan Marketing Sales Shipping</h6>
                    <form method="post" action="/dashboard/gsm">
                        @csrf

                        <input type="hidden" id="approve" name="approve" value="0">

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

                        <input type="hidden" value="GSM" id="kop" name="kop">


                        <div class="mb-3">
                            <label for="idPerihal" class="form-label">Perihal Surat</label>
                            <select class="form-select @error('idPerihal') is-invalid @enderror" id="idPerihal"
                                name="idPerihal" required autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Surat</option>
                                <option value="1">Surat Penunjukan Keagenan</option>
                                <option value="2">Berita Acara</option>
                            </select>
                            <input type="hidden" id="perihal" name="perihal" value="{{ old('perihal') }}">
                            @error('idPerihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div id="keterangan-field" class="mb-3">
                            <label for="keterangan" class="form-label">Isi Surat / Keterangan</label>
                            <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">

                        </textarea>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const keterangan = Jodit.make('#keterangan');
                                    new DragAndDrop(keterangan);
                                    const perihalSelect = document.getElementById('idPerihal');

                                    function updateKeterangan() {
                                        if (perihalSelect.value === '1') {
                                            keterangan.value =
                                                `<table style="border-collapse:collapse;width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 25%;">To : PT SAMUDERA INDAH BERSAMA</td>
                                                            <td style="width: 25%;">From : PT. GLOBAL SINERGI MARITIM</td>

                                                        </tr>
                                                        <tr>
                                                            <td style="width: 25%;">PIC : Pak Devi - 0813 7907 0146<br>Email : samuderaindahbersamashipping@gmail.com</td>
                                                            <td style="width: 25%;">PIC : Lestari - 0813 9283 2325<br><br>Email : g.sinergimaritim@gmail.com</td>

                                                        </tr>
                                                        <tr>
                                                            <td style="width: 25%;">Ditunjuk sebagai Agen Pelayaran</td>
                                                            <td style="width: 25%;">04 Okotober 2024</td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p>VESSEL&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: TB. LL HELFRIT / BG. LL2714</p>
                                                <p>DESCRIPTION OF GOODS&nbsp; &nbsp; &nbsp;: BATU BARA</p>
                                                <p>TD RENGAT&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: 04 Oktober 2024</p>
                                                <p>ETA BANGKA&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : 08 Oktober 2024</p>
                                                <p>NO. NAHKODA&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : Ceny Sasuwuhe / 0821-5535-9901</p><br>
                                                <p>Demikianlah penunjukan ini kami buat agar dapat digunakan sebagaimana mestinya,
                                                    atas perhatian dan kerjasamanya diucapkan terimakasih.</p>`;
                                        } else {
                                            keterangan.value = ""; // Reset or set other values based on different selections
                                        }
                                    }

                                    // Initial check
                                    updateKeterangan();

                                    // Update keterangan when the dropdown value changes
                                    perihalSelect.addEventListener('change', updateKeterangan);

                                });
                            </script>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="tglSurat" class="form-label">Tempat, Tanggal Surat</label>
                            <table>
                                <tr>
                                    <td>
                                        <input type="tmpt" class="form-control @error('tmpt') is-invalid @enderror"
                                            id="tmpt" name="tmpt" required value="{{ old('tmpt') }}"
                                            placeholder="Tempat Buat Surat">
                                    </td>
                                    <td> , </td>
                                    <td>
                                        <input type="date" class="form-control @error('tglSurat') is-invalid @enderror"
                                            id="tglSurat" name="tglSurat" required value="{{ old('tglSurat') }}">
                                    </td>
                                </tr>
                            </table>

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
                            <label for="y_buat" class="form-label">Yang Membuat</label>
                            <input type="text" class="form-control @error('y_buat') is-invalid @enderror" id="y_buat"
                                name="y_buat" required value="{{ old('y_buat') }}">
                            @error('y_buat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3" id="approval-field" style="display: none;">
                            <label for="ttd" class="form-label">Approval</label>
                            <select class="form-select @error('ttd') is-invalid @enderror" id="ttd" name="ttd"
                                required autofocus>
                                <option value="" disabled selected>Yang akan approve...</option>
                                <option value="Capt. John Herley">Capt. John Herley</option>
                                <option value="Kendrick Winata">Kendrick Winata</option>
                            </select>
                            <input type="hidden" id="jabatan" name="jabatan" value="">
                            @error('ttd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


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
            document.addEventListener('DOMContentLoaded', async function() {
                const perihalSelect = document.getElementById('idPerihal');
                const noSuratInput = document.getElementById('noSurat');
                const suratizinGroup = document.getElementById('surat-izin');
                const keteranganField = document.getElementById('keterangan-field');
                const approvalField = document.getElementById('approval-field');
                const ket = document.getElementById('keterangan');
                const prefixInput = document.getElementById('prefix');
                const tglSuratInput = document.getElementById('tglSurat');
                const jabatanInput = document.getElementById('jabatan');
                const jabatanSelect = document.getElementById('ttd')

                const PADDING_LENGTH = 3;

                function showFields() {
                    // Hide fields by default
                    approvalField.style.display = 'none';

                    switch (perihalSelect.value) {
                        case '1':
                            // Show fields if value is 1
                            approvalField.style.display = 'block';
                            break;

                        case '2':
                            // Show fields if value is 1
                            break;
                        // You can add more cases here if needed
                        default:
                            // Default action can be empty or any other logic
                            break;
                    }
                }

                const maxValues = {
                    '1': {{ $maxNoSuratKeagenan }},
                };

                function setInitialNoSurat() {
                    const currentType = perihalSelect.value;
                    noSuratInput.value = (maxValues[currentType] || 0) + 1;
                }

                jabatanSelect.addEventListener('change', function() {
                    const jabatanInput = document.getElementById('jabatan');
                    switch (this.value) {
                        case 'Capt. John Herley':
                            jabatanInput.value = 'Manager Operasional';
                            console.log(jabatanInput.value);
                            break;
                        case 'Kendrick Winata':
                            jabatanInput.value = 'Direktur';
                            console.log(jabatanInput.value);
                            break;
                        default:
                            jabatanInput.value = '';
                    }
                })

                perihalSelect.addEventListener('change', function() {
                    const selectedValue = this.value;
                    const perihalInput = document.getElementById('perihal');

                    const perihalMap = {
                        '1': 'Surat Penunjukan Keagenan',
                        '2': 'Berita Acara',
                    };
                    perihalInput.value = perihalMap[selectedValue] || '';
                    handleFieldUpdates();
                });

                function updatePrefix() {
                    const noSurat = String(noSuratInput.value || '0').padStart(PADDING_LENGTH, '0');
                    const tglSurat = new Date(tglSuratInput.value);
                    const romanMonth = toRoman(tglSurat.getMonth() + 1);
                    const year = tglSurat.getFullYear();

                    const prefixMap = {
                        '1': `No: ${noSurat}/GSM/SPK/${romanMonth}/${year}`,
                        '2': `No: ${noSurat}/GSM/BA/${romanMonth}/${year}`,
                    };

                    prefixInput.value = prefixMap[perihalSelect.value] || '';
                }

                function toRoman(num) {
                    const roman = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
                    return roman[num - 1] || '';
                }

                function handleFieldUpdates() {
                    setInitialNoSurat();
                    updatePrefix();
                    showFields();

                }

                [perihalSelect, tglSuratInput, noSuratInput].forEach(element => {
                    element.addEventListener('change', handleFieldUpdates);
                });

                // Initialize
                handleFieldUpdates();
            });
        </script>
    @endsection
