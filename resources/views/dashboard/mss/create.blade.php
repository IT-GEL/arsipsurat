@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Buat Surat Keterangan Marketing Sales Shipping</h6>
                    <form method="post" action="/dashboard/mss">
                        @csrf

                        <input type="hidden" id="approve" name="approve" value="0">
                        
                        <div class="mb-3">
                            <label for="kop" class="form-label">Pilih PT</label>
                            <select class="form-select @error('kop') is-invalid @enderror" id="kop" name="kop" required autofocus>
                                <option value="" disabled selected>Pilih PT</option>
                                <option value="GEL">GEL</option>
                                <option value="QIN">QIN</option>
                                <option value="ERA">ERA</option>
                            </select>
                            @error('kop')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idPerihal" class="form-label">Perihal Surat</label>
                            <select class="form-select @error('idPerihal') is-invalid @enderror" id="idPerihal" name="idPerihal" required autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Surat</option>
                                <option value="1">Full Corporate Offer</option>
                                <option value="2">Surat Izin Masuk Tambang</option>
                                <option value="3">Berita Acara</option>
                                <option value="4">Tanda Terima</option>
                                <option value="5">Permohonan Revisi Invoice dan Pembatalan FP GEL</option>
                            </select>
                            <input type="hidden" id="perihal" name="perihal" value="{{ old('perihal') }}">
                            @error('idPerihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="perihalBAClass" style="display: none;">
                            <label for="perihalBA" class="form-label" >Perihal Berita Acara</label>
                            <select class="form-select @error('perihalBA') is-invalid @enderror" id="perihalBA" name="perihalBA">
                                <option value="" disabled selected>Pilih Berita Acara</option>
                                <option value="Surveyor">Berita Acara Surveyor</option>
                                <option value="Pembatalan PVR">Berita Acara Pembatalan PVR</option>
                                <option value="Keterlambatan Pengajuan PVR">Berita Acara Keterlambatan Pengajuan PVR</option>
                                <option value="Kegiatan Cleaning Batubara">Berita Acara Kegiatan Cleaning Batubara</option>
                            </select>
                            @error('perihalBA')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat</label>
                            <input type="hidden" class="form-control @error('noSurat') is-invalid @enderror" id="noSurat" name="noSurat" placeholder="Urutan Nomor Surat Terbaru" required value="{{ old('noSurat') }}">
                            <br>
                            <input type="text" class="form-control" id="prefix" name="prefix" readonly>
                            @error('noSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div id="surat-izin" class="mb-3" style="display: none;">
                            <label for="ptkunjungan" class="form-label">PT Kunjungan</label>
                            <input type="text" class="form-control @error('ptkunjungan') is-invalid @enderror" placeholder="Isi PT Kunjungan..." id="ptkunjungan" name="ptkunjungan" value="{{ old('ptkunjungan') }}">
                            @error('ptkunjungan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>

                        <div id="pttujuanClass" class="mb-3">
                            <label for="pttujuan" class="form-label">PT Tujuan</label>
                            <input type="text" class="form-control @error('pttujuan') is-invalid @enderror" placeholder="Isi PT Tujuan..." id="pttujuan" name="pttujuan" value="{{ old('pttujuan') }}">
                            @error('pttujuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        
                        <div id="alamatClass"class="mb-3">
                            <label for="alamat" class="form-label">Alamat PT Tujuan</label>
                            <input id="alamat" type="hidden" name="alamat">
                            <trix-editor class="form-control @error('alamat') is-invalid @enderror" input="alamat" value="{{ old('alamat') }}" placeholder="Alamat PT Tujuan"></trix-editor>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="keterangan-field" class="mb-3" style="display: none;">
                        <label for="keterangan" class="form-label">Isi Surat / Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"></textarea>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const keterangan = Jodit.make('#keterangan');
                                });
                            </script>
                        </div>
 
                        <div id="surat-fco">
                            <div class="fco-field mb-3" style="display: none;">
                                <label for="commodity" class="form-label">Commodity</label>
                                <input type="text" class="form-control @error('commodity') is-invalid @enderror" placeholder="Commodity..." id="commodity" name="commodity" value="{{ old('commodity') }}">
                                @error('commodity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="source" class="form-label">Source</label>
                                <input type="text" class="form-control @error('source') is-invalid @enderror" placeholder="Source..." id="source" name="source" value="{{ old('source') }}">
                                @error('source')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="country" class="form-label">Country of Origin</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror" placeholder="Country..." id="country" name="country" value="{{ old('country') }}">
                                @error('country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="spec" class="form-label">Typical Specification</label>
                                <input type="text" class="form-control @error('spec') is-invalid @enderror" placeholder="Specification..." id="spec" name="spec" value="{{ old('spec') }}">
                                @error('spec')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="vo" class="form-label">Validity Offer</label>
                                <input type="date" class="form-control @error('vo') is-invalid @enderror" id="vo" name="vo" value="{{ old('vo') }}">
                                @error('vo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="number" class="form-control @error('qty') is-invalid @enderror" placeholder="Quantity..." id="qty" name="qty" value="{{ old('qty') }}">
                                @error('qty')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="lp" class="form-label">Loading Port</label>
                                <input type="text" class="form-control @error('lp') is-invalid @enderror" placeholder="Loading Port..." id="lp" name="lp" value="{{ old('lp') }}">
                                @error('lp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="dp" class="form-label">Destination Port</label>
                                <input type="text" class="form-control @error('dp') is-invalid @enderror" placeholder="Destination Port..." id="dp" name="dp" value="{{ old('dp') }}">
                                @error('dp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3">
                                <label for="matauang" class="form-label" >Pilih Mata Uang Price Schemes</label>
                                <select class="form-select @error('matauang') is-invalid @enderror" id="matauang" name="matauang">
                                    <option value="" disabled selected>Pilih Mata Uang</option>
                                    <option value="IDR">Rupiah</option>
                                    <option value="DOLLAR">Dollar</option>
                                </select>
                            </div>

                            <div class="fco-field mb-3">
                                <label for="toggle" class="form-label" >Price Schemes</label>
                                <br>
                                    <button id="toggleCIF" class="toggle-button btn btn-primary">CIF</button>
                                    <button id="toggleFOB" class="toggle-button btn btn-primary">FOB</button>
                                    <button id="toggleFREIGHT" class="toggle-button btn btn-primary">Freight</button>
                            </div>


                            <div class="mb-3 price-scheme-fields" id="cifField" style="display: none;">
                                <label for="cif" class="form-label">Price Scheme (CIF)</label>
                                <input type="number" class="form-control" placeholder="CIF..." id="cif" name="cif">
                            </div>

                            <div class="mb-3 price-scheme-fields" id="fobField" style="display: none;">
                                <label for="fob" class="form-label">Price Scheme (FOB)</label>
                                <input type="number" class="form-control" placeholder="FOB..." id="fob" name="fob">
                            </div>

                            <div class="mb-3 price-scheme-fields" id="freightField" style="display: none;">
                                <label for="freight" class="form-label">Price Scheme (FREIGHT)</label>
                                <input type="number" class="form-control" placeholder="FREIGHT..." id="freight" name="freight">
                            </div>      

                            


                            <div class="fco-field mb-3" style="display: none;">
                                <label for="shipschedule" class="form-label">Shipping Schedule</label>
                                <input type="date" class="form-control @error('shipschedule') is-invalid @enderror" id="shipschedule" name="shipschedule" value="{{ old('shipschedule') }}">
                                @error('shipschedule')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="tcd" class="form-label">Term of Coal Delivery</label>
                                <input type="text" class="form-control @error('tcd') is-invalid @enderror" placeholder="Term of Coal Delivery..." id="tcd" name="tcd" value="{{ old('tcd') }}">
                                @error('tcd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="surveyor" class="form-label">Surveyor</label>
                                <input type="text" class="form-control @error('surveyor') is-invalid @enderror" placeholder="Surveyor..." id="surveyor" name="surveyor" value="{{ old('surveyor') }}">
                                @error('surveyor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="qas" class="form-label">Quality and Specification</label>
                                <textarea id="qas" name="qas" class="form-control @error('qas') is-invalid @enderror"></textarea>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const qas = Jodit.make('#qas');
                                        });
                                    </script>
                            </div>

                            <div class="fco-field mb-3" style="display: none;">
                                <label for="top" class="form-label">Term of Payment</label>
                                <input type="text" class="form-control @error('top') is-invalid @enderror" placeholder="Term of Payment..." id="top" name="top" value="{{ old('top') }} ">
                                    <div class="invalid-feedback">
                                @error('top')
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

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var today = new Date().toISOString().split('T')[0];
                                document.getElementById('tglSurat').value = today;
                            });
                        </script>

                        <div class="mb-3">
                            <label for="ttd" class="form-label">TTD Yang Membuat</label>
                            <input type="text" class="form-control @error('ttd') is-invalid @enderror" id="ttd" name="ttd" required value="{{ old('ttd') }}">
                            @error('ttd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="namaTtd" class="form-label">Mengetahui</label>
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
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const perihalSelect = document.getElementById('idPerihal');
    const noSuratInput = document.getElementById('noSurat');
    const suratizinGroup = document.getElementById('surat-izin');
    const keteranganField = document.getElementById('keterangan-field');
    const pttujuanClass = document.getElementById('pttujuanClass');
    const alamatClass = document.getElementById('alamatClass');
    const suratfcoGroups = document.querySelectorAll('#surat-fco .fco-field');
    const prefixInput = document.getElementById('prefix');
    const tglSuratInput = document.getElementById('tglSurat');
    const BAClass = document.getElementById('perihalBAClass');

    // Max values for surat numbers
    const maxValues = {
        '1': {{ $maxNoSuratFCO }},
        '2': {{ $maxNoSuratSI }},
        '3': {{ $maxNoSuratBA }},
        '4': {{ $maxNoSuratTT }},
        '5': {{ $maxNoSuratRIPFP }},
    };

    const PADDING_LENGTH = 3;

    function setInitialNoSurat() {
        const currentType = perihalSelect.value;
        noSuratInput.value = (maxValues[currentType] || 0) + 1;
    }

    function updateVisibleFields() {
        // Hide all fields first
        [suratizinGroup, keteranganField, pttujuanClass, alamatClass, BAClass].forEach(el => el.style.display = 'none');
        suratfcoGroups.forEach(group => group.style.display = 'none');

        const visibilityMap = {
            '1': () => {
                suratfcoGroups.forEach(group => group.style.display = 'block');
                pttujuanClass.style.display = 'block';
                alamatClass.style.display = 'block';
            },
            '2': () => {
                suratizinGroup.style.display = 'block';
                keteranganField.style.display = 'block';
                pttujuanClass.style.display = 'block';
                alamatClass.style.display = 'block';
            },
            '3': () => {
                keteranganField.style.display = 'block';
                BAClass.style.display = 'block';
            },
            '4': () => keteranganField.style.display = 'block',
            '5': () => keteranganField.style.display = 'block'
        };

        // Show relevant fields based on selected value
        visibilityMap[perihalSelect.value]?.();
    }

    function toggleField(fieldId) {
            const field = document.getElementById(fieldId + 'Field');
            const isVisible = field.style.display === 'block';
            field.style.display = isVisible ? 'none' : 'block';
        }

        // Event listeners for buttons
        document.getElementById('toggleCIF').addEventListener('click', () => toggleField('cif'));
        document.getElementById('toggleFOB').addEventListener('click', () => toggleField('fob'));
        document.getElementById('toggleFREIGHT').addEventListener('click', () => toggleField('freight'));

    // Event listeners for checkboxes
    ['CIF', 'FOB', 'FREIGHT'].forEach(type => {
        document.getElementById('toggle' + type).addEventListener('change', () => toggleField(type.toLowerCase()));
    });

    perihalSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        const perihalInput = document.getElementById('perihal');

        // Set perihalInput based on selected value
        const perihalMap = {
            '1': 'Full Corporate Offer',
            '2': 'Surat Izin Masuk Tambang',
            '3': 'Berita Acara',
            '4': 'Tanda Terima',
            '5': 'Permohonan Revisi Invoice dan Pembatalan FP GEL'
        };
        perihalInput.value = perihalMap[selectedValue] || '';

        handleFieldUpdates();
    });

    function updatePrefix() {
        const noSurat = String(noSuratInput.value || '0').padStart(PADDING_LENGTH, '0');
        const tglSurat = new Date(tglSuratInput.value);
        const romanMonth = toRoman(tglSurat.getMonth() + 1);
        const year = tglSurat.getFullYear();
        
        const prefixMap = {
            '1': `Ref. No:MSS/GEL/FCO-${noSurat}/${romanMonth}/${year}`,
            '2': `Ref. No:MSS/GEL/BA-${noSurat}/${romanMonth}/${year}`,
            '3': `BA-${noSurat}/INV-SALES/${romanMonth}/${year}`,
            '4': `Tanda Terima-${noSurat}/${romanMonth}/${year}`,
            '5': `${year}/GEL-PLN/SAL-${noSurat}`
        };
        
        prefixInput.value = prefixMap[perihalSelect.value] || '';
    }

    function toRoman(num) {
        const roman = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
        return roman[num - 1] || '';
    }

    function handleFieldUpdates() {
        setInitialNoSurat();
        updateVisibleFields();
        updatePrefix();
    }

    // Event listeners for input changes
    [perihalSelect, tglSuratInput, noSuratInput].forEach(element => {
        element.addEventListener('change', handleFieldUpdates);
    });

    // Initialize
    handleFieldUpdates();
});
</script>






@endsection
