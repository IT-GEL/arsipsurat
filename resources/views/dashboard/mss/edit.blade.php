@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Surat Keterangan Marketing Sales Shipping</h6>
                    
                    <form method="post" action="/dashboard/mss/{{ $mss->id }}">
                    
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal Surat:</label>
                            <span style="font-weight:bold;">{{ old('perihal', $mss->perihal) }}</span>
                            <input type="hidden" id="perihal" name="perihal" class="form-control @error('perihal') is-invalid @enderror" value="{{ old('perihal', $mss->perihal) }}" required>
                            <input type="hidden" id="idPerihal" name="idPerihal" class="form-control @error('idPerihal') is-invalid @enderror" value="{{ old('idPerihal', $mss->idPerihal) }}" required>
                            @error('perihal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat:</label>
                            <span style="font-weight:bold;">MSS/{{ old('noSurat', $mss->noSurat) }}/GELJKT/{{ $romanMonth }}/2024</span>
                            <input type="hidden" id="noSurat" name="noSurat" value="{{ old('noSurat', $mss->noSurat) }}" class="form-control @error('noSurat') is-invalid @enderror">
                            @error('noSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="surat-izin" class="mb-3" style="display: none;">
                            <label for="ptkunjungan" class="form-label">PT Kunjungan</label>
                            <input type="text" class="form-control @error('ptkunjungan') is-invalid @enderror" placeholder="Isi PT Kunjungan..." id="ptkunjungan" name="ptkunjungan" value="{{ old('ptkunjungan', $mss->ptkunjungan) }}">
                            @error('ptkunjungan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>

                        <div id="pttujuanClass" class="mb-3">
                            <label for="pttujuan" class="form-label">PT Tujuan</label>
                            <input type="text" class="form-control @error('pttujuan') is-invalid @enderror" placeholder="Isi PT Tujuan..." id="pttujuan" name="pttujuan" value="{{ old('pttujuan', $mss->pttujuan) }}">
                            @error('pttujuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        
                        <div id="alamatClass"class="mb-3">
                            <label for="alamat" class="form-label">Alamat PT Tujuan</label>
                            <input id="alamat" type="hidden" name="alamat" value="{{ old('alamat', $mss->alamat)}}">
                            <trix-editor class="form-control @error('alamat') is-invalid @enderror" input="alamat" placeholder="Alamat PT Tujuan"></trix-editor>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="keterangan-field" class="mb-3" style="display: none;">
                            <label for="keterangan" class="form-label">Isi Surat / Keterangan</label>
                            <input type="hidden" id="keterangan" name="keterangan" value="{{ old('keterangan', $mss->keterangan)}}">
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const keteranganValue = document.getElementById('keterangan').value;
                                    const keteranganEditor = Jodit.make('#keterangan', {
                                        value: keteranganValue // Set the initial value here
                                    });
                                });
                            </script>
                        </div>

 
                        <div id="surat-fco">
                            <div class="fco-field mb-3" style="display: none;">
                                <label for="commodity" class="form-label">Commodity</label>
                                <input type="text" class="form-control @error('commodity') is-invalid @enderror" placeholder="Commodity..." id="commodity" name="commodity" value="{{ old('commodity', $mss->commodity) }}">
                                @error('commodity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="source" class="form-label">Source</label>
                                <input type="text" class="form-control @error('source') is-invalid @enderror" placeholder="Source..." id="source" name="source" value="{{ old('source', $mss->source) }}">
                                @error('source')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="country" class="form-label">Country of Origin</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror" placeholder="Country..." id="country" name="country" value="{{ old('country', $mss->country) }}">
                                @error('country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="spec" class="form-label">Typical Specification</label>
                                <input type="text" class="form-control @error('spec') is-invalid @enderror" placeholder="Specification..." id="spec" name="spec" value="{{ old('spec', $mss->spec) }}">
                                @error('spec')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="vo" class="form-label">Validity Offer</label>
                                <input type="date" class="form-control @error('vo') is-invalid @enderror" id="vo" name="vo" value="{{ old('vo', $mss->vo) }}">
                                @error('vo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="number" class="form-control @error('qty') is-invalid @enderror" placeholder="Quantity..." id="qty" name="qty" value="{{ old('qty', $mss->qty) }}">
                                @error('qty')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="lp" class="form-label">Loading Port</label>
                                <input type="text" class="form-control @error('lp') is-invalid @enderror" placeholder="Loading Port..." id="lp" name="lp" value="{{ old('lp', $mss->lp) }}">
                                @error('lp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="dp" class="form-label">Destination Port</label>
                                <input type="text" class="form-control @error('dp') is-invalid @enderror" placeholder="Destination Port..." id="dp" name="dp" value="{{ old('dp', $mss->dp) }}">
                                @error('dp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="cif" class="form-label">Price Scheme (CIF)</label>
                                <input type="number" class="form-control @error('cif') is-invalid @enderror" placeholder="CIF..." id="cif" name="cif" value="{{ old('cif', $mss->cif) }}">
                                @error('cif')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="fob" class="form-label">Price Scheme (FOB)</label>
                                <input type="number" class="form-control @error('fob') is-invalid @enderror" placeholder="FOB..." id="fob" name="fob" value="{{ old('fob', $mss->fob) }}">
                                @error('fob')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="freight" class="form-label">Price Scheme (FREIGHT)</label>
                                <input type="number" class="form-control @error('freight') is-invalid @enderror" placeholder="FREIGHT..." id="freight" name="freight" value="{{ old('freight', $mss->freight) }}">
                                @error('freight')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="shipschedule" class="form-label">Shipping Schedule</label>
                                <input type="date" class="form-control @error('shipschedule') is-invalid @enderror" id="shipschedule" name="shipschedule" value="{{ old('shipschedule', $mss->shipschedule) }}">
                                @error('shipschedule')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="tcd" class="form-label">Term of Coal Delivery</label>
                                <input type="text" class="form-control @error('tcd') is-invalid @enderror" placeholder="Term of Coal Delivery..." id="tcd" name="tcd" value="{{ old('tcd', $mss->tcd) }}">
                                @error('tcd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="surveyor" class="form-label">Surveyor</label>
                                <input type="text" class="form-control @error('surveyor') is-invalid @enderror" placeholder="Surveyor..." id="surveyor" name="surveyor" value="{{ old('surveyor', $mss->surveyor) }}">
                                @error('surveyor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="tglSurat" class="form-label">Tanggal Buat Surat</label>
                            <input type="date" class="form-control @error('tglSurat') is-invalid @enderror" id="tglSurat" name="tglSurat" required value="{{ old('tglSurat', $mss->tglSurat) }}" readonly>
                            @error('tglSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ttd" class="form-label">TTD Yang Membuat</label>
                            <input type="text" class="form-control @error('ttd') is-invalid @enderror" id="ttd" name="ttd" required value="{{ old('ttd', $mss->ttd) }}" readonly>
                            @error('ttd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="namaTtd" class="form-label">Mengetahui</label>
                            <input type="text" class="form-control @error('namaTtd') is-invalid @enderror" id="namaTtd" name="namaTtd" required value="{{ old('namaTtd', $mss->namaTtd) }}">
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

    <!-- Add JavaScript to handle form visibility -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const idPerihal = document.getElementById('idPerihal');
        const suratizinGroup = document.getElementById('surat-izin');
        const keteranganField = document.getElementById('keterangan-field');
        const pttujuanClass = document.getElementById('pttujuanClass');
        const alamatClass = document.getElementById('alamatClass');
        const suratfcoGroups = document.querySelectorAll('#surat-fco .fco-field');

        function toggleFields() {
            // Reset all fields to hidden first
            suratizinGroup.style.display = 'none';
            keteranganField.style.display = 'none';
            pttujuanClass.style.display = 'none';
            alamatClass.style.display = 'none';
            suratfcoGroups.forEach(group => group.style.display = 'none');

            switch (idPerihal.value) {
                case '1':
                    // Show fields specific to FCO
                    suratfcoGroups.forEach(group => group.style.display = 'block');
                    pttujuanClass.style.display = 'block';
                    alamatClass.style.display = 'block';
                    break;
                case '2':
                    suratizinGroup.style.display = 'block';
                    keteranganField.style.display = 'block';
                    pttujuanClass.style.display = 'block';
                    alamatClass.style.display = 'block';
                    break;
                case '3':
                case '4':
                    keteranganField.style.display = 'block';
                    break;
                // Add more cases if needed for other perihal options
                default:
                    // Optionally handle other cases or reset fields
                    break;
            }
        }

        // Initialize field visibility
        toggleFields();

        // Add event listener to handle changes
        idPerihal.addEventListener('change', toggleFields);
    });
</script>

@endsection

