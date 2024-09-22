@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Buat Surat Keterangan Marketing Sales Shipping</h6>
                    <form method="post" action="/dashboard/mss">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="kop" class="form-label">Pilih PT</label>
                            <select class="form-select @error('kop') is-invalid @enderror" id="kop" name="kop" required autofocus>
                                <option value="" disabled selected>Pilih PT</option>
                                <option value="GEL">GEL</option>
                                <option value="GSM">GSM</option>
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
                            </select>
                            <input type="hidden" id="perihal" name="perihal" value="{{ old('perihal') }}">
                            @error('idPerihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="perihalBA" style="display: none;">
                            <label for="perihalBA" class="form-label" >Perihal Berita Acara</label>
                            <select class="form-select @error('perihalBA') is-invalid @enderror" id="perihalBA" name="perihalBA" required autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Surat</option>
                                <option value="Surveyor">Berita Acara Surveyor</option>
                                <option value="Pembatalan PVR">Berita Acara Pembatalan PVR</option>
                                <option value="Pembatalan Keterlambatan Pengajuan PVR">Berita Acara Keterlambatan Pengajuan PVR</option>
                                <option value="Permohonan Revisi Invoice dan Pembatalan FP GEL">Permohonan Revisi Invoice dan Pembatalan FP GEL</option>
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
                                <input type="checkbox" id="toggleCIF" onclick="toggleField('cif')">
                                <label for="toggleCIF" class="form-label">Price Schemes CIF</label>
                                <br>
                                <input type="checkbox" id="toggleFOB" onclick="toggleField('fob')">
                                <label for="toggleFOB" class="form-label">Price Schemes FOB</label>
                                <br>
                                <input type="checkbox" id="toggleFREIGHT" onclick="toggleField('freight')">
                                <label for="toggleFREIGHT" class="form-label">Price Schemes FREIGHT</label>
                            </div>

                            <div class="mb-3 price-scheme-fields" id="cifField" style="display: none;">
                                <label for="cif" class="form-label">Price Scheme (CIF)</label>
                                <input type="number" class="form-control @error('cif') is-invalid @enderror" placeholder="CIF..." id="cif" name="cif" value="{{ old('cif') }}">
                                @error('cif')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="mb-3 price-scheme-fields" id="fobField" style="display: none;">
                                <label for="fob" class="form-label">Price Scheme (FOB)</label>
                                <input type="number" class="form-control @error('fob') is-invalid @enderror" placeholder="FOB..." id="fob" name="fob" value="{{ old('fob') }}">
                                @error('fob')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="mb-3 price-scheme-fields" id="freightField" style="display: none;">
                                <label for="freight" class="form-label">Price Scheme (FREIGHT)</label>
                                <input type="number" class="form-control @error('freight') is-invalid @enderror" placeholder="FREIGHT..." id="freight" name="freight" value="{{ old('freight') }}">
                                @error('freight')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <script>
                            function toggleField(fieldId) {
                                const field = document.getElementById(fieldId + 'Field');
                                const checkbox = document.getElementById('toggle' + fieldId.charAt(0).toUpperCase() + fieldId.slice(1));
                                field.style.display = checkbox.checked ? 'block' : 'none';
                            }
                            </script>




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
        const tglSuratInput = document.getElementById('tglSurat');

        const maxValues = {
            '1': {{ $maxNoSuratFCO }},
            '2': {{ $maxNoSuratSI }},
            '3': {{ $maxNoSuratBA }},
            '4': {{ $maxNoSuratTT }},
        };

        function setInitialNoSurat() {
            const currentType = perihalSelect.value;
            noSuratInput.value = (maxValues[currentType] || 0) + 1;
        }

        function updateVisibleFields() {
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
                    suratfcoGroups.forEach(group => group.style.display = 'none');
                    keteranganField.style.display = 'block';
                },
                '4': () => {
                    keteranganField.style.display = 'block';
                }
            };

            // Hide all fields first
            suratizinGroup.style.display = 'none';
            keteranganField.style.display = 'none';
            pttujuanClass.style.display = 'none';
            alamatClass.style.display = 'none';
            suratfcoGroups.forEach(group => group.style.display = 'none');

            // Show relevant fields based on selected value
            visibilityMap[perihalSelect.value]?.();
        }

        function updatePrefix() {
            const noSurat = String(noSuratInput.value || '0').padStart(3, '0');
            const tglSurat = new Date(tglSuratInput.value);
            const romanMonth = toRoman(tglSurat.getMonth() + 1);
            const year = tglSurat.getFullYear();
            let prefix;

            switch (perihalSelect.value) {
                case '1':
                    prefix = `Ref. No:MSS/GEL/FCO-${noSurat}/${romanMonth}/${year}`;
                    break;
                case '2':
                    prefix = `Ref. No:MSS/GEL/BA-${noSurat}/${romanMonth}/${year}`;
                    break;
                case '3':
                    prefix = `BA-${noSurat}/INV-SALES/${romanMonth}/${year}`;
                    break;
                case '4':
                    prefix = `Tanda Terima-${noSurat}/${romanMonth}/${year}`;
                    break;
                default:
                    prefix = '';
            }

            prefixInput.value = prefix;
            console.log(`Prefix updated to: ${prefix}`);
        }

        function toRoman(num) {
            const roman = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
            return roman[num - 1] || '';
        }

        // Event listeners
        [perihalSelect, tglSuratInput, noSuratInput].forEach(element => {
            element.addEventListener('change', () => {
                setInitialNoSurat();
                updateVisibleFields();
                updatePrefix();
            });
        });

        // Initialize
        setInitialNoSurat();
        updateVisibleFields();
        updatePrefix();
    });
</script>





@endsection
