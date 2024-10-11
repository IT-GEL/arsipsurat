@extends('dashboard.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css">
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 mx-auto p-4" style="width: 210mm;">
                    <h6 class="mb-4">Buat Surat Keterangan Talent And Culture</h6>
                    <form method="post" action="/dashboard/finap">
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
                                <option value="1">Permintaan Pembayaran</option>
                                <option value="2" disabled>Pengajuan Test Psikolog Waskita</option>
                                <option value="3" disabled>Cop Bank</option>
                                {{-- <option value="4" disabled>BPJS</option>
                                <option value="5" disabled>Surat Tugas</option>
                                <option value="6" disabled>Offering Letter</option>
                                <option value="7" disabled>Paklaring</option> --}}
                            </select>
                            <input type="hidden" id="perihal" name="perihal" value="{{ old('perihal') }}">
                            @error('idPerihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idDepartement" class="form-label">Departement</label>
                            <select class="form-select @error('kop') is-invalid @enderror" id="idDepartement"
                                name="idDepartement" required autofocus>
                                <option value="" selected disabled>Department..</option>
                                <option value="BNL" data-department="Treasury">Treasury</option>
                                <option value="BNL" data-department="BNL">BNL</option>
                                {{-- <option value="QIN">QIN</option>
                                <option value="ERA">ERA</option>
                                <option value="GCR">GCR</option> --}}
                            </select>
                            <input type="hidden" id="departement" name="departement" value="{{ old('departement') }}">
                            @error('kop')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="vendor" class="form-label">Vendor</label>
                            <input type="text" class="form-control @error('vendor') is-invalid @enderror" id="vendor"
                                name="vendor" required value="{{ old('vendor') }}">
                            @error('vendor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dueDate" class="form-label">Due Date</label>
                            <input type="date" class="form-control @error('dueDate') is-invalid @enderror" id="dueDate"
                                name="dueDate" required value="{{ old('dueDate') }}">
                            @error('dueDate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="coa" class="form-label">COA</label>
                            <input type="text" class="form-control @error('coa') is-invalid @enderror" id="coa"
                                name="coa" value="{{ old('coa') }}">
                            @error('coa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="keterangan" class="form-label">Daftar Pembayaran</label>
                        <div id="keterangan-field" class="mb-3 rounded p-3" style="background-color: white">
                            <div id="items-container">
                                @php $itemCount = isset($items) ? count($items) : 1; @endphp
                                @for ($i = 1; $i <= $itemCount; $i++)
                                    <div class="item rounded border border-secondary p-3 mb-3"
                                        id="item-{{ $i }}">
                                        <div class="row">
                                            <div>
                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                <input type="text" class="form-control"
                                                    id="deskripsi-{{ $i }}"
                                                    name="items[{{ $i }}][deskripsi]" required
                                                    value="{{ old('items.' . $i . '.deskripsi', $items[$i]['deskripsi'] ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="pokok-{{ $i }}" class="form-label">Pokok</label>
                                                <input type="text" class="form-control" id="pokok-{{ $i }}"
                                                    name="items[{{ $i }}][pokok]" required
                                                    value="{{ old('items.' . $i . '.pokok', $items[$i]['pokok'] ?? '') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="bunga-{{ $i }}" class="form-label">Bunga</label>
                                                <input type="text" class="form-control"
                                                    id="bunga-{{ $i }}"
                                                    name="items[{{ $i }}][bunga]"
                                                    value="{{ old('items.' . $i . '.bunga', $items[$i]['bunga'] ?? '') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="admin-{{ $i }}" class="form-label">Admin</label>
                                                <input type="text" class="form-control"
                                                    id="admin-{{ $i }}"
                                                    name="items[{{ $i }}][admin]"
                                                    value="{{ old('items.' . $i . '.admin', $items[$i]['admin'] ?? '') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="denda-{{ $i }}" class="form-label">Denda</label>
                                                <input type="text" class="form-control"
                                                    id="denda-{{ $i }}"
                                                    name="items[{{ $i }}][denda]"
                                                    value="{{ old('items.' . $i . '.denda', $items[$i]['denda'] ?? '') }}">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger mt-3 delete-item">Hapus Item</button>
                                    </div>
                                @endfor
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <button type="button" class="btn btn-secondary" id="add-item">Tambah Item</button>
                                <div class="mb-9">
                                    <label for="total" class="form-label">Total</label>
                                    <input type="text" class="form-control @error('total') is-invalid @enderror"
                                        id="total" name="total" required readonly value="{{ old('total') }}">
                                </div>
                            </div>

                            <script>
                                function numberToWords(number) {
                                    const units = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan"];
                                    const teens = ["Sepuluh", "Sebelas", "Dua Belas", "Tiga Belas", "Empat Belas", "Lima Belas", "Enam Belas",
                                        "Tujuh Belas", "Delapan Belas", "Sembilan Belas"
                                    ];
                                    const tens = ["", "", "Dua Puluh", "Tiga Puluh", "Empat Puluh", "Lima Puluh", "Enam Puluh", "Tujuh Puluh",
                                        "Delapan Puluh", "Sembilan Puluh"
                                    ];
                                    const thousands = ["", "Ribu", "Juta", "Miliar", "Triliun"];

                                    if (number === 0) return "Nol";

                                    // Helper function for numbers less than 1000
                                    function convertHundreds(n) {
                                        let result = "";

                                        if (n >= 100) {
                                            if (n === 100) {
                                                result += "Seratus ";
                                            } else if (n < 200) {
                                                result += "Seratus "; // Handles the case of 101-199
                                                n %= 100;
                                            } else {
                                                result += units[Math.floor(n / 100)] + " Ratus ";
                                                n %= 100;
                                            }
                                        }

                                        if (n >= 10 && n < 20) {
                                            result += teens[n - 10] + " ";
                                        } else {
                                            if (n >= 20) {
                                                result += tens[Math.floor(n / 10)] + " ";
                                                n %= 10;
                                            }
                                            if (n > 0) {
                                                result += units[n] + " ";
                                            }
                                        }

                                        return result.trim();
                                    }

                                    // Function to break the number into groups of thousands
                                    function convertToWords(n) {
                                        let result = "";
                                        let group = 0;

                                        while (n > 0) {
                                            let currentGroup = n % 1000;

                                            if (currentGroup > 0) {
                                                let groupWord = convertHundreds(currentGroup);

                                                // Add appropriate thousand, million, billion, etc.
                                                if (group === 1 && currentGroup === 1) {
                                                    result = "Seribu " + result;
                                                } else if (group > 0) {
                                                    result = groupWord + " " + thousands[group] + " " + result;
                                                } else {
                                                    result = groupWord + " " + result;
                                                }
                                            }

                                            n = Math.floor(n / 1000);
                                            group++;
                                        }

                                        return result.trim();
                                    }

                                    return convertToWords(number);
                                }

                                document.addEventListener('DOMContentLoaded', function() {
                                    const itemsContainer = document.getElementById('items-container');
                                    const addItemButton = document.getElementById('add-item');
                                    const totalInput = document.getElementById('total');
                                    const terbilangInput = document.getElementById('terbilang');
                                    let itemCount = {{ $itemCount }}; // Start item count based on the number of items

                                    function calculateTotal(item) {
                                        const pokokInputs = document.querySelectorAll('[name^="items"][name$="[pokok]"]');
                                        const bungaInputs = document.querySelectorAll('[name^="items"][name$="[bunga]"]');
                                        const adminInputs = document.querySelectorAll('[name^="items"][name$="[admin]"]');
                                        const dendaInputs = document.querySelectorAll('[name^="items"][name$="[denda]"]');
                                        const totalInput = document.getElementById('total');

                                        let total = 0;

                                        pokokInputs.forEach(input => {
                                            total += parseFloat(input.value) || 0;
                                        });

                                        bungaInputs.forEach(input => {
                                            total += parseFloat(input.value) || 0;
                                        });

                                        adminInputs.forEach(input => {
                                            total += parseFloat(input.value) || 0;
                                        });

                                        dendaInputs.forEach(input => {
                                            total += parseFloat(input.value) || 0;
                                        });

                                        totalInput.value = total;
                                        updateTerbilang();
                                    }

                                    function addItem() {
                                        itemCount++;
                                        const newItem = document.querySelector('.item').cloneNode(true);
                                        newItem.id = `item-${itemCount}`;
                                        newItem.querySelectorAll('input').forEach(input => {
                                            const name = input.name.replace(/\d+/, itemCount); // Adjust index in name
                                            input.name = name;
                                            input.id = name;
                                            input.value = '';
                                        });
                                        itemsContainer.appendChild(newItem);

                                        newItem.querySelector('[name$="[pokok]"]').addEventListener('input', () => calculateTotal(newItem));
                                        newItem.querySelector('[name$="[bunga]"]').addEventListener('input', () => calculateTotal(newItem));
                                        newItem.querySelector('[name$="[admin]"]').addEventListener('input', () => calculateTotal(newItem));
                                        newItem.querySelector('[name$="[denda]"]').addEventListener('input', () => calculateTotal(newItem));
                                        newItem.querySelector('.delete-item').addEventListener('click', () => deleteItem(newItem));

                                        updateDeleteButtons();
                                    }

                                    function deleteItem(item) {
                                        item.remove();
                                        itemCount--;
                                        updateDeleteButtons();
                                        calculateTotal(); // Recalculate total after item deletion
                                    }

                                    function updateDeleteButtons() {
                                        const deleteButtons = document.querySelectorAll('.delete-item');
                                        if (deleteButtons.length === 1) {
                                            deleteButtons[0].disabled = true;
                                        } else {
                                            deleteButtons.forEach(button => button.disabled = false);
                                        }
                                    }

                                    addItemButton.addEventListener('click', addItem);

                                    document.querySelectorAll('.item').forEach(item => {
                                        item.querySelector('[name$="[pokok]"]').addEventListener('input', () => calculateTotal(
                                            item));
                                        item.querySelector('[name$="[bunga]"]').addEventListener('input', () => calculateTotal(
                                            item));
                                        item.querySelector('[name$="[admin]"]').addEventListener('input', () => calculateTotal(
                                            item));
                                        item.querySelector('[name$="[denda]"]').addEventListener('input', () => calculateTotal(
                                            item));
                                        item.querySelector('.delete-item').addEventListener('click', () => deleteItem(item));
                                    });

                                    updateDeleteButtons();

                                    function updateTerbilang() {
                                        const totalValue = parseFloat(totalInput.value.replace(/[^0-9,-]+/g, "").replace(",", "."));
                                        if (!isNaN(totalValue)) {
                                            terbilangInput.value = numberToWords(totalValue) + " Rupiah";
                                        } else {
                                            terbilangInput.value = "";
                                        }
                                    }

                                    totalInput.addEventListener('input', updateTerbilang);
                                    updateTerbilang(); // Initialize on load
                                });
                            </script>
                        </div>

                        <div class="mb-3">
                            <label for="terbilang" class="form-label">Terbilang</label>
                            <input type="text" class="form-control @error('terbilang') is-invalid @enderror" readonly
                                id="terbilang" name="terbilang" required value="{{ old('terbilang') }}">
                            @error('terbilang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ket" class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('ket') is-invalid @enderror" id="ket"
                                name="ket" required value="{{ old('ket') }}">
                            @error('ket')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="a_nama" class="form-label">Atas Nama</label>
                            <input type="text" class="form-control @error('a_nama') is-invalid @enderror"
                                id="a_nama" name="a_nama" required value="{{ old('a_nama') }}">
                            @error('a_nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bank" class="form-label">Bank</label>
                            <input type="text" class="form-control @error('bank') is-invalid @enderror" id="bank"
                                name="bank" required value="{{ old('bank') }}">
                            @error('bank')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="norek" class="form-label">No Rekening</label>
                            <input type="text" class="form-control @error('norek') is-invalid @enderror"
                                id="norek" name="norek" required value="{{ old('norek') }}">
                            @error('norek')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="tglSurat" class="form-label">Tanggal Surat</label>
                            <table>
                                <tr>
                                    <td>
                                        <input type="date"
                                            class="form-control @error('tglSurat') is-invalid @enderror" id="tglSurat"
                                            name="tglSurat" required value="{{ old('tglSurat') }}">
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
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                            @error('catatan')
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
        </style>

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
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
                }
            };

            ClassicEditor.create(document.querySelector('#catatan'), editorConfig);
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', async function() {
                const noSuratInput = document.getElementById('noSurat');
                const perihalSelect = document.getElementById('idPerihal');
                const perihalInput = document.getElementById('perihal');
                const DepartementSelect = document.getElementById('idDepartement');
                const DepartementInput = document.getElementById('departement');

                const ket = document.getElementById('keterangan');
                const prefixInput = document.getElementById('prefix');
                const tglSuratInput = document.getElementById('tglSurat');
                const tujuanSurat = document.getElementById('tujuanSurat-field');

                const PADDING_LENGTH = 3;

                perihalSelect.addEventListener('change', function() {
                    const selectedValue = this.value;
                    const perihalMap = {
                        '1': 'Permintaan Pembayaran',
                        '2': 'Pengajuan Test Psikologi Pegawai',
                        '3': 'Cop Bank',
                        '4': 'BPJS',
                        '5': 'Surat Tugas',
                        '6': 'Offering Letter',
                        '7': 'Paklaring',
                    };
                    perihalInput.value = perihalMap[selectedValue] || '';
                    handleFieldUpdates();
                });

                DepartementSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const department = selectedOption.getAttribute('data-department');
                    const treasuryMap = {
                        'BNL': 'Treasury',
                        'QIN': 'QIN',
                        'ERA': 'ERA',
                        'GCR': 'GCR',
                    };
                    DepartementInput.value = department|| '';
                    handleFieldUpdates();
                });

                function updatePrefix() {
                    const noSurat = String(noSuratInput.value || '0').padStart(PADDING_LENGTH, '0');
                    const tglSurat = new Date(tglSuratInput.value);
                    const romanMonth = toRoman(tglSurat.getMonth() + 1);
                    const month = tglSurat.getMonth() + 1;
                    const year = tglSurat.getFullYear();

                    const prefixMap = {
                        '1': `${DepartementSelect.value}/CCL/${month}/${year}/${noSurat}`,
                        // '2': `${noSurat}/${kop}/TNC/${romanMonth}/${year}`,
                        // '3': `No:${noSurat}/${kop}/${romanMonth}/${year}`,
                    };

                    prefixInput.value = prefixMap[perihalSelect.value] || '';
                }

                function toRoman(num) {
                    const roman = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
                    return roman[num - 1] || '';
                }

                function handleFieldUpdates() {
                    const maxNoSurat = {{ $maxNoSurat }};
                    noSuratInput.value = maxNoSurat + 1;
                    // setInitialNoSurat();
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
