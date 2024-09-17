@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Surat Keterangan Marketing Sales Shipping</h6>
                    
                    <form method="post" action="/dashboard/mss/{{ $mss->noSurat }}">
                    
                        @csrf
                        @method('put')
                        
                         <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal Surat : </label>
                            <label style="font-weight:bold;">{{ old('perihal', $mss->perihal) }}</label>
                            <input type="hidden" value="{{ old('perihal', $mss->perihal) }}">
                        </div>

                
                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat: :</label>
                            <input type="number" value="{{ old('noSurat', $mss->noSurat) }}"  class="form-control @error('noSurat') is-invalid @enderror" id="noSurat" name="noSurat"  hidden>
                            <label style="font-weight:bold;">Ref. No:MSS/GEL/BA-{{ old('noSurat', $mss->noSurat) }}/{{ $romanMonth }}/2024</label>
                        </div>
                        <div class="mb-3">
                            <label for="pttujuan" class="form-label">PT Tujuan</label>
                            <input type="text" value="{{ old('pttujuan', $mss->pttujuan) }}" class="form-control @error('pttujuan') is-invalid @enderror"
                                id="pttujuan" name="pttujuan" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat PT Tujuan</label>
                            <input id="alamat" type="hidden" name="alamat" value="{{ old('alamat', $mss->alamat) }}">
                            <trix-editor class="form-control @error('alamat') is-invalid @enderror" input="alamat" required></trix-editor>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br>
                        </div>
                        <div class="mb-3">
                            <label for="commodity" class="form-label">Commodity</label>
                            <input type="text" class="form-control @error('commodity') is-invalid @enderror" value="{{ old('commodity', $mss->commodity) }}"
                                id="commodity" name="commodity" required >
                            @error('commodity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="source" class="form-label">Source</label>
                            <input type="text" class="form-control @error('source') is-invalid @enderror" value="{{ old('source', $mss->source) }}"
                                id="source" name="source" required >
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country of Origin</label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" value="{{ old('country', $mss->country) }}"
                                id="country" name="country" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="spec" class="form-label">Typical Specification</label>
                            <input type="text" class="form-control @error('spec') is-invalid @enderror"
                                id="spec" name="spec" required value="{{ old('spec', $mss->spec) }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="vo" class="form-label">Validity Offer</label>
                            <input type="date" class="form-control @error('vo') is-invalid @enderror" id="vo" name="vo" value="{{ old('vo', $mss->vo) }}" required>
                            @error('vo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label">Quantity</label>
                            <input type="number" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty', $mss->qty) }}" required
                                id="qty" name="qty">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lp" class="form-label">Loading Port</label>
                            <input type="text" class="form-control @error('lp') is-invalid @enderror" value="{{ old('lp', $mss->lp) }}"
                                id="lp" name="lp" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dp" class="form-label">Destination Port</label>
                            <input type="text" class="form-control @error('dp') is-invalid @enderror"
                                id="dp" name="dp" value="{{ old('dp', $mss->dp) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cif" class="form-label">Price Scheme (CIF)</label>
                            <input type="number" class="form-control @error('cif') is-invalid @enderror" required value="{{ old('cif', $mss->cif) }}"
                                id="cif" name="cif">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fob" class="form-label">Price Scheme (FOB)</label>
                            <input type="number" class="form-control @error('fob') is-invalid @enderror" required value="{{ old('fob', $mss->fob) }}"
                                id="fob" name="fob">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="freight" class="form-label">Price Scheme (FREIGHT)</label>
                            <input type="number" class="form-control @error('freight') is-invalid @enderror" required value="{{ old('freight', $mss->freight) }}"
                                id="freight" name="freight">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="shipschedule" class="form-label">Shipping Schedule</label>
                            <input type="date" class="form-control @error('shipschedule') is-invalid @enderror" required id="shipschedule" name="shipschedule" value="{{ old('shipschedule', $mss->shipschedule) }}">
                            @error('shipschedule')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tcd" class="form-label">Term of Coal Delivery</label>
                            <input type="text" class="form-control @error('tcd') is-invalid @enderror" value="{{ old('tcd', $mss->tcd) }}"
                                id="tcd" name="tcd" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="surveyor" class="form-label">Surveyor</label>
                            <input type="text" class="form-control @error('surveyor') is-invalid @enderror" value="{{ old('surveyor', $mss->surveyor) }}"
                                id="surveyor" name="surveyor" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                       
                        <div class="mb-3 mt-3">
                            <label for="tglSurat" class="form-label">Tanggal Surat</label>
                            <input type="date" class="form-control @error('tglSurat') is-invalid @enderror" id="tglSurat" name="tglSurat" required value="{{ old('tglSurat', $mss->tglSurat) }}">
                            @error('tglSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ttd" class="form-label">Yang Menandatangai</label>
                            <input type="text" class="form-control @error('ttd') is-invalid @enderror" id="ttd" name="ttd" placeholder="Departement Head" required value="{{ old('ttd'), $mss->ttd }}">
                            @error('ttd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaTtd" class="form-label">Nama Yang Menandatangai</label>
                            <input type="text" class="form-control @error('namaTtd') is-invalid @enderror" id="namaTtd" name="namaTtd" required value="{{ old('namaTtd'), $mss->namaTtd }}">
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

