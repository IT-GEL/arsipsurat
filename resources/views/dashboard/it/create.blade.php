@extends('dashboard.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css">
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Buat Surat Keterangan IT</h6>
                    <form method="post" action="/dashboard/it">
                        @csrf
                        <div class="mb-3">

                            <div class="mb-3">
                                <label for="noSurat" class="form-label">Nomor Surat</label>
                                <input type="hidden" class="form-control @error('noSurat') is-invalid @enderror"
                                    id="noSurat" name="noSurat" required value="{{ old('noSurat') }}">
                                <input type="text" class="form-control" id="prefix" name="prefix" readonly>
                                @error('noSurat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="idPerihal" class="form-label">Jenis Surat</label>
                                <select class="form-select @error('idPerihal') is-invalid @enderror" id="idPerihal"
                                    name="idPerihal" required autofocus>
                                    <option value="" disabled selected>Pilih Peruntukan Jenis Surat</option>
                                    <option value="1">Berita Acara Permintaan Pembelian</option>
                                    <option value="2">Pembuatan/Penutupan Akun Shared Folder JKT-DS</option>
                                    <option value="3">Pembuatan/Penutupan Akun Gelsys</option>
                                </select>
                                <input type="hidden" id="perihal" name="perihal" value="{{ old('perihal') }}">
                                @error('idPerihal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>

                            {{-- Ketika IdPerihal = 1 (Permintaan Pembelian) --}}
                            <template id="perihal-options-1">
                                <option value="Permintaan Pembelian Laptop Baru">Permintaan Pembelian Laptop Baru
                                </option>
                                <option value="Permintaan Pembelian Sparepart Computer">Permintaan Pembelian
                                    Sparepart Computer</option>
                                <option value="Permintaan Pembelian Sparepart Laptop">Permintaan Pembelian Sparepart
                                    Laptop</option>
                            </template>
                            {{-- Ketika IdPerihal = 2 (Pembuatan/Penutupan Akun Shared Folder JKT-DS) --}}
                            <template id="perihal-options-2">
                                <option value="Pembuatan Akun Shared Folder JKT-DS">Pembuatan Akun Shared Folder
                                    JKT-DS</option>
                                <option value="Penutupan Akun Shared Folder JKT-DS">Penutupan Akun Shared Folder
                                    JKT-DS</option>
                            </template>
                            {{-- Ketika IdPerihal = 3 (Pembuatan/Penutupan Akun Gelsys) --}}
                            <template id="perihal-options-3">
                                <option value="Pembuatan Akun Gelsys">Pembuatan Akun Gelsys</option>
                                <option value="Penutupan Akun Gelsys">Penutupan Akun Gelsys</option>
                            </template>

                            <div class="mb-3">
                                <label for="perihalLanjutan" class="form-label">Perihal Surat</label>
                                <select class="form-select @error('perihalLanjutan') is-invalid @enderror"
                                    id="perihalLanjutan" name="perihalLanjutan" required autofocus>
                                    <option value="" disabled selected>Pilih Peruntukan Perihal Surat</option>

                                </select>
                                @error('perihalLanjutan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <script>
                                document.getElementById('idPerihal').addEventListener('change', function() {
                                    const perihalSelect = document.getElementById('perihalLanjutan');
                                    const selectedIdPerihal = this.value;

                                    // Clear existing options
                                    perihalSelect.innerHTML = '<option value="" disabled selected>Pilih Peruntukan Perihal Surat</option>';

                                    // Get the corresponding template
                                    const template = document.getElementById(`perihal-options-${selectedIdPerihal}`);
                                    if (template) {
                                        // Clone the template content and append to the Perihal select
                                        const options = template.content.cloneNode(true);
                                        perihalSelect.appendChild(options);
                                    }
                                });
                            </script>


                            <div class="mb-3">
                                <label for="kop" class="form-label">Pilih Kop Surat</label>
                                <select class="form-select @error('kop') is-invalid @enderror" id="kop" name="kop"
                                    autofocus>
                                    <option value="" selected>Tanpa Kop</option>
                                    <option value="GEL">GEL</option>
                                    <option value="QIN">QIN</option>
                                    <option value="ERA">ERA</option>
                                    <option value="GCR">GCR</option>
                                    <option value="KKS">KKS</option>
                                </select>
                                @error('kop')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="mb-3" id="namauser-field" style="display: none;">
                                <label for="nama" class="form-label">Nama User</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3" id="noKaryawan-field" style="display: none;">
                                <label for="noKaryawan" class="form-label">Nomer Karyawan User</label>
                                <input type="text" class="form-control @error('noKaryawan') is-invalid @enderror"
                                    id="noKaryawan" name="noKaryawan" value="{{ old('noKaryawan') }}">
                                @error('noKaryawan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div id="departement-field" class="mb-3" style="display: none;">
                                <label for="departement" class="form-label">Departement User</label>
                                <input type="text" name="departement" id="departement"
                                    class="form-control @error('departement') is-invalid @enderror">
                                @error('departement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="hardware-field" class="mb-3" style="display: none;">
                                <label for="hardware" class="form-label">Kendala Hardware</label>
                                <textarea type="text" name="hardware" id="hardware"
                                    class="form-control @error('hardware') is-invalid @enderror"></textarea>
                                @error('hardware')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="software-field" class="mb-3" style="display: none;">
                                <label for="software" class="form-label">Kendala Software</label>
                                <textarea type="text" name="software" id="software"
                                    class="form-control @error('software') is-invalid @enderror"></textarea>
                                @error('software')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="specProblem-field" class="mb-3" style="display: none;">
                                <label for="specProblem" class="form-label">Spesifikasi tidak memadai</label>
                                <textarea type="text" name="specProblem" id="specProblem"
                                    class="form-control @error('specProblem') is-invalid @enderror"></textarea>
                                @error('specProblem')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="mb-3" id="jabatan-field" style="display: none;">
                                <label for="jabatan" class="form-label">Jabatan User</label>
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                    placeholder="Isi Jabatan..." id="jabatan" name="jabatan"
                                    value="{{ old('jabatan') }}">
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3" id="divisi-field" style="display: none;">
                                <label for="divisi" class="form-label">Divisi User</label>
                                <input type="text" class="form-control @error('divisi') is-invalid @enderror"
                                    placeholder="Isi Divisi..." id="divisi" name="divisi"
                                    value="{{ old('divisi') }}">
                                @error('divisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="keterangan-field" class="mb-3" style="display: none;">
                                <label for="keterangan" class="form-label">Isi Surat / Keterangan</label>
                                <div class="main-container">
                                    <div class="editor-container editor-container_classic-editor" id="editor-container">
                                        <div class="editor-container__editor">
                                            <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">

                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="mb-3 mt-3">
                                <label for="tglSurat" class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('tglSurat') is-invalid @enderror"
                                    id="tglSurat" name="tglSurat" value="{{ old('tglSurat') }}">
                                @error('tglSurat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Set today's date as default for the date input
                                    document.getElementById('tglSurat').value = new Date().toISOString().split('T')[0];

                                    const perihalSelect = document.getElementById('perihal');
                                    const prefixInput = document.getElementById('prefix');
                                    const noSuratInput = document.getElementById('noSurat');

                                    // Placeholder for max values based on perihal
                                    const maxValues = {
                                        "Pembuatan Akun Shared Folder JKT-DS": 0,
                                        "Penutupan Akun Shared Folder JKT-DS": 0,
                                        "Pembuatan Akun Gelsys": 0,
                                        "Penutupan Akun Gelsys": 0,
                                    };

                                    // Convert number to Roman numeral
                                    function toRoman(num) {
                                        const roman = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
                                        return roman[num - 1] || '';
                                    }

                                    // Update number and prefix when perihal changes
                                    perihalSelect.addEventListener('change', function() {
                                        const currentType = this.value;
                                        // Increment the count for the selected perihal
                                        maxValues[currentType] = (maxValues[currentType] || 0) + 1;
                                        noSuratInput.value = maxValues[currentType];

                                        const tglSurat = new Date(document.getElementById('tglSurat').value);
                                        const romanMonth = toRoman(tglSurat.getMonth() + 1);
                                        const year = tglSurat.getFullYear();
                                        prefixInput.value = `ITS/${noSuratInput.value}/GELJKT/${romanMonth}/${year}`;
                                    });
                                });
                            </script>

                            <div class="mb-3">
                                <label for="ttd" class="form-label">Yang Menandatangani</label>
                                <input type="text" class="form-control @error('ttd') is-invalid @enderror"
                                    id="ttd" name="ttd" placeholder="Departement Head"
                                    value="{{ old('ttd') }}">
                                @error('ttd')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="namaTtd" class="form-label">Nama Yang Menandatangani</label>
                                <input type="text" class="form-control @error('namaTtd') is-invalid @enderror"
                                    id="namaTtd" name="namaTtd" value="{{ old('namaTtd') }}">
                                @error('namaTtd')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Buat Surat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400;1,700&display=swap');

        @media print {
            body {
                margin: 0 !important;
            }
        }

        .main-container {
            font-family: 'Lato';
            width: 100%;
        }

        .ck-content {
            font-family: 'Lato';
            line-height: 1.6;
            word-break: break-word;
        }

        .editor-container_classic-editor .editor-container__editor {
            min-width: 795px;
        }


        .drag-over {
            border: 2px dashed #007bff;
            background: rgba(0, 123, 255, 0.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const perihalSelect = document.getElementById('idPerihal');
            const kopSelect = document.getElementById('kop');
            const noSuratInput = document.getElementById('noSurat');
            const ket = document.getElementById('keterangan');
            const keterangField = document.getElementById('keterangan-field');
            const prefixInput = document.getElementById('prefix');
            const tglSuratInput = document.getElementById('tglSurat');
            const divisi = document.getElementById('divisi-field');
            const jabatanField = document.getElementById('jabatan-field');
            const departementField = document.getElementById('departement-field');
            const namauserField = document.getElementById('namauser-field')
            const hardwareField = document.getElementById('hardware-field')
            const softwareField = document.getElementById('software-field')
            const specProblemField = document.getElementById('specProblem-field')
            const noKaryawanField = document.getElementById('noKaryawan-field')


            const PADDING_LENGTH = 3;

            function showFields() {
                // Hide fields by default
                divisi.style.display = 'none';
                jabatanField.style.display = 'none';
                departementField.style.display = 'none';
                keterangField.style.display = 'none';
                namauserField.style.display = 'none';
                hardwareField.style.display = 'none';
                softwareField.style.display = 'none';
                specProblemField.style.display = 'none';
                noKaryawanField.style.display = 'none'


                switch (perihalSelect.value) {
                    case '1':
                        // Show fields if value is 1
                        namauserField.style.display = 'block';
                        departementField.style.display = 'block';
                        keterangField.style.display = 'block';
                        hardwareField.style.display = 'block';
                        softwareField.style.display = 'block';
                        specProblemField.style.display = 'block';
                        noKaryawanField.style.display = 'block'
                        break;

                    case '2':
                        // Show fields if value is 2

                        break;

                    case '3':
                        // Show fields if value is 3

                        break;

                        // You can add more cases here if needed
                    default:
                        // Default action can be empty or any other logic
                        break;
                }
            }

            const maxValues = {
                '1': {{ $maxNoSuratPerihal1 }},
                '2': {{ $maxNoSuratPerihal2 }},
                '3': {{ $maxNoSuratPerihal3 }},


            };

            function setInitialNoSurat() {
                const currentType = perihalSelect.value;
                const maxNoSuratPerihal2 = {{ $maxNoSuratPerihal2 }};
                const kop = document.getElementById('kop').value;
                if (perihalSelect.value === '1') {
                    noSuratInput.value = (maxValues[kop] || 0) + 1;
                } else {
                    noSuratInput.value = (maxValues[currentType] || 0) + 1;;
                }
            }


            perihalSelect.addEventListener('change', function() {
                const selectedValue = this.value;
                const perihalInput = document.getElementById('perihal');

                const perihalMap = {
                    '1': 'Internal Memo',
                    '2': 'Pengajuan Test Psikologi Pegawai',
                    '3': 'Surat Keterangan Kerja',
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
                // const divisi = document.getElementById('divisiSelect').value;

                const prefixMap = {
                    '1': `ITS/${noSurat}/${kop}JKT/${romanMonth}/${year}`,
                    '2': `${noSurat}/${kop}/TNC/${romanMonth}/${year}`,
                    '3': `No : ${kop}/TNC/REF/${romanMonth}/${year}`,
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

            [kopSelect, perihalSelect, tglSuratInput, noSuratInput].forEach(element => {
                element.addEventListener('change', handleFieldUpdates);
            });

            // Initialize
            handleFieldUpdates();
            perihalSelect.addEventListener('change', showFields);
        });
    </script>
    <script type="importmap">

        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.2.0/"
            }
        }
        </script>

    <script type="module">
        import {
            ClassicEditor,
            AccessibilityHelp,
            Autoformat,
            AutoImage,
            Autosave,
            BalloonToolbar,
            Base64UploadAdapter,
            Bold,
            Essentials,
            FontBackgroundColor,
            FontColor,
            FontFamily,
            FontSize,
            GeneralHtmlSupport,
            Heading,
            HtmlComment,
            ImageBlock,
            ImageCaption,
            ImageInline,
            ImageInsert,
            ImageInsertViaUrl,
            ImageResize,
            ImageStyle,
            ImageTextAlternative,
            ImageToolbar,
            ImageUpload,
            Indent,
            IndentBlock,
            Italic,
            Link,
            LinkImage,
            List,
            ListProperties,
            MediaEmbed,
            PageBreak,
            Paragraph,
            PasteFromOffice,
            SelectAll,
            SourceEditing,
            Strikethrough,
            Table,
            TableCaption,
            TableCellProperties,
            TableColumnResize,
            TableProperties,
            TableToolbar,
            TextTransformation,
            TodoList,
            Underline,
            Undo
        } from 'ckeditor5';

        let perihalSelected = '';

        let keteranganContent = `<p style="line-height:115%;margin:0cm;">
        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN" dir="ltr">Kami merekomendasikan untuk dilakukan ${perihalSelected} dengan yang baru dan memiliki spesifikasi sebagai berikut :</span></span>
    </p>
    <ul style="padding-left:48px;">
        <li>
            <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN" dir="ltr">Prosesor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Minimal i7 gen 12 atau setara</span></span>
            </p>
        </li>
        <li>
            <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN" dir="ltr">RAM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Minimal 16GB</span></span>
            </p>
        </li>
        <li>
            <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN" dir="ltr">SSD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Minimal 512GB</span></span>
            </p>
        </li>
        <li>
            <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN" dir="ltr">Layar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 14inc Full HD</span></span>
            </p>
        </li>
        <li>
            <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN" dir="ltr">Fitur lain&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Port USB 3.0,HDMI</span></span>
            </p>
        </li>
    </ul>`;

        document.getElementById('perihalLanjutan').addEventListener('change', function() {
            perihalSelected = this.value;

            keteranganContent = `<p style="line-height:115%;margin:0cm;">
        <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN" dir="ltr">Kami merekomendasikan untuk dilakukan ${perihalSelected} dengan yang baru dan memiliki spesifikasi sebagai berikut :</span></span>
    </p>
    <ul style="padding-left:48px;">
        <li>
            <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN" dir="ltr">Prosesor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Minimal i7 gen 12 atau setara</span></span>
            </p>
        </li>
        <li>
            <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN" dir="ltr">RAM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Minimal 16GB</span></span>
            </p>
        </li>
        <li>
            <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN" dir="ltr">SSD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Minimal 512GB</span></span>
            </p>
        </li>
        <li>
            <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN" dir="ltr">Layar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 14inc Full HD</span></span>
            </p>
        </li>
        <li>
            <p style="line-height:115%;margin-bottom:0cm;margin-right:0cm;margin-top:0cm;">
                <span style="font-family:&quot;Times New Roman&quot;, serif;font-size:12pt;"><span lang="IN" dir="ltr">Fitur lain&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Port USB 3.0,HDMI</span></span>
            </p>
        </li>
    </ul>`;
            editor.setData(keteranganContent);
        })

        const editorConfig = {
            toolbar: {
                items: [
                    'undo',
                    'redo',
                    '|',
                    'sourceEditing',
                    '|',
                    'heading',
                    '|',
                    'fontSize',
                    'fontFamily',
                    'fontColor',
                    'fontBackgroundColor',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    'strikethrough',
                    '|',
                    'pageBreak',
                    'link',
                    'insertImage',
                    'mediaEmbed',
                    'insertTable',
                    '|',
                    'bulletedList',
                    'numberedList',
                    'todoList',
                    'outdent',
                    'indent'
                ],
                shouldNotGroupWhenFull: false
            },
            plugins: [
                AccessibilityHelp,
                Autoformat,
                AutoImage,
                Autosave,
                BalloonToolbar,
                Base64UploadAdapter,
                Bold,
                Essentials,
                FontBackgroundColor,
                FontColor,
                FontFamily,
                FontSize,
                GeneralHtmlSupport,
                Heading,
                HtmlComment,
                ImageBlock,
                ImageCaption,
                ImageInline,
                ImageInsert,
                ImageInsertViaUrl,
                ImageResize,
                ImageStyle,
                ImageTextAlternative,
                ImageToolbar,
                ImageUpload,
                Indent,
                IndentBlock,
                Italic,
                Link,
                LinkImage,
                List,
                ListProperties,
                MediaEmbed,
                PageBreak,
                Paragraph,
                PasteFromOffice,
                SelectAll,
                SourceEditing,
                Strikethrough,
                Table,
                TableCaption,
                TableCellProperties,
                TableColumnResize,
                TableProperties,
                TableToolbar,
                TextTransformation,
                TodoList,
                Underline,
                Undo
            ],
            balloonToolbar: ['bold', 'italic', '|', 'link', 'insertImage', '|', 'bulletedList', 'numberedList'],
            fontFamily: {
                supportAllValues: true
            },
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            htmlSupport: {
                allow: [{
                    name: /^.*$/,
                    styles: true,
                    attributes: true,
                    classes: true
                }]
            },
            image: {
                toolbar: [
                    'toggleImageCaption',
                    'imageTextAlternative',
                    '|',
                    'imageStyle:inline',
                    'imageStyle:wrapText',
                    'imageStyle:breakText',
                    '|',
                    'resizeImage'
                ]
            },
            link: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                decorators: {
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            placeholder: 'Type or paste your content here!',
            initialData: keteranganContent,
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
            }
        };

        let editor = await ClassicEditor.create(document.querySelector('#keterangan'), editorConfig);
    </script>
@endsection
