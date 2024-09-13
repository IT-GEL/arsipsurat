@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Surat Keterangan IT</h6>
                    <form method="post" action="/dashboard/it/{{ $it->noSurat }}">
                        @method('put')
                        @csrf

                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal Surat:</label>
                            <input type="text" id="perihal" name="perihal" class="form-control @error('perihal') is-invalid @enderror" value="{{ old('perihal', $it->perihal) }}" required>
                            @error('perihal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat:</label>
                            <span style="font-weight:bold;">ITS/{{ old('noSurat', $it->noSurat) }}/GELJKT/{{ $romanMonth }}/2024</span>
                            <input type="hidden" id="noSurat" name="noSurat" value="{{ old('noSurat', $it->noSurat) }}" class="form-control @error('noSurat') is-invalid @enderror">
                            @error('noSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama User</label>
                            <input type="nama" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $it->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan User</label>
                            <input type="jabatan" id="jabatan" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $it->jabatan) }}" required>
                            @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="divisi" class="form-label">Divisi User:</label>
                            <input type="divisi" id="divisi" name="divisi" class="form-control @error('divisi') is-invalid @enderror" value="{{ old('divisi', $it->divisi) }}" required>
                            @error('divisi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan:</label>
                            <input id="keterangan" type="text" name="keterangan" value="{{ old('keterangan', $it->keterangan) }}">
                            <trix-editor class="form-control @error('keterangan') is-invalid @enderror" input="keterangan" required></trix-editor>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tglSurat" class="form-label">Tanggal:</label>
                            <input type="date" id="tglSurat" name="tglSurat" class="form-control @error('tglSurat') is-invalid @enderror" value="{{ old('tglSurat', $it->tglSurat) }}" required>
                            @error('tglSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ttd" class="form-label">Yang Menandatangani:</label>
                            <input type="text" id="ttd" name="ttd" class="form-control @error('ttd') is-invalid @enderror" value="{{ old('ttd', $it->ttd) }}" placeholder="Keuchik/Sekdes" required>
                            @error('ttd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="namaTtd" class="form-label">Nama Yang Menandatangani:</label>
                            <input type="text" id="namaTtd" name="namaTtd" class="form-control @error('namaTtd') is-invalid @enderror" value="{{ old('namaTtd', $it->namaTtd) }}" required>
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
@endsection
