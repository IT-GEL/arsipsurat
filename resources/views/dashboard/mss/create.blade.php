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
                                <option value="GCR">GCR</option>
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
                                <option value="6">Letter of Intent</option>
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

                        <div id="att" class="mb-3" style="display: none;">
                            <label for="att" class="form-label">Ditujukan Kepada</label>
                            <input type="text" class="form-control @error('att') is-invalid @enderror" placeholder="Ditujukan Kepada..." id="att" name="att" value="{{ old('att') }}">
                            @error('att')
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
                            <div class="fco-field mb-3" style="display: none;" id="commodity">
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

                            <div class="fco-field mb-3" style="display: none;" id="country">
                                <label for="country" class="form-label">Country of Origin</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror" placeholder="Country..." id="country" name="country" value="{{ old('country') }}">
                                @error('country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="fco-field mb-3" style="display: none;" id="spec">
                                <label for="spec" class="form-label">
                                    Typical Specification
                                </label>
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

                            <div class="fco-field mb-3" style="display: none;" id="qty">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="number" class="form-control @error('qty') is-invalid @enderror" placeholder="Quantity..." id="qty" name="qty" value="{{ old('qty') }}">
                                @error('qty')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="loi-field mb-3" style="display: none;" id="delivery_basis">
                                <label for="delivery_basis" class="form-label">Delivery Basis</label>
                                <input type="text" class="form-control @error('delivery_basis') is-invalid @enderror" placeholder="Delivery Basis..." id="delivery_basis" name="delivery_basis" value="{{ old('delivery_basis') }}">
                                @error('delivery_basis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="loi-field mb-3" style="display: none;" id="contract_dur">
                                <label for="contract_dur" class="form-label">Contract Duration</label>
                                <input type="text" class="form-control @error('contract_dur') is-invalid @enderror" placeholder="Contract Duration..." id="contract_dur" name="contract_dur" value="{{ old('contract_dur') }}">
                                @error('contract_dur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="loi-field mb-3" style="display: none;" id="po">
                                <label for="po" class="form-label">Price Offered</label>
                                <input type="text" class="form-control @error('po') is-invalid @enderror" placeholder="Price Offered..." id="po" name="po" value="{{ old('po') }}">
                                @error('po')
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
        const att = document.getElementById('att');
        const alamatClass = document.getElementById('alamatClass');
        const suratfcoGroups = document.querySelectorAll('#surat-fco .fco-field');
        const prefixInput = document.getElementById('prefix');
        const tglSuratInput = document.getElementById('tglSurat');
        const BAClass = document.getElementById('perihalBAClass');
        const suratLOIGroups = document.querySelectorAll('#surat-fco .loi-field');

        const maxValues = {
            '1': {{ $maxNoSuratFCO }},
            '2': {{ $maxNoSuratSI }},
            '3': {{ $maxNoSuratBA }},
            '4': {{ $maxNoSuratTT }},
            '5': {{ $maxNoSuratRIPFP }},
            '6': {{ $maxNoSuratLOI }},
        };

        const PADDING_LENGTH = 3;

        const visibilityMap = {
            '1': () => {
                showFields(suratfcoGroups);
                showFields([pttujuanClass, alamatClass]);
            },
            '2': () => {
                showFields([suratizinGroup, keteranganField, pttujuanClass, alamatClass]);
            },
            '3': () => {
                showFields([keteranganField, BAClass]);
            },
            '4': () => showFields([keteranganField]),
            '5': () => showFields([keteranganField]),
            '6': () => {
                showFields([
                    ...suratLOIGroups,
                    pttujuanClass,
                    alamatClass,
                    att,
                    keteranganField,
                    document.getElementById('commodity'),
                    document.getElementById('qty'),
                    document.getElementById('country'),
                    document.getElementById('spec')
                ]);
            }
        };

        function showFields(elements) {
            elements.forEach(el => {
                if (el instanceof HTMLElement) {
                    el.style.display = 'block';
                } else if (typeof el === 'string') {
                    const element = document.getElementById(el);
                    if (element) {
                        element.style.display = 'block';
                    } else {
                        console.warn(`Element with ID '${el}' not found.`);
                    }
                }
            });
        }

        function hideFields(elements) {
            elements.forEach(el => {
                if (el instanceof HTMLElement) {
                    el.style.display = 'none';
                } else if (typeof el === 'string') {
                    const element = document.getElementById(el);
                    if (element) {
                        element.style.display = 'none';
                    }
                }
            });
        }

        function hideAllFields() {
            hideFields([suratizinGroup, keteranganField, pttujuanClass, alamatClass, BAClass, att]);
            suratfcoGroups.forEach(group => {
                if (group) group.style.display = 'none';
            });
        }

        function setInitialNoSurat() {
            const currentType = perihalSelect.value;
            noSuratInput.value = (maxValues[currentType] || 0) + 1;
        }

        function updateVisibleFields() {
            hideAllFields();
            visibilityMap[perihalSelect.value]?.();
        }

        function toggleField(fieldId) {
            const field = document.getElementById(fieldId + 'Field');
            if (field) {
                field.style.display = field.style.display === 'block' ? 'none' : 'block';
            }
        }

        ['CIF', 'FOB', 'FREIGHT'].forEach(type => {
            document.getElementById('toggle' + type).addEventListener('click', () => toggleField(type.toLowerCase()));
        });

        perihalSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            const perihalInput = document.getElementById('perihal');

            const perihalMap = {
                '1': 'Full Corporate Offer',
                '2': 'Surat Izin Masuk Tambang',
                '3': 'Berita Acara',
                '4': 'Tanda Terima',
                '5': 'Permohonan Revisi Invoice dan Pembatalan FP GEL',
                '6': 'Letter of Intent (LOI) for Coal Purchase in'
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
                '5': `${year}/GEL-PLN/SAL-${noSurat}`,
                '6': `No: MSS/GEL/LOI-${noSurat}/${romanMonth}/${year}/`
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

        [perihalSelect, tglSuratInput, noSuratInput].forEach(element => {
            element.addEventListener('change', handleFieldUpdates);
        });

        // Initialize
        handleFieldUpdates();
    });


    </script>









@endsection
