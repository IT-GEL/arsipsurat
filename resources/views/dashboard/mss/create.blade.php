@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Buat Surat Keterangan Marketing Sales Shipping</h6>
                    <form method="post" action="/dashboard/mss">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal Surat</label>
                            <select class="form-select @error('perihal') is-invalid @enderror" id="perihal" name="perihal" required autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Surat</option>
                                <option value="Full Corporate Offer (FCO)">Full Corporate Offer</option>
                                <option value="Surat Izin Masuk Tambang">Surat Izin Masuk Tambang</option>
                            </select>
                            @error('perihal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat</label>
                            <input type="number" class="form-control @error('noSurat') is-invalid @enderror" id="noSurat" name="noSurat" placeholder="Urutan Nomor Surat Terbaru" required value="{{ old('noSurat') }}">
                            @error('noSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="surat-izin" class="mb-3" style="display: none;">
                            <label for="ptkunjungan" class="form-label">PT Kunjungan</label>
                            <input type="text" class="form-control @error('ptkunjungan') is-invalid @enderror" placeholder="Isi PT Kunjungan..."
                                id="ptkunjungan" name="ptkunjungan" required value="{{ old('ptkunjungan') }}">
                            @error('ptkunjungan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pttujuan" class="form-label">PT Tujuan</label>
                            <input type="text" class="form-control @error('pttujuan') is-invalid @enderror" placeholder="Isi PT Tujuan..."
                                id="pttujuan" name="pttujuan" required value="{{ old('pttujuan') }}">
                            @error('pttujuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat PT Tujuan</label>
                            <input id="alamat" type="hidden" name="alamat">
                            <trix-editor 
                                class="form-control @error('alamat') is-invalid @enderror" 
                                input="alamat" 
                                required 
                                value="{{ old('alamat') }}" 
                                placeholder="Alamat PT Tujuan">
                            </trix-editor>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="surat-izin" class="mb-3" style="display: none;">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input id="keterangan" type="hidden" name="keterangan">
                            <trix-editor 
                                class="form-control @error('keterangan') is-invalid @enderror" 
                                input="keterangan" 
                                required 
                                value="{{ old('keterangan') }}" 
                                placeholder="Isi Keterangan">
                            </trix-editor>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
 
                        <div id="surat-fco">
                            <div class="fco-field mb-3" style="display: none;">
                                <label for="commodity" class="form-label">Commodity</label>
                                <input type="text" class="form-control @error('commodity') is-invalid @enderror" placeholder="Commodity..."
                                    id="commodity" name="commodity" required value="{{ old('commodity') }}">
                                @error('commodity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="source" class="form-label">Source</label>
                                <input type="text" class="form-control @error('source') is-invalid @enderror" placeholder="Source..."
                                    id="source" name="source" required value="{{ old('source') }}">
                                @error('source')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="country" class="form-label">Country of Origin</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror" placeholder="Country..."
                                    id="country" name="country" required value="{{ old('country') }}">
                                @error('country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="spec" class="form-label">Typical Specification</label>
                                <input type="text" class="form-control @error('spec') is-invalid @enderror" placeholder="Specification..."
                                    id="spec" name="spec" required value="{{ old('spec') }}">
                                @error('spec')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="vo" class="form-label">Validity Offer</label>
                                <input type="date" class="form-control @error('vo') is-invalid @enderror" id="vo" name="vo" required value="{{ old('vo') }}">
                                @error('vo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="number" class="form-control @error('qty') is-invalid @enderror" placeholder="Quantity..."
                                    id="qty" name="qty" required value="{{ old('qty') }}">
                                @error('qty')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="lp" class="form-label">Loading Port</label>
                                <input type="text" class="form-control @error('lp') is-invalid @enderror" placeholder="Loading Port..."
                                    id="lp" name="lp" required value="{{ old('lp') }}">
                                @error('lp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="dp" class="form-label">Destination Port</label>
                                <input type="text" class="form-control @error('dp') is-invalid @enderror" placeholder="Destination Port..."
                                    id="dp" name="dp" required value="{{ old('dp') }}">
                                @error('dp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="cif" class="form-label">Price Scheme (CIF)</label>
                                <input type="number" class="form-control @error('cif') is-invalid @enderror" placeholder="CIF..."
                                    id="cif" name="cif" required value="{{ old('cif') }}">
                                @error('cif')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="fob" class="form-label">Price Scheme (FOB)</label>
                                <input type="number" class="form-control @error('fob') is-invalid @enderror" placeholder="FOB..."
                                    id="fob" name="fob" required value="{{ old('fob') }}">
                                @error('fob')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="freight" class="form-label">Price Scheme (FREIGHT)</label>
                                <input type="number" class="form-control @error('freight') is-invalid @enderror" placeholder="FREIGHT..."
                                    id="freight" name="freight" required value="{{ old('freight') }}">
                                @error('freight')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="shipschedule" class="form-label">Shipping Schedule</label>
                                <input type="date" class="form-control @error('shipschedule') is-invalid @enderror" id="shipschedule" name="shipschedule" required value="{{ old('shipschedule') }}">
                                @error('shipschedule')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="tcd" class="form-label">Term of Coal Delivery</label>
                                <input type="text" class="form-control @error('tcd') is-invalid @enderror" placeholder="Term of Coal Delivery..."
                                    id="tcd" name="tcd" required value="{{ old('tcd') }}">
                                @error('tcd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="surveyor" class="form-label">Surveyor</label>
                                <input type="text" class="form-control @error('surveyor') is-invalid @enderror" placeholder="Surveyor..."
                                    id="surveyor" name="surveyor" required value="{{ old('surveyor') }}">
                                @error('surveyor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                       
                        <div class="mb-3 mt-3">
                            <label for="tglSurat" class="form-label">Tanggal Surat</label>
                            <input type="date" class="form-control @error('tglSurat') is-invalid @enderror" id="tglSurat" name="tglSurat" required value="{{ old('tglSurat') }}">
                            @error('tglSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ttd" class="form-label">Yang Menandatangani</label>
                            <input type="text" class="form-control @error('ttd') is-invalid @enderror" id="ttd" name="ttd" placeholder="Departement Head" required value="{{ old('ttd') }}">
                            @error('ttd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaTtd" class="form-label">Nama Yang Menandatangani</label>
                            <input type="text" class="form-control @error('namaTtd') is-invalid @enderror" id="namaTtd" name="namaTtd" required value="{{ old('namaTtd') }}">
                            @error('namaTtd')
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
    </div>

    <!-- Add JavaScript to handle form visibility -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const perihalSelect = document.getElementById('perihal');
            const suratizinGroup = document.getElementById('surat-izin');
            const suratfcoGroups = document.querySelectorAll('#surat-fco .fco-field');

            function toggleFields() {
                const isSuratIzin = perihalSelect.value === 'Surat Izin Masuk Tambang';
                const isFco = perihalSelect.value === 'Full Corporate Offer (FCO)';

                suratizinGroup.style.display = isSuratIzin ? 'block' : 'none';
                suratfcoGroups.forEach(group => {
                    group.style.display = isFco ? 'block' : 'none';
                });
            }

            perihalSelect.addEventListener('change', toggleFields);
            // Initial check in case the form is pre-filled with old data
            toggleFields();
        });
    </script>
@endsection
