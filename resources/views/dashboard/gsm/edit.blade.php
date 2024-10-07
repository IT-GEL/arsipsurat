@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4 mx-auto" style="width: 210mm;">
                    <h6 class="mb-4">Edit Surat Keterangan Marketing Sales Shipping</h6>

                    <form method="post" action="/dashboard/gsm/{{ $gsm->id }}">

                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal Surat:</label>
                            <span style="font-weight:bold;">{{ old('perihal', $gsm->perihal) }}</span>
                            <input type="hidden" id="perihal" name="perihal"
                                class="form-control @error('perihal') is-invalid @enderror"
                                value="{{ old('perihal', $gsm->perihal) }}" required>
                            <input type="hidden" id="idPerihal" name="idPerihal"
                                class="form-control @error('idPerihal') is-invalid @enderror"
                                value="{{ old('idPerihal', $gsm->idPerihal) }}" required>
                            @error('perihal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat:</label>
                            <span
                                style="font-weight:bold;">{{ $gsm->prefix }}</span>
                            <input type="hidden" id="noSurat" name="noSurat" value="{{ old('noSurat', $gsm->noSurat) }}"
                                class="form-control @error('noSurat') is-invalid @enderror">
                            @error('noSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="keterangan-field" class="mb-3">
                            <label for="keterangan" class="form-label">Isi Surat / Keterangan</label>
                            <input type="hidden" id="keterangan" name="keterangan"
                                value="{{ old('keterangan', $gsm->keterangan) }}">
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
                            <label for="tglSurat" class="form-label">Tanggal Buat Surat</label>
                            <input type="date" class="form-control @error('tglSurat') is-invalid @enderror"
                                id="tglSurat" name="tglSurat" required value="{{ old('tglSurat', $gsm->tglSurat) }}"
                                readonly>
                            @error('tglSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ttd" class="form-label">Yang Menandatangani</label>
                            <input type="text" class="form-control @error('ttd') is-invalid @enderror" id="ttd"
                                name="ttd" required value="{{ old('ttd', $gsm->ttd) }}" readonly>
                            @error('ttd')
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

        </script>
    @endsection
