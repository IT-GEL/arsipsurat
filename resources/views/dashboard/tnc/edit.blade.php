@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4 mx-auto" style="width: 210mm;">
                    <h6 class="mb-4">Edit Surat Keterangan Talent And Culture</h6>

                    <form method="post" action="/dashboard/tnc/{{ $tnc->id }}">

                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal Surat:</label>
                            <span style="font-weight:bold;">{{ old('perihal', $tnc->perihal) }}</span>
                            <input type="hidden" id="perihal" name="perihal"
                                class="form-control @error('perihal') is-invalid @enderror"
                                value="{{ old('perihal', $tnc->perihal) }}" required>
                            <input type="hidden" id="idPerihal" name="idPerihal"
                                class="form-control @error('idPerihal') is-invalid @enderror"
                                value="{{ old('idPerihal', $tnc->idPerihal) }}" required>
                            @error('perihal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat:</label>
                            <span
                                style="font-weight:bold;">{{ $tnc->prefix }}</span>
                            <input type="hidden" id="noSurat" name="noSurat" value="{{ old('noSurat', $tnc->noSurat) }}"
                                class="form-control @error('noSurat') is-invalid @enderror">
                            @error('noSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="tujuanSurat-field" class="mb-3" style="display: none;">
                            <label for="tujuanSurat" class="form-label">Tujuan Surat</label>
                            <input type="text" class="form-control @error('tujuanSurat') is-invalid @enderror" id="tujuanSurat"
                                name="tujuanSurat" required value="{{ old('tujuanSurat', $tnc->tujuanSurat) }}">
                            @error('tujuanSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="keterangan-field" class="mb-3">
                            <label for="keterangan" class="form-label">Isi Surat / Keterangan</label>
                            <input type="hidden" id="keterangan" name="keterangan"
                                value="{{ old('keterangan', $tnc->keterangan) }}">
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const keteranganValue = document.getElementById('keterangan').value;
                                    const keteranganEditor = Jodit.make('#keterangan', {
                                        value: keteranganValue // Set the initial value here
                                    });
                                    new DragAndDrop(keteranganEditor);
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
                                            placeholder="Tempat Buat Surat" readonly>
                                    </td>
                                    <td> , </td>
                                    <td>
                                        <input type="date" class="form-control @error('tglSurat') is-invalid @enderror"
                                            id="tglSurat" name="tglSurat" required value="{{ old('tglSurat') }} "readonly>
                                    </td>
                                </tr>
                            </table>

                            @error('tglSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="jml-lampiran-field" class="mb-3" style="display: none;">
                            <label for="jml_lampiran" class="form-label" >Jumlah lampiran yang akan dilampirkan</label>
                            <input type="number" name="jml_lampiran" id="jml_lampiran" value="{{ old('tglSurat') }}" class="form-control @error('jml_lampiran') is-invalid @enderror">
                            @error('jml_lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="upload-lampiran-field" class="mb-3" style="display: none;">
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

        <!-- Add JavaScript to handle form visibility -->
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
                const perihalSelect = '{{ $tnc->idPerihal }}'
                const jml_lampiran = document.getElementById('jml-lampiran-field');
                const upload_lampiran = document.getElementById('upload-lampiran-field');
                const tujuanSurat = document.getElementById('tujuanSurat-field');

                function showFields() {
                    // Hide fields by default
                    // jml_lampiran.style.display = 'none';
                    // upload_lampiran.style.display = 'none';
                    // tujuanSurat.style.display = 'none';

                    switch (perihalSelect) {
                        case '1':
                            // Show fields if value is 1
                            jml_lampiran.style.display = 'block';
                            upload_lampiran.style.display = 'block';
                            break;
                        case '2':
                            // Show fields if value is 2
                            tujuanSurat.style.display = 'block';
                            break;

                        case '3':
                            // Show fields if value is 3
                            identitasField.style.display = 'block';
                            jabatanField.style.display = 'block';
                            departementField.style.display = 'block';
                            keterangField.style.display = 'none';
                            terhitungTglField.style.display = 'block';
                            break;

                        case '4':
                            // Show fields if value is 4
                            identitasField.style.display = 'block';
                            break;


                        case '5':
                            // Show fields if value is 5
                            identitasField.style.display = 'block';
                            divisi.style.display = 'block';
                            keterangField.style.display = 'block';
                            break;
                        // You can add more cases here if needed
                        default:
                            // Default action can be empty or any other logic
                            break;
                    }
                }

                showFields();


            });

        </script>
    @endsection
