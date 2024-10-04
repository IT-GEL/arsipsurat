@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
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

                        <div class="mb-3">
                            <label for="idPerihal" class="form-label">Perihal Surat</label>
                            <select class="form-select @error('idPerihal') is-invalid @enderror" id="idPerihal"
                                name="idPerihal" required autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Surat</option>
                                <option value="1">Surat Penunjukan Keagenan</option>
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
                                    const perihalBA = document.getElementById('perihalBA');



                                    function updateKeterangan() {
                                        if (perihalSelect.value === '1') {
                                            keterangan.value =
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
                                                    </table>
                                                    <br>
                                                    <p>Demikianlah penunjukan ini kami buat agar dapat digunakan sebagaimana mestinya,
                                                    atas perhatian dan kerjasamanya diucapkan terimakasih.</p>`
                                                    ;
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
                            <label for="ttd" class="form-label">Yang Membuat</label>
                            <input type="text" class="form-control @error('ttd') is-invalid @enderror" id="ttd"
                                name="ttd" required value="{{ old('ttd') }}">
                            @error('ttd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ttd" class="form-label">Approval</label>
                            <select class="form-select @error('ttd') is-invalid @enderror" id="ttd"
                                name="ttd" required autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Surat</option>
                                <option value="1">Surat Penunjukan Keagenan</option>
                            </select>
                            <input type="hidden" id="perihal" name="perihal" value="{{ old('perihal') }}">
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
            document.addEventListener('DOMContentLoaded', function() {
                const perihalSelect = document.getElementById('idPerihal');
                const noSuratInput = document.getElementById('noSurat');
                const suratizinGroup = document.getElementById('surat-izin');
                const keteranganField = document.getElementById('keterangan-field');
                const ket = document.getElementById('keterangan');
                const prefixInput = document.getElementById('prefix');
                const tglSuratInput = document.getElementById('tglSurat');

                const PADDING_LENGTH = 3;

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

                function setInitialNoSurat() {
                    const currentType = perihalSelect.value;
                    noSuratInput.value = (maxValues[currentType] || 0) + 1;
                }

                perihalSelect.addEventListener('change', function() {
                    const selectedValue = this.value;
                    const perihalInput = document.getElementById('perihal');

                    const perihalMap = {
                        '1': 'Surat Penunjukan Keagenan',
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
                        '1': `No:${noSurat}/GSM/SPK/${romanMonth}/${year}`,
                    };

                    prefixInput.value = prefixMap[perihalSelect.value] || '';
                }

                function toRoman(num) {
                    const roman = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
                    return roman[num - 1] || '';
                }

                function handleFieldUpdates() {
                    setInitialNoSurat();
                    updateVisibleFields();
                    updatePrefix();

                    if (perihalSelect.value === '6') {
                        ket.value = "<p>Dear Sir,</p>";
                    }

                }

                [perihalSelect, tglSuratInput, noSuratInput].forEach(element => {
                    element.addEventListener('change', handleFieldUpdates);
                });

                // Initialize
                handleFieldUpdates();
            });
        </script>
    @endsection
