@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Buat Surat Keterangan GA</h6>
                    <form method="post" action="/dashboard/ga">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal Surat</label>
                            <select class="form-select @error('perihal') is-invalid @enderror" id="perihal" name="perihal" required autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Surat</option>
                                <option value="Surat Pengajuan Pembuatan Kartu Akses Gedung Artha Graha">Surat Pengajuan Kartu Akses</option>
                            </select>
                            @error('perihal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                
                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat</label>
                            <input type="number" class="form-control @error('noSurat') is-invalid @enderror" id="noSurat" name="noSurat" placeholder="Urutan Nomor Surat Terbaru" required value="{{ old('noSurat') }}" onkeyup="updateSecondForm()">
                            @error('noSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input id="keterangan" type="hidden" name="keterangan">
                            <trix-editor class="form-control @error('keterangan') is-invalid @enderror" input="keterangan" required value="{{ old('keterangan') }}" placeholder="Jelaskan rincian Permintaan / Alasan"></trix-editor>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="tglSurat" class="form-label">Tanggal</label>
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

            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Data Karyawan</h6>
                    <form id="employeeForm">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="nama" class="form-label">Nama :</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Lengkap" required>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control @error('noSurat2') is-invalid @enderror" id="noSurat2" name="noSurat2" required>
                                @error('noSurat2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="nik" class="form-label">NIK :</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" placeholder="Nomor Induk Karyawan" required>
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="alamat" class="form-label">Alamat :</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat Lengkap" required>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="keterangan2" class="form-label">Keterangan :</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('keterangan2') is-invalid @enderror" id="keterangan2" name="keterangan" placeholder="Jelaskan rincian Permintaan / Alasan" required>
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary" onclick="saveData()">Simpan Data Sementara</button>
                    </form>

                    <!-- Table to Display Temporary Data -->
                    <div class="mt-4">
                        <h6 class="mb-4">Data Sementara</h6>
                        <table class="table table-bordered" id="temporaryDataTable">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Alamat</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include JavaScript at the end of the file or in an external JS file -->
    <script>
        function updateSecondForm() {
            var noSuratValue = document.getElementById("noSurat").value;
            // Update second form fields with the value from the first form
            document.getElementById("noSurat2").value = noSuratValue;
        }

        function saveData() {
            var employeeForm = document.getElementById('employeeForm');
            var formData = new FormData(employeeForm);
            
            // Convert FormData to an object
            var data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            // Retrieve existing data from localStorage
            var existingData = localStorage.getItem('temporaryData');
            var temporaryData = existingData ? JSON.parse(existingData) : [];

            // Add new data to the existing data
            temporaryData.push(data);

            // Save updated data to localStorage
            localStorage.setItem('temporaryData', JSON.stringify(temporaryData));

            // Update the table with new data
            updateTable();
        }

        function updateTable() {
            var tableBody = document.getElementById('temporaryDataTable').getElementsByTagName('tbody')[0];
            var savedData = localStorage.getItem('temporaryData');
            var data = savedData ? JSON.parse(savedData) : [];

            tableBody.innerHTML = ''; // Clear existing table data

            data.forEach((entry) => {
                var row = tableBody.insertRow();
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);

                cell1.textContent = entry.nama || '';
                cell2.textContent = entry.nik || '';
                cell3.textContent = entry.alamat || '';
                cell4.textContent = entry.keterangan || '';

                var deleteButton = document.createElement('button');
                deleteButton.textContent = 'Hapus';
                deleteButton.className = 'btn btn-danger btn-sm';
                deleteButton.onclick = function() {
                    deleteEntry(entry);
                };

                cell5.appendChild(deleteButton);
            });
        }

        function deleteEntry(entry) {
            var savedData = localStorage.getItem('temporaryData');
            var data = savedData ? JSON.parse(savedData) : [];
            var updatedData = data.filter(item => JSON.stringify(item) !== JSON.stringify(entry));
            
            localStorage.setItem('temporaryData', JSON.stringify(updatedData));
            updateTable();
        }

        // Load saved data on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateTable();
        });
    </script>
@endsection
