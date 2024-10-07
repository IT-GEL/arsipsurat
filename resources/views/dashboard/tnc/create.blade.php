@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 mx-auto p-4" style="width: 210mm;">
                    <h6 class="mb-4">Buat Surat Keterangan Talent And Culture</h6>
                    <form method="post" action="/dashboard/tnc">
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
                                <option value="1">Internal Memo</option>
                                <option value="2">Cop Bank</option>
                                <option value="3">BPJS</option>
                                <option value="4">Surat Tugas</option>
                                <option value="5">Offering Letter</option>
                                <option value="6">Paklaring</option>
                            </select>
                            <input type="hidden" id="perihal" name="perihal" value="{{ old('perihal') }}">
                            @error('idPerihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kop" class="form-label">Pilih Kop Surat</label>
                            <select class="form-select @error('kop') is-invalid @enderror" id="kop"
                                name="kop" required autofocus>
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
                            <label for="jml_lampiran" class="form-label">Jumlah lampiran yang akan dilampirkan</label>
                            <input type="number" name="jml_lampiran" id="jml_lampiran" class="form-control @error('jml_lampiran') is-invalid @enderror">
                            @error('jml_lampiran')
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
                                                `<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: 48px;"><span>Dengan ini
                                                        kami menginformasikan adanya perubahan pengiriman bukti bayar yang semula
                                                        dikirimkan melalui Group Whatsapp masing-masing Departement menjadi via E-Mail,
                                                        dengan rincian sebagai berikut :</span></p>
                                                <p class="MsoListParagraphCxSpFirst" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span><span>1.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></span></span><span>E-mail PIC user masing-masing Department yang
                                                        akan digunakan (terlampir).</span></p>

                                                <p class="MsoListParagraphCxSpMiddle" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span><span>2.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></span></span><span>E-mail Vendor yang akan dikirimkan bukti
                                                        transfer harus sudah ada pada kolom “Email” PVR.</span></p>

                                                <p class="MsoListParagraphCxSpLast" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><span>Contoh Format :<span>&nbsp; </span></span></p>
                                                <p class="MsoListParagraphCxSpLast" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>
                                                <p class="MsoListParagraphCxSpLast" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>
                                                <p class="MsoListParagraph" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span><span>3.&nbsp;</span></span><span>Jika ada perubahan E-mail User wajib
                                                        menginfokan secara resmi ke tim Finance AP melalui email </span><a href="mailto:finjkt.adm01@gel.co.id" style="color: blue; text-decoration: underline;"><span>finjkt.adm01@gel.co.id</span></a></p>
                                                <p class="MsoListParagraph" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><br></p>
                                                <p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><span>Update skema pembayaran di atas <u>berlaku
                                                            efektif per tanggal 01 Mei 2024.</u></span></p>
                                                <p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: 48px;"><span>Demikian
                                                        internal memorandum ini kami buat agar dapat diimplementasikan sebagaimana
                                                        mestinya.</span></p>`;
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

                        <div class="mb-3">
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
                const ket = document.getElementById('keterangan');
                const prefixInput = document.getElementById('prefix');
                const tglSuratInput = document.getElementById('tglSurat');
                const jabatanInput = document.getElementById('jabatan');
                const jabatanSelect = document.getElementById('ttd')

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
                        '1': 'Internal Memo',
                        '2': 'Cop Bank',
                        '3': 'BPJS',
                        '4': 'Surat Tugas',
                        '5': 'Offering Letter',
                        '6': 'Paklaring',
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
                        '1': `No:${divisi}-${detaildivisi}-${noSurat}/${kop}/${romanDay}/${romanMonth}/${year}`,
                        '2': `No:${divisi}-${detaildivisi}-${noSurat}/${kop}/${romanDay}/${romanMonth}/${year}`,
                        '3': `No:${divisi}-${detaildivisi}-${noSurat}/${kop}/${romanDay}/${romanMonth}/${year}`,
                        '4': `No:${divisi}-${detaildivisi}-${noSurat}/${kop}/${romanDay}/${romanMonth}/${year}`,
                        '5': `No:${divisi}-${detaildivisi}-${noSurat}/${kop}/${romanDay}/${romanMonth}/${year}`,
                        '6': `No:${divisi}-${detaildivisi}-${noSurat}/${kop}/${romanDay}/${romanMonth}/${year}`,
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

                }

                [perihalSelect, tglSuratInput, noSuratInput].forEach(element => {
                    element.addEventListener('change', handleFieldUpdates);
                });

                // Initialize
                handleFieldUpdates();
            });
        </script>
    @endsection
