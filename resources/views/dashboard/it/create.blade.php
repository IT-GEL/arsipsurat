@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Buat Surat Keterangan IT</h6>
                <form method="post" action="/dashboard/it">
                    @csrf

                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal Surat</label>
                        <select class="form-select @error('perihal') is-invalid @enderror" id="perihal" name="perihal" required autofocus>
                            <option value="" disabled selected>Pilih Peruntukan Surat</option>
                            <option value="Pembuatan Akun Shared Folder JKT-DS">Pembuatan Akun Shared Folder JKT-DS</option>
                            <option value="Penutupan Akun Shared Folder JKT-DS">Penutupan Akun Shared Folder JKT-DS</option>
                            <option value="Pembuatan Akun Gelsys">Pembuatan Akun Gelsys</option>
                            <option value="Penutupan Akun Gelsys">Penutupan Akun Gelsys</option>
                        </select>
                        @error('perihal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="noSurat" class="form-label">Nomor Surat</label>
                        <input type="hidden" class="form-control @error('noSurat') is-invalid @enderror" id="noSurat" name="noSurat" required value="{{ old('noSurat') }}">
                        <input type="text" class="form-control" id="prefix" name="prefix" readonly>
                        @error('noSurat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama User</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Isi Nama..." id="nama" name="nama" required value="{{ old('nama') }}">
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan User</label>
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror" placeholder="Isi Jabatan..." id="jabatan" name="jabatan" required value="{{ old('jabatan') }}">
                        @error('jabatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="divisi" class="form-label">Divisi User</label>
                        <input type="text" class="form-control @error('divisi') is-invalid @enderror" placeholder="Isi Divisi..." id="divisi" name="divisi" required value="{{ old('divisi') }}">
                        @error('divisi')
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

                            });
                        </script>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="tglSurat" class="form-label">Tanggal</label>
                        <input type="date" class="form-control @error('tglSurat') is-invalid @enderror" id="tglSurat" name="tglSurat" required value="{{ old('tglSurat') }}">
                        @error('tglSurat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
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
                            perihalSelect.addEventListener('change', function () {
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
                        <input type="text" class="form-control @error('ttd') is-invalid @enderror" id="ttd" name="ttd" placeholder="Departement Head" required value="{{ old('ttd') }}">
                        @error('ttd')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="namaTtd" class="form-label">Nama Yang Menandatangani</label>
                        <input type="text" class="form-control @error('namaTtd') is-invalid @enderror" id="namaTtd" name="namaTtd" required value="{{ old('namaTtd') }}">
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
@endsection
