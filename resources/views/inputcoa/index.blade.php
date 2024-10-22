@extends('dashboard.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css">
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 mx-auto p-4" style="width: 210mm;">
                    <h6 class="mb-4">Buat Surat Keterangan Finnace AP</h6>
                    <form method="post" action="/dashboard/finap">
                        @csrf


                        <div class="mb-3">
                            <label for="coa" class="form-label">COA</label>
                            <input type="text" class="form-control @error('coa') is-invalid @enderror" id="coa"
                                name="vendor" required value="{{ old('coa') }}">
                            @error('coa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="vendor" class="form-label">Vendor</label>
                            <input type="text" class="form-control @error('vendor') is-invalid @enderror" id="vendor"
                                name="vendor" required value="{{ old('vendor') }}">
                            @error('vendor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="departement" class="form-label">Departement</label>
                            <input type="text" class="form-control @error('departement') is-invalid @enderror" id="departement"
                                name="departement" required value="{{ old('departement') }}">
                            @error('departement')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="cicilanDari" class="form-label">Cicilan Ke</label>
                                <input type="text" class="form-control @error('cicilanDari') is-invalid @enderror" id="cicilanDari" placeholder="Contoh : '12'"
                                    name="cicilanDari" required value="{{ old('cicilanDari') }}">
                                @error('cicilanDari')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="cicilanSampai" class="form-label">Cicilan Dari</label>
                                <input type="text" class="form-control @error('cicilanSampai') is-invalid @enderror" id="cicilanSampai" placeholder="Contoh : '27'"
                                    name="cicilanSampai" required value="{{ old('cicilanSampai') }}">
                                @error('cicilanSampai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="pembayaranAtas" class="form-label">Pembayaran Atas</label>
                            <input type="text" class="form-control @error('pembayaranAtas') is-invalid @enderror" id="pembayaranAtas" placeholder="Contoh: 2 Unit TRITON DOUBLE CABIN"
                                name="pembayaranAtas" required value="{{ old('pembayaranAtas') }}">
                            @error('pembayaranAtas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="keterangan" class="form-label">Daftar Pembayaran</label>
                        <div id="keterangan-field" class="mb-3 rounded p-3" style="background-color: white">
                            <div class="item rounded border border-secondary p-3 mb-3">
                                <div class="row">
                                    <div>
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" class="form-control"
                                            id="deskripsi"
                                            name="item[deskripsi]" required
                                            value="{{ old('item.deskripsi', $item['deskripsi'] ?? '') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="pokok" class="form-label">Pokok</label>
                                        <input type="text" class="form-control" id="pokok"
                                            name="item[pokok]" required
                                            value="{{ old('item.pokok', $item['pokok'] ?? '') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bunga" class="form-label">Bunga</label>
                                        <input type="text" class="form-control"
                                            id="bunga"
                                            name="item[bunga]"
                                            value="{{ old('item.bunga', $item['bunga'] ?? '') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="admin" class="form-label">Admin</label>
                                        <input type="text" class="form-control"
                                            id="admin"
                                            name="item[admin]"
                                            value="{{ old('item.admin', $item['admin'] ?? '') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="denda" class="form-label">Denda</label>
                                        <input type="text" class="form-control"
                                            id="denda"
                                            name="item[denda]"
                                            value="{{ old('item.denda', $item['denda'] ?? '') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="mb-9">
                                    <label for="total" class="form-label">Total</label>
                                    <input type="text" class="form-control @error('total') is-invalid @enderror"
                                        id="total" name="total" required readonly value="{{ old('total') }}">
                                </div>
                            </div>

                            <script>
                                function numberToWords(number) {
                                    const units = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan"];
                                    const teens = ["Sepuluh", "Sebelas", "Dua Belas", "Tiga Belas", "Empat Belas", "Lima Belas", "Enam Belas",
                                        "Tujuh Belas", "Delapan Belas", "Sembilan Belas"
                                    ];
                                    const tens = ["", "", "Dua Puluh", "Tiga Puluh", "Empat Puluh", "Lima Puluh", "Enam Puluh", "Tujuh Puluh",
                                        "Delapan Puluh", "Sembilan Puluh"
                                    ];
                                    const thousands = ["", "Ribu", "Juta", "Miliar", "Triliun"];

                                    if (number === 0) return "Nol";

                                    // Helper function for numbers less than 1000
                                    function convertHundreds(n) {
                                        let result = "";

                                        if (n >= 100) {
                                            if (n === 100) {
                                                result += "Seratus ";
                                            } else if (n < 200) {
                                                result += "Seratus "; // Handles the case of 101-199
                                                n %= 100;
                                            } else {
                                                result += units[Math.floor(n / 100)] + " Ratus ";
                                                n %= 100;
                                            }
                                        }

                                        if (n >= 10 && n < 20) {
                                            result += teens[n - 10] + " ";
                                        } else {
                                            if (n >= 20) {
                                                result += tens[Math.floor(n / 10)] + " ";
                                                n %= 10;
                                            }
                                            if (n > 0) {
                                                result += units[n] + " ";
                                            }
                                        }

                                        return result.trim();
                                    }

                                    // Function to break the number into groups of thousands
                                    function convertToWords(n) {
                                        let result = "";
                                        let group = 0;

                                        while (n > 0) {
                                            let currentGroup = n % 1000;

                                            if (currentGroup > 0) {
                                                let groupWord = convertHundreds(currentGroup);

                                                // Add appropriate thousand, million, billion, etc.
                                                if (group === 1 && currentGroup === 1) {
                                                    result = "Seribu " + result;
                                                } else if (group > 0) {
                                                    result = groupWord + " " + thousands[group] + " " + result;
                                                } else {
                                                    result = groupWord + " " + result;
                                                }
                                            }

                                            n = Math.floor(n / 1000);
                                            group++;
                                        }

                                        return result.trim();
                                    }

                                    return convertToWords(number);
                                }

                                document.addEventListener('DOMContentLoaded', function() {
                                    const totalInput = document.getElementById('total');
                                    const terbilangInput = document.getElementById('terbilang');

                                    function calculateTotal() {
                                        const pokokInput = document.getElementById('pokok');
                                        const bungaInput = document.getElementById('bunga');
                                        const adminInput = document.getElementById('admin');
                                        const dendaInput = document.getElementById('denda');

                                        let total = 0;

                                        total += parseFloat(pokokInput.value) || 0;
                                        total += parseFloat(bungaInput.value) || 0;
                                        total += parseFloat(adminInput.value) || 0;
                                        total += parseFloat(dendaInput.value) || 0;

                                        totalInput.value = total;
                                        updateTerbilang();
                                    }

                                    function updateTerbilang() {
                                        const totalValue = parseFloat(totalInput.value.replace(/[^0-9,-]+/g, "").replace(",", "."));
                                        if (!isNaN(totalValue)) {
                                            terbilangInput.value = numberToWords(totalValue) + " Rupiah";
                                        } else {
                                            terbilangInput.value = "";
                                        }
                                    }

                                    const inputs = document.querySelectorAll('#pokok, #bunga, #admin, #denda');
                                    inputs.forEach(input => {
                                        input.addEventListener('input', calculateTotal);
                                    });

                                    calculateTotal(); // Initialize on load
                                });
                            </script>
                        </div>

                        <div class="mb-3">
                            <label for="terbilang" class="form-label">Terbilang</label>
                            <input type="text" class="form-control @error('terbilang') is-invalid @enderror" readonly
                                id="terbilang" name="terbilang" required value="{{ old('terbilang') }}">
                            @error('terbilang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ket" class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('ket') is-invalid @enderror" id="ket"
                                name="ket" required value="{{ old('ket') }}">
                            @error('ket')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="a_nama" class="form-label">Atas Nama</label>
                            <input type="text" class="form-control @error('a_nama') is-invalid @enderror"
                                id="a_nama" name="a_nama" required value="{{ old('a_nama') }}">
                            @error('a_nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bank" class="form-label">Bank</label>
                            <input type="text" class="form-control @error('bank') is-invalid @enderror" id="bank"
                                name="bank" required value="{{ old('bank') }}">
                            @error('bank')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="norek" class="form-label">No Rekening</label>
                            <input type="text" class="form-control @error('norek') is-invalid @enderror"
                                id="norek" name="norek" required value="{{ old('norek') }}">
                            @error('norek')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                            @error('catatan')
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
                const cicilanDariInput = document.getElementById('cicilanDari');
                const cicilanSampaiInput = document.getElementById('cicilanSampai');
                const pembayaranAtasInput = document.getElementById('pembayaranAtas');

                function updateKeterangan() {
                    pembayaranAtasInput.value = pembayaranAtasInput.value.toUpperCase();
                    const cicilanDari = cicilanDariInput.value;
                    const cicilanSampai = cicilanSampaiInput.value;
                    const pembayaranAtas = pembayaranAtasInput.value;

                    const deskripsiInput = document.getElementById(`deskripsi`);
                    if (deskripsiInput) {
                        deskripsiInput.value = `PEMBAYARAN POKOK CICILAN KE-${cicilanDari} DARI ${cicilanSampai} ATAS PEMBELIAN ${pembayaranAtas}`;
                    }

                }

                cicilanDariInput.addEventListener('input', function() {
                    updateKeterangan();
                });

                cicilanSampaiInput.addEventListener('input', function() {
                    updateKeterangan();
                });

                pembayaranAtasInput.addEventListener('input', function() {
                    updateKeterangan();
                });
            });
        </script>



    @endsection
