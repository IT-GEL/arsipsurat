@extends('dashboard.layouts.main')

@section('container')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css">
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Surat Keterangan IT</h6>
                    <form method="post" action="/dashboard/it/{{ $it->id }}">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat:</label>
                            <span style="font-weight:bold;">{{ $it->prefix }}</span>
                            <input type="hidden" id="noSurat" name="noSurat" value="{{ old('noSurat', $it->noSurat) }}" class="form-control @error('noSurat') is-invalid @enderror">
                            @error('noSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Perihal:</label><span><strong> {{ $it->perihalLanjutan }}</strong></span>
                        </div>

                        <div class="mb-3" id="namauser-field" style="display: none;">
                            <label for="nama" class="form-label">Nama User</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                id="nama" name="nama" value="{{ old('nama',$it->nama) }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3" id="noKaryawan-field" style="display: none;">
                            <label for="noKaryawan" class="form-label">Nomer Karyawan User</label>
                            <input type="text" class="form-control @error('noKaryawan') is-invalid @enderror"
                                id="noKaryawan" name="noKaryawan" value="{{ old('noKaryawan',$it->noKaryawan) }}">
                            @error('noKaryawan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div id="departement-field" class="mb-3" style="display: none;">
                            <label for="departement" class="form-label">Departement User</label>
                            <input type="text" name="departement" id="departement" value="{{ old('departement',$it->departement) }}"
                                class="form-control @error('departement') is-invalid @enderror">
                            @error('departement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="hardware-field" class="mb-3" style="display: none;">
                            <label for="hardware" class="form-label">Kendala Hardware</label>
                            <textarea type="text" name="hardware" id="hardware"
                                class="form-control @error('hardware') is-invalid @enderror">{{ old('hardware',$it->hardware) }}</textarea>
                            @error('hardware')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="software-field" class="mb-3" style="display: none;">
                            <label for="software" class="form-label">Kendala Software</label>
                            <textarea type="text" name="software" id="software"
                                class="form-control @error('software') is-invalid @enderror">{{ old('hardware',$it->software) }}</textarea>
                            @error('software')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="specProblem-field" class="mb-3" style="display: none;">
                            <label for="specProblem" class="form-label">Spesifikasi tidak memadai</label>
                            <textarea type="text" name="specProblem" id="specProblem"
                                class="form-control @error('specProblem') is-invalid @enderror">{{ old('hardware',$it->specProblem) }}</textarea>
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
                                            {{ old('keterangan',$it->keterangan) }}
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

                        <div class="mb-3">
                            <label for="ttd" class="form-label">Yang Menandatangani:</label>
                            <input readonly type="text" id="ttd" name="ttd" class="form-control @error('ttd') is-invalid @enderror" value="{{ old('ttd', $it->ttd) }}" placeholder="Keuchik/Sekdes" required>
                            @error('ttd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="namaTtd" class="form-label">Yang Membuat Surat:</label>
                            <input readonly type="text" id="namaTtd" name="namaTtd" class="form-control @error('namaTtd') is-invalid @enderror" value="{{ old('namaTtd', $it->namaTtd) }}" required>
                            @error('namaTtd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Edit Surat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
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
            const perihalSelect = {{ $it->idPerihal }};
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

console.log(perihalSelect);

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


                switch (perihalSelect) {
                    case 1:
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
            showFields();

            function toRoman(num) {
                const roman = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
                return roman[num - 1] || '';
            }
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

        let editor = await ClassicEditor.create(document.querySelector('#keterangan'), editorConfig);
    </script>
@endsection
