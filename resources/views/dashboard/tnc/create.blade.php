@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 mx-auto p-4" style="width: 210mm;">
                    <h6 class="mb-4">Buat Surat Keterangan Talent And Culture</h6>
                    <form method="post" action="/dashboard/tnc">
                        @csrf

                        <input type="hidden" id="approve" name="approve" value="0">

                        <div class="mb-3" id="noSurat-field">
                            <label for="noSurat" class="form-label">Nomor Surat</label>
                            <input type="hidden" class="form-control @error('noSurat') is-invalid @enderror" id="noSurat"
                                name="noSurat" placeholder="Urutan Nomor Surat Terbaru" required
                                value="{{ old('noSurat') }}">
                            <br>
                            <input type="text" class="form-control" id="prefix" name="prefix" readonly>
                            @error('noSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="kop" class="form-label">Pilih Kop Surat</label>
                            <select class="form-select @error('kop') is-invalid @enderror" id="kop" name="kop"
                                autofocus>
                                <option value="" selected>Tanpa Kop</option>
                                <option value="GEL">GEL</option>
                                <option value="QIN">QIN</option>
                                <option value="ERA">ERA</option>
                                <option value="GCR">GCR</option>
                                <option value="KKS">KKS</option>
                            </select>
                            @error('kop')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="idPerihal" class="form-label">Jenis Surat</label>
                            <select class="form-select @error('idPerihal') is-invalid @enderror" id="idPerihal"
                                name="idPerihal" required autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Surat</option>
                                <option value="1">Internal Memo</option>
                                <option value="2">Pengajuan Test Psikolog Waskita</option>
                                <option value="3">Surat Keterangan Kerja</option>
                                <option value="4">Surat Mutasi</option>
                                <option value="5">Surat Tugas</option>
                                <option value="6">PKWT</option>
                                <option value="7">Surat Permohonan Telat Pembayaran Gedung</option>0
                                <option value="8">Surat Penawaran Kerja (Offering Letter)</option>
                                <option value="9">Surat Promosi</option>
                                <option value="10">Surat Panggilan</option>
                                <option value="11">Surat NON AKTIF BPJS</option>
                                <option value="12">Surat Keputusan</option>
                            </select>
                            <input type="hidden" id="perihal" name="perihal" value="{{ old('perihal') }}">
                            @error('idPerihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="suratPanggilanField" style="display: none;">
                            <label for="suratPanggilan" class="form-label">Surat Panggilan Ke -</label>
                            <select class="form-select @error('suratPanggilan') is-invalid @enderror" id="suratPanggilan"
                                name="suratPanggilan">
                                <option value="" disabled selected>Surat Panggilan Ke</option>
                                <option value="Pertama">1</option>
                                <option value="Kedua">2</option>
                                <option value="Ketiga">3</option>
                            </select>
                            @error('suratPanggilan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div id="identitas-field" style="display: none;">
                            <div id="Nama-field" class="mb-3">
                                <label for="namaKaryawan" class="form-label">Nama</label>
                                <input type="text" name="namaKaryawan" id="namaKaryawan"
                                    class="form-control @error('namaKaryawan') is-invalid @enderror">
                                @error('namaKaryawan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="nik-field" class="mb-3">
                                <label for="nik" class="form-label">No KTP / NIK</label>
                                <input type="text" name="nik" id="nik"
                                    class="form-control @error('nik') is-invalid @enderror">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div id="pkwt-field" style="display: none;">
                            <div id="tempatLahirField" class="mb-3">
                                <table style="width:745px;">
                                    <tr>
                                        <td><label for="tempatLahir" class="form-label">Tempat</label></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ </td>
                                        <td><label for="tanggalLahir" class="form-label">Tanggal lahir</label></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="tempatLahir" id="tempatLahir"
                                                class="form-control @error('tempatLahir') is-invalid @enderror"></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ </td>
                                        <td><input type="date" name="tanggalLahir" id="tanggalLahir"
                                                class="form-control @error('tanggalLahir') is-invalid @enderror"></td>
                                    </tr>
                                </table>
                            </div>

                            <div id="jenisKelamin-field" class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <div>
                                    <input type="radio" name="jenisKelamin" id="lakiLaki" value="Laki-Laki"
                                        class="@error('jenisKelamin') is-invalid @enderror">
                                    <label for="lakiLaki">Laki-Laki</label>
                                </div>
                                <div>
                                    <input type="radio" name="jenisKelamin" id="perempuan" value="Perempuan"
                                        class="@error('jenisKelamin') is-invalid @enderror">
                                    <label for="perempuan">Perempuan</label>
                                </div>
                                @error('jenisKelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div id="pendidikan-field" class="mb-3">
                                <label for="pendidikan" class="form-label">Pendidikan</label>
                                <input type="text" name="pendidikan" id="pendidikan"
                                    class="form-control @error('pendidikan') is-invalid @enderror">
                                @error('pendidikan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="alamat-field" class="mb-3" style="display:none;">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror">
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="jabatanAwal-field" class="mb-3" style="display: none">
                                <label for="jabatanAwal" class="form-label" id="labeljabatanAwal">Jabatan Awal /
                                    Dept</label>
                                <input type="text" name="jabatanAwal" id="jabatanAwal"
                                    class="form-control @error('jabatanAwal') is-invalid @enderror">
                                @error('jabatanAwal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="tanggalMasukKerja-field" class="mb-3">
                                <label for="tanggalMasukKerja" class="form-label">Tanggal awal masuk bekerja / (Joint
                                    Date)</label>
                                <input type="date" name="tanggalMasukKerja" id="tanggalMasukKerja"
                                    class="form-control @error('tanggalMasukKerja') is-invalid @enderror">
                                @error('tanggalMasukKerja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="masaKerja-field" class="row mb-3">
                                <div class="col-md-6">
                                    <label for="masaKerja" class="form-label">Masa Kerja</label>
                                    <select class="form-select @error('masaKerja') is-invalid @enderror" id="masaKerja"
                                        name="masaKerja">
                                        <option value="" disabled selected>Pilih Masa Kerja</option>
                                        <option value="1 bulan">1 bulan</option>
                                        <option value="3 bulan">3 bulan</option>
                                        <option value="6 bulan">6 bulan</option>
                                        <option value="1 tahun">1 tahun</option>
                                        <option value="2 tahun">2 tahun</option>
                                        <option value="3 tahun">3 tahun</option>
                                        <option value="4 tahun">4 tahun</option>
                                        <option value="5 tahun">5 tahun</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="endDate" class="form-label">Sampai tanggal</label>
                                    <input type="date" id="endDate" class="form-control" readonly>
                                    <!-- Hidden input to actually submit the value -->
                                    <input type="hidden" id="hiddenEndDate" name="endDate">
                                    @error('masaKerja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const tanggalMasukKerjaInput = document.getElementById('tanggalMasukKerja');
                                    const masaKerjaSelect = document.getElementById('masaKerja');
                                    const endDateInput = document.getElementById('endDate');
                                    const hiddenEndDateInput = document.getElementById('hiddenEndDate');

                                    function calculateEndDate() {
                                        const startDate = new Date(tanggalMasukKerjaInput.value);
                                        const masaKerja = masaKerjaSelect.value;

                                        if (!isNaN(startDate) && masaKerja) {
                                            let endDate = new Date(startDate);

                                            switch (masaKerja) {
                                                case '1 bulan':
                                                    endDate.setMonth(endDate.getMonth() + 1);
                                                    break;
                                                case '3 bulan':
                                                    endDate.setMonth(endDate.getMonth() + 3);
                                                    break;
                                                case '6 bulan':
                                                    endDate.setMonth(endDate.getMonth() + 6);
                                                    break;
                                                case '1 tahun':
                                                    endDate.setFullYear(endDate.getFullYear() + 1);
                                                    break;
                                                case '2 tahun':
                                                    endDate.setFullYear(endDate.getFullYear() + 2);
                                                    break;
                                                case '3 tahun':
                                                    endDate.setFullYear(endDate.getFullYear() + 3);
                                                    break;
                                                case '4 tahun':
                                                    endDate.setFullYear(endDate.getFullYear() + 4);
                                                    break;
                                                case '5 tahun':
                                                    endDate.setFullYear(endDate.getFullYear() + 5);
                                                    break;
                                            }

                                            const formattedEndDate = endDate.toISOString().split('T')[0];
                                            endDateInput.value = formattedEndDate;
                                            hiddenEndDateInput.value = formattedEndDate;  // Set the value for the hidden input
                                        }
                                    }

                                    tanggalMasukKerjaInput.addEventListener('change', calculateEndDate);
                                    masaKerjaSelect.addEventListener('change', calculateEndDate);
                                });
                            </script>
                        </div>

                        <div id="masakontrak" style="display: none;">
                            <table style="width:745px;">
                                <tr>
                                    <td><label for="masakontrakAwal" class="form-label">Masa Kontrak Kerja Dari (Working
                                            Period)</label></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
                                    <td><label for="masakontrakAkhir" class="form-label">Sampai</label></td>
                                </tr>
                                <tr>
                                    <td><input type="date" name="masakontrakAwal" id="masakontrakAwal"
                                            class="form-control @error('masakontrakAwal') is-invalid @enderror"></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
                                    <td><input type="date" name="masakontrakAkhir" id="masakontrakAkhir"
                                            class="form-control @error('masakontrakAkhir') is-invalid @enderror"></td>
                                </tr>
                            </table>
                            <br>
                        </div>

                        <div id="mutasi-field" style="display: none;">
                            <div id="idKaryawan-field" class="mb-3">
                                <label for="idKaryawan" class="form-label">ID</label>
                                <input type="text" name="idKaryawan" id="idKaryawan"
                                    class="form-control @error('idKaryawan') is-invalid @enderror">
                                @error('idKaryawan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="jabatanAwal-field" class="mb-3">
                                <label for="jabatanAwal" class="form-label" id="labeljabatanAwal">Jabatan Awal /
                                    Dept</label>
                                <input type="text" name="jabatanAwal" id="jabatanAwal"
                                    class="form-control @error('jabatanAwal') is-invalid @enderror">
                                @error('jabatanAwal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="jabatanBaru-field" class="mb-3">
                                <label for="jabatanBaru" class="form-label" id="labeljabatanBaru">Jabatan Baru /
                                    Dept</label>
                                <input type="text" name="jabatanBaru" id="jabatanBaru"
                                    class="form-control @error('jabatanBaru') is-invalid @enderror">
                                @error('jabatanBaru')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div id="tanggungjawabKPD-field" class="mb-3" style="display: none;">
                            <label for="tanggungjawabKPD" class="form-label">Bertanggungjawab Kepada</label>
                            <input type="text" name="tanggungjawabKPD" id="tanggungjawabKPD"
                                class="form-control @error('tanggungjawabKPD') is-invalid @enderror">
                            @error('tanggungjawabKPD')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="jabatan-field" class="mb-3" style="display: none;">
                            <label for="jabatan" class="form-label" id="jabatanLabel">Jabatan ( Position)</label>
                            <input type="text" name="jabatan" id="jabatan"
                                class="form-control @error('jabatan') is-invalid @enderror">
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="departement-field" class="mb-3" style="display: none;">
                            <label for="departement" class="form-label" id="departementAwal">Departement</label>
                            <input type="text" name="departement" id="departement"
                                class="form-control @error('departement') is-invalid @enderror">
                            @error('departement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="departementBaru-field" class="mb-3" style="display: none;">
                            <label for="departementBaru" class="form-label" id="departementBaru">Departement Baru</label>
                            <input type="text" name="departementBaru" id="departementBaru"
                                class="form-control @error('departementBaru') is-invalid @enderror">
                            @error('departementBaru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div id="alasan-field" class="mb-3" style="display: none;">
                            <label for="alasan" class="form-label">Alasan</label>
                            <input type="text" name="alasan" id="alasan"
                                class="form-control @error('alasan') is-invalid @enderror">
                            @error('alasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="tglEfektif-field" class="mb-3" style="display: none;">
                            <label for="tglEfektif" class="form-label" id="labeltglEfektif">Tanggal Efektif</label>
                            <input type="date" name="tglEfektif" id="tglEfektif"
                                class="form-control @error('tglEfektif') is-invalid @enderror">
                            @error('tglEfektif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="terhitungTgl-field" class="mb-3" style="display: none;">
                            <table style="width:745px;">
                                <tr>
                                    <td><label for="startingDate" class="form-label" id="labelstartingDate">Terhitung
                                            dari tanggal</label></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
                                    <td><label for="endDate" class="form-label" id="labelendDate">Sampai tanggal</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="date" name="startingDate" id="startingDate"
                                            class="form-control @error('startingDate') is-invalid @enderror"></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
                                    <td><input type="date" name="endDate" id="endDate"
                                            class="form-control @error('endDate') is-invalid @enderror"></td>
                                </tr>
                            </table>
                        </div>

                        <div id="divisi-field" class="mb-3" style="display: none;">
                            <label for="divisi" class="form-label">Untuk Divisi</label>
                            <select class="form-select @error('divisi') is-invalid @enderror" id="divisiSelect"
                                name="divisi" autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Divisi</option>
                                <option value="TNC">Talent And Culture</option>
                                <option value="FIN-AR">Finance AR</option>
                                <option value="FIN-AP">Finance AP</option>
                                <option value="TAX">TAX</option>
                                <option value="ACC">Accounting</option>
                                <option value="MSS">Marketing Sales and Shipping</option>
                                <option value="LEGAL">LEGAL</option>
                                <option value="PRC">Procurement</option>
                                <option value="IA">Internal Audit</option>
                                <option value="IT">IT</option>
                                <option value="Operation">Operation</option>
                            </select>
                            <input type="hidden" id="divisi" name="divisi" value="{{ old('divisi') }}">
                            @error('idPerihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="perihalLanjutan-field" class="mb-3" style="display: none;">
                            <label for="perihalLanjutan" class="form-label">Perihal</label>
                            <input type="text" name="perihalLanjutan" id="perihalLanjutan"
                                class="form-control @error('perihalLanjutan') is-invalid @enderror">
                            @error('perihalLanjutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div id="tujuanSurat-field" class="mb-3" style="display: none;">
                            <label for="tujuanSurat" class="form-label">Tujuan Surat</label>
                            <input type="text" name="tujuanSurat" id="tujuanSurat"
                                placeholder="Surat ditujukan kepada..."
                                class="form-control @error('jml_lampiran') is-invalid @enderror">
                            @error('tujuanSurat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="dataphk-field" class="mb-3"
                            style="background-color: white; border-radius: 10px; padding: 15px; display:none;">
                            <label for="dataphk-field" class="form-label"><strong>Penyebab PHK</strong></label>
                            <div style="display: flex; gap: 10px; margin-top:10px">
                                <label for="dataphk1" class="form-label">Meninggal dunia</label>
                                <input type="number" class="form-control @error('dataphk1') is-invalid @enderror"
                                    id="dataphk1" name="dataphk1" value="{{ old('dataphk1') }}"
                                    style="margin-left: auto; width: 100px; height: 38px;">
                                @error('dataphk1')
                                    <div class="invalid-feedback" style="font-size: 12px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="tglPHK" class="form-label">Orang</label>
                            </div>
                            <div style="display: flex; gap: 10px; margin-top:10px">
                                <label for="dataphk2" class="form-label">Berakhir masa kerja berdasarkan perjanjian
                                    kerja</label>
                                <input type="number" class="form-control @error('dataphk2') is-invalid @enderror"
                                    id="dataphk2" name="dataphk2" value="{{ old('dataphk2') }}"
                                    style="margin-left: auto; width: 100px; height: 38px;">
                                @error('dataphk2')
                                    <div class="invalid-feedback" style="font-size: 12px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="tglPHK" class="form-label">Orang</label>
                            </div>
                            <div style="display: flex; gap: 10px; margin-top:10px">
                                <label for="dataphk3" class="form-label">Mengundurkan diri</label>
                                <input type="number" class="form-control @error('dataphk3') is-invalid @enderror"
                                    id="dataphk3" name="dataphk3" value="{{ old('dataphk3') }}"
                                    style="margin-left: auto; width: 100px; height: 38px;">
                                @error('dataphk3')
                                    <div class="invalid-feedback" style="font-size: 12px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="tglPHK" class="form-label">Orang</label>
                            </div>
                            <div style="display: flex; gap: 10px; margin-top:10px">
                                <label for="dataphk4" class="form-label">Penyebab lain selain poin 1 sd 3 yang tidak
                                    mendapatkan
                                    jaminan kesehatan paling lama 6 bulan</label>
                                <input type="number" class="form-control @error('dataphk4') is-invalid @enderror"
                                    id="dataphk4" name="dataphk4" value="{{ old('dataphk4') }}"
                                    style="margin-left: auto; width: 100px; height: 38px;">
                                @error('dataphk4')
                                    <div class="invalid-feedback" style="font-size: 12px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="tglPHK" class="form-label">Orang</label>
                            </div>
                            <div style="display: flex; gap: 10px; margin-top:10px">
                                <label for="dataphk5" class="form-label">PHK yang sudah ada putusan Pengadilan Hubungan
                                    Industrial</label>
                                <input type="number" class="form-control @error('dataphk5') is-invalid @enderror"
                                    id="dataphk5" name="dataphk5" value="{{ old('dataphk5') }}"
                                    style="margin-left: auto; width: 100px; height: 38px;">
                                @error('dataphk5')
                                    <div class="invalid-feedback" style="font-size: 12px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="tglPHK" class="form-label">Orang</label>
                            </div>
                            <div style="display: flex; gap: 10px; margin-top:10px">
                                <label for="dataphk6" class="form-label">PHK karena perubahan status, penggabungan atau
                                    peleburan
                                    perusahaan, dan pengusaha tidak bersedia menerima pekerja/buruh di perusahaannya</label>
                                <input type="number" class="form-control @error('dataphk6') is-invalid @enderror"
                                    id="dataphk6" name="dataphk6" value="{{ old('dataphk6') }}"
                                    style="margin-left: auto; width: 100px; height: 38px;">
                                @error('dataphk6')
                                    <div class="invalid-feedback" style="font-size: 12px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="tglPHK" class="form-label">Orang</label>
                            </div>
                            <div style="display: flex; gap: 10px; margin-top:10px">
                                <label for="dataphk7" class="form-label">PHK karena perusahaan pailit atau mengalami
                                    kerugian</label>
                                <input type="number" class="form-control @error('dataphk7') is-invalid @enderror"
                                    id="dataphk7" name="dataphk7" value="{{ old('dataphk7') }}"
                                    style="margin-left: auto; width: 100px; height: 38px;">
                                @error('dataphk7')
                                    <div class="invalid-feedback" style="font-size: 12px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="tglPHK" class="form-label">Orang</label>
                            </div>
                            <div style="display: flex; gap: 10px; margin-top:10px">
                                <label for="dataphk8" class="form-label">Pekerja yang mengalami sakit berkepanjangan,
                                    mengalami
                                    cacat akibat kecelakaan kerja dan tidak dapat melakukan pekerjaannya setelah melampaui
                                    batas 12
                                    (dua belas) bulan</label>
                                <input type="number" class="form-control @error('dataphk8') is-invalid @enderror"
                                    id="dataphk8" name="dataphk8" value="{{ old('dataphk8') }}"
                                    style="margin-left: auto; width: 100px; height: 38px;">
                                @error('dataphk8')
                                    <div class="invalid-feedback" style="font-size: 12px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="tglPHK" class="form-label">Orang</label>
                            </div>
                        </div>

                        <div id="pegawai-field" class="mb-3 rounded p-3" style="background-color: white; display:none;">
                        <!-- TODO: add dynamic input worker -->
                        </div>


                        <div id="pemanggilan-field" class="mb-3" style="display: none;">
                            <label for="pemanggilan" class="form-label">No Surat Pemanggilan</label>
                            <select class="form-select @error('pemanggilan') is-invalid @enderror" id="pemanggilanselect"
                                name="pemanggilan" autofocus>
                                @foreach ($tnc as $tnc)
                                <option value="{{ $tnc->prefix }}">{{ $tnc->prefix }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="pemanggilan" name="pemanggilan" value="{{ old('pemanggilan') }}">
                            @error('idPerihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="keterangan-field" class="mb-3" style="display: none;">
                            <label for="keterangan" class="form-label">Isi Surat / Keterangan</label>
                            <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">

                        </textarea>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const keterangan = Jodit.make('#keterangan');
                                    new DragAndDrop(keterangan);
                                    const perihalSelect = document.getElementById('idPerihal');
                                    const divisiSelect = document.getElementById('divisiSelect');
                                    const namaKaryawanInput = document.getElementById('namaKaryawan');
                                    const panggilanSelect = document.getElementById('suratPanggilan');


                                    function updateKeterangan() {
                                        console.log(panggilanSelect.value);
                                        const namaKaryawan = namaKaryawanInput.value;
                                        if (divisiSelect.value === 'FIN-AP') {
                                            keterangan.value =
                                                `<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: 48px;"><span>Dengan ini
                                                        kami menginformasikan adanya perubahan pengiriman bukti bayar yang semula
                                                        dikirimkan melalui Group Whatsapp masing-masing Departement menjadi via E-Mail,
                                                        dengan rincian sebagai berikut :</span></p>
                                                <p class="MsoListParagraphCxSpFirst" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span><span>1.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></span></span><span>E-mail PIC user masing-masing Department yang
                                                        akan digunakan (terlampir).</span></p>

                                                <p class="MsoListParagraphCxSpMiddle" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span><span>2.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></span></span><span>E-mail Vendor yang akan dikirimkan bukti
                                                        transfer harus sudah ada pada kolom “Email” PVR.</span></p>

                                                <p class="MsoListParagraphCxSpLast" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><span>Contoh Format :<span>&nbsp; </span></span></p>
                                                <p class="MsoListParagraphCxSpLast" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>
                                                <p class="MsoListParagraphCxSpLast" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>
                                                <p class="MsoListParagraph" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span><span>3.&nbsp;</span></span><span>Jika ada perubahan E-mail User wajib
                                                        menginfokan secara resmi ke tim Finance AP melalui email </span><a href="mailto:finjkt.adm01@gel.co.id" style="color: blue; text-decoration: underline;"><span>finjkt.adm01@gel.co.id</span></a></p>
                                                <p class="MsoListParagraph" style="margin: 0px 0px 0px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><br></p>
                                                <p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><span>Update skema pembayaran di atas <u>berlaku
                                                            efektif per tanggal 01 Mei 2024.</u></span></p>
                                                <p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: 48px;"><span>Demikian
                                                        internal memorandum ini kami buat agar dapat diimplementasikan sebagaimana
                                                        mestinya.</span></p>`;
                                        } else if (perihalSelect.value === '2') {
                                            keterangan.value = `<p>Dengan Hormat,</p>
                                                        <p>Bersama ini kami sampaikan permohonan untuk dapat dilakukan test psikolog untuk pegawai kami atas nama :</p>

                                                        <table style="border-collapse: collapse; width: 97.8022%; margin-left: -0.274725%; height: 14px;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 4.2796%; text-align: center;">NO</td>
                                                                    <td style="width: 38.2311%; text-align: center;">Nama</td>
                                                                    <td style="width: 24.5364%; text-align: center;">Jabatan</td>
                                                                    <td style="width: 32.097%; text-align: center;">No HP &amp; Email</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: center;">1</td>
                                                                    <td><br></td>
                                                                    <td><br></td>
                                                                    <td><br></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        &nbsp;<br>
                                                        <p>Untuk mengikuti psikoest untuk persyaratan menjadi karyawan PT Global Energi Lestari yang akan di adakan pada :</p>
                                                        <p>Hari/Tanggal : Selasa, 6 Desember 2022</p>
                                                        <p>Jam&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : 11.00 WIB s/d Selesai</p>
                                                        <p>Demikian surat permohonan ini dikeluarkan dan ditandatangani, atas perhatian dan kerjasamanya terima kasih.</p>
                                                `; // Reset or set other values based on different selections

                                        } else if (perihalSelect.value === '5') {
                                            keterangan.value =
                                                `<p><span>Dalam Rangka Menghadiri Undangan
                                                        Pembahasan Survei Kepuasan Pelanggan &amp; Mitra Batubara PT PLN Energi Primer
                                                        Indonesia Tahun 2024 Pada Tanggal 09 Oktober 2024 S/d 11 Oktober 2024 di
                                                        Bandung.</span></p>
                                                <p><span>&nbsp;</span><br></p>
                                                <p><span>Adapun hasil dalam perjalanan dinas
                                                        diantaranya:</span></p>
                                                <ol>
                                                    <li><span>Laporan terkait seluruh kegiatan perjalanan dinas untuk
                                                            BOD.</span></li>
                                                </ol>
                                                <p><span>Dan akan dilampirkan pada saat
                                                        pengajuan realisasi perjalanan dinas.</span></p>
                                                <p><span>&nbsp;</span><br></p>
                                                <p><span>Demikian surat tugas ini diberikan
                                                        agar dapat dipergunakan sebagaimana mestinya atas perhatian dan kerjasamanya
                                                        diucapkan terimakasih.</span></p>`; // Reset or set other values based on different selections
                                        } else if (perihalSelect.value === '7') {
                                            keterangan.value = `<p style="line-height:normal;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                                                    <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;" lang="EN-US">Kepada Yth,</span>
                                                                </p>
                                                                <p style="line-height:normal;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                                                    <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;" lang="EN-US">Management Gedung Arta Graha</span>
                                                                </p>
                                                                <p style="line-height:normal;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                                                    <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;" lang="EN-US">Di Tempat</span>
                                                                </p>
                                                                <p style="line-height:normal;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                                                    <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;" lang="IN">Up. Bapak Adi Prayoso – Tenant Relations Officer</span>
                                                                </p>
                                                                <p style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                                                    &nbsp;
                                                                </p>
                                                                <p style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;">
                                                                    <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="EN-US">Dengan Hormat,</span>
                                                                </p>
                                                                <p style="line-height:115%;margin-bottom:10pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                                                                    <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:115%;" lang="EN-US">Sehubungan dengan tagihan Biaya Sewa Gedung</span><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:115%;" lang="IN"> dengan&nbsp;</span><span style="font-family:Calibri, sans-serif;font-size:11pt;" lang="EN-US">No Inv</span><span style="font-family:Calibri, sans-serif;font-size:11pt;" lang="IN">oice</span><span style="font-family:Calibri, sans-serif;font-size:11pt;" lang="EN-US"> 431/INV/23 Rp. 103.614.486</span><span style="font-family:Calibri, sans-serif;font-size:11pt;" lang="IN">,-&nbsp;</span><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:115%;" lang="IN">dan Service Charge </span><span style="font-family:Calibri, sans-serif;font-size:11pt;" lang="EN-US">N</span><span style="font-family:Calibri, sans-serif;font-size:11pt;" lang="IN">o. Ivoice.&nbsp;</span><span style="font-family:Calibri, sans-serif;font-size:11pt;" lang="EN-US">432/INV/23 Rp. 47.444.527&nbsp;Periode&nbsp;01-04-2023 to 30-06-2023&nbsp;</span><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:115%;" lang="EN-US">yang belum kami lunasi.</span>
                                                                </p>
                                                                <p style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                                                                    <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="EN-US">Dengan ini Kami memohon maaf atas keterlambatan pembayaran yang telah terjadi maka sehubungan dengan hal tersebut</span><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="IN">,&nbsp;</span><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="EN-US">kami bermaksud menginformasikan pembayaran&nbsp;</span><i><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="IN">invoice</span></i><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="IN"> tersebut diatas rencana&nbsp;</span><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="EN-US">akan dilakukan pada minggu ke </span><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="IN">31Mei 2023</span><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="EN-US">.</span><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="IN"> Mohon agar tidak memutus layanan ataupun dikenakan </span><i><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="IN">penalty</span></i><span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="IN"> atas keterlambatan pembayaran ini.</span>
                                                                </p>
                                                                <p style="line-height:150%;margin-bottom:6.0pt;margin-left:0cm;margin-right:0cm;margin-top:0cm;text-align:justify;text-justify:inter-ideograph;">
                                                                    <span style="font-family:&quot;Cambria&quot;,serif;font-size:12.0pt;line-height:150%;" lang="EN-US">Demikian surat permohonan ini kami buat , atas perhatian dan kerjasamanya terima kasih.</span>
                                                                </p>
                                            `


                                        } else if (perihalSelect.value === '10' && panggilanSelect.value === 'Pertama') {
                                            keterangan.value = `<p style="text-align: justify;"><span>Yang terhormat Sdr. </span><span>${namaKaryawan}</span><span>,</span></p>
                                                                <p style="text-align: justify;"><span>Sehubungan dengan ketidakhadiran Sdr. </span><span>${namaKaryawan} </span><span>sampai dengan hari ini, maka kami memanggil Anda </span><span>untuk hadir pada hari </span><span>Rabu</span><span>, </span><span>25 </span><span>Oktober </span><span>2023
                                                                        Pukul 09:00 WIB di kantor PT Global Energi Lestari, Gedung Artha Graha Lantai 30,
                                                                        Jl. Jend Sudirman Kav. 52, SCBD Sudirman, Jakarta Selatan.</span></p>
                                                                <p style="text-align: justify;"><span>Mohon agar dapat memenuhi permintaan tersebut diatas, dan
                                                                        kelalian atas tindakan kepatuhan maka</span><span>mengakibatkan tindakan disiplin serta sanksi
                                                                        administatif.</span></p>
                                                                <p style="text-align: justify;"><span>Terima
                                                                        kasih atas kerjasamanya.</span></p>`

                                        } else if (perihalSelect.value === '10' && panggilanSelect.value === 'Kedua') {
                                            keterangan.value = `<p style="text-align: justify;"><span>Yang terhormat Sdr. </span><span>${namaKaryawan}</span><span>,</span></p>
                                                                <p style="text-align: justify;"><span>Sehubungan dengan ketidakhadiran Sdr. </span><span>${namaKaryawan} </span><span>sampai dengan hari ini, maka kami memanggil Anda </span><span>untuk hadir pada hari </span><span>Rabu</span><span>, </span><span>25 </span><span>Oktober </span><span>2023
                                                                        Pukul 09:00 WIB di kantor PT Global Energi Lestari, Gedung Artha Graha Lantai 30,
                                                                        Jl. Jend Sudirman Kav. 52, SCBD Sudirman, Jakarta Selatan.</span></p>
                                                                <p style="text-align: justify;"><span>Mohon agar dapat memenuhi permintaan tersebut diatas, dan
                                                                        kelalian atas tindakan kepatuhan maka</span><span>mengakibatkan tindakan disiplin serta sanksi
                                                                        administatif.</span></p>
                                                                <p style="text-align: justify;"><span>Terima
                                                                        kasih atas kerjasamanya.</span></p>`

                                        } else {
                                            keterangan.value = ``;
                                        }
                                    }

                                    // Initial check
                                    updateKeterangan();

                                    // Update keterangan when the dropdown value changes
                                    perihalSelect.addEventListener('change', updateKeterangan);
                                    divisiSelect.addEventListener('change', updateKeterangan);
                                    namaKaryawanInput.addEventListener('input', updateKeterangan);
                                    panggilanSelect.addEventListener('change',updateKeterangan)


                                });
                            </script>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="tglSurat" class="form-label">Tempat, Tanggal Surat</label>
                            <table>
                                <tr>
                                    <td>
                                        <input type="tmptTGL" class="form-control @error('tmptTGL') is-invalid @enderror"
                                            id="tmptTGL" name="tmptTGL" required value="{{ old('tmptTGL') }}"
                                            placeholder="Tempat Buat Surat">
                                    </td>
                                    <td> , </td>
                                    <td>
                                        <input type="date"
                                            class="form-control @error('tglSurat') is-invalid @enderror" id="tglSurat"
                                            name="tglSurat" required value="{{ old('tglSurat') }}">
                                    </td>
                                </tr>
                            </table>

                            @error('tglSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var today = new Date().toISOString().split('T')[0];
                                document.getElementById('tglSurat').value = today;
                            });
                        </script>

                        <div class="mb-3">
                            <label for="y_buat" class="form-label">Yang Membuat</label>
                            <input type="text" class="form-control @error('y_buat') is-invalid @enderror"
                                id="y_buat" name="y_buat" required value="{{ old('y_buat') }}">
                            @error('y_buat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="jml-lampiran-field" class="mb-3" style="display: none;">
                            <label for="jml_lampiran" class="form-label">Jumlah lampiran yang akan dilampirkan</label>
                            <input type="number" name="jml_lampiran" id="jml_lampiran"
                                class="form-control @error('jml_lampiran') is-invalid @enderror">
                            @error('jml_lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="upload-lampiran-field" class="mb-3" style="display: none;">
                            <label for="lampiran" class="form-label">Upload Lampiran (Optional)</label>
                            <input type="file" class="form-control @error('lampiran') is-invalid @enderror"
                                id="lampiran" name="lampiran" multiple>
                            @error('lampiran')
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
            class DragAndDrop {
                constructor(jodit) {
                    this.jodit = jodit;
                    this.init();
                }

                init() {
                    const editorArea = this.jodit.container;

                    editorArea.addEventListener('dragover', (event) => {
                        event.preventDefault();
                        editorArea.classList.add('drag-over');
                    });

                    editorArea.addEventListener('dragleave', () => {
                        editorArea.classList.remove('drag-over');
                    });

                    editorArea.addEventListener('drop', (event) => {
                        event.preventDefault();
                        editorArea.classList.remove('drag-over');

                        const files = event.dataTransfer.files;
                        if (files.length > 0) {
                            for (const file of files) {
                                if (file.type.startsWith('image/')) {
                                    this.handleImageUpload(file);
                                }
                            }
                        }
                    });
                }

                handleImageUpload(file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = `<img src="${e.target.result}" alt="Uploaded Image" style="max-width: 100%;" />`;
                        this.jodit.selection.insertHTML(img);
                    };
                    reader.readAsDataURL(file);
                }
            }
            document.addEventListener('DOMContentLoaded', async function() {
                const perihalSelect = document.getElementById('idPerihal');
                const kopSelect = document.getElementById('kop');
                const noSuratInput = document.getElementById('noSurat');
                const noSuratField = document.getElementById('noSurat-field');
                const ket = document.getElementById('keterangan');
                const keterangField = document.getElementById('keterangan-field');
                const prefixInput = document.getElementById('prefix');
                const tglSuratInput = document.getElementById('tglSurat');
                const jml_lampiran = document.getElementById('jml-lampiran-field');
                const upload_lampiran = document.getElementById('upload-lampiran-field');
                const tujuanSurat = document.getElementById('tujuanSurat-field');
                const divisi = document.getElementById('divisi-field');
                const divisiSelect = document.getElementById('divisiSelect');
                const identitasField = document.getElementById('identitas-field');
                const jabatanField = document.getElementById('jabatan-field');
                const departementField = document.getElementById('departement-field');
                const departementBaruField = document.getElementById('departementBaru-field');
                const terhitungTglField = document.getElementById('terhitungTgl-field');
                const mutasiField = document.getElementById('mutasi-field');
                const PKWTfield = document.getElementById('pkwt-field');
                const nikField = document.getElementById('nik-field');
                const tmpttglLahir = document.getElementById('tempatLahirField');
                const jenisKelamin = document.getElementById('jenisKelamin-field');
                const pendidikanField = document.getElementById('pendidikan-field');
                const masakontrakField = document.getElementById('masakontrak');
                const perihalLanjutan = document.getElementById('perihalLanjutan-field');
                const alamatField = document.getElementById('alamat-field');
                const alasanField = document.getElementById('alasan-field');
                const tglEfektifField = document.getElementById('tglEfektif-field');
                const terhitungTGL = document.getElementById('terhitungTgl-field');
                var labeltglEfektif = document.getElementById('labeltglEfektif');
                var labelJabatanAwal = document.getElementById("labeljabatanAwal");
                var labelJabatanBaru = document.getElementById("labeljabatanBaru");
                var labeldepartementAwal = document.getElementById("departementAwal");
                var labeldepartementBaru = document.getElementById("departementBaru");
                var labelstartingDate = document.getElementById("labelstartingDate");
                var labelendDate = document.getElementById("labelendDate");
                var jabatanLabel = document.getElementById("jabatanLabel");
                const idKaryawanField = document.getElementById("idKaryawan-field");
                const suratPanggilanField = document.getElementById("suratPanggilanField");
                const dataphkField = document.getElementById("dataphk-field");
                const pegawaiField = document.getElementById("pegawai-field");
                const jabatanAwalField = document.getElementById("jabatanAwal-field");
                const tanggungjwbKPD = document.getElementById('tanggungjawabKPD-field');

                const PADDING_LENGTH = 3;

                function showFields() {
                    // Hide fields by default
                    jml_lampiran.style.display = 'none';
                    upload_lampiran.style.display = 'none';
                    divisi.style.display = 'none';
                    tujuanSurat.style.display = 'none';
                    identitasField.style.display = 'none';
                    jabatanField.style.display = 'none';
                    departementField.style.display = 'none';
                    keterangField.style.display = 'none';
                    terhitungTglField.style.display = 'none';
                    mutasiField.style.display = 'none';
                    PKWTfield.style.display = 'none';
                    masakontrakField.style.display = 'none';
                    perihalLanjutan.style.display = 'none';
                    alamatField.style.display = 'none';
                    alasanField.style.display = 'none';
                    departementBaruField.style.display = 'none';
                    tglEfektifField.style.display = 'none';
                    jabatanLabel.innerText = "Jabatan (Position)";
                    suratPanggilanField.style.display = 'none';
                    dataphkField.style.display = 'none';
                    pegawaiField.style.display = 'none';
                    jabatanAwalField.style.display = 'none';
                    tanggungjwbKPD.style.display = 'none';

                    switch (perihalSelect.value) {
                        case '1':
                            // Show fields if value is 1 internal memo
                            jml_lampiran.style.display = 'block';
                            upload_lampiran.style.display = 'block';
                            divisi.style.display = 'block';
                            keterangField.style.display = 'block';
                            perihalLanjutan.style.display = 'block';
                            break;

                        case '2':
                            // Show fields if value is pengajuan waskita
                            keterangField.style.display = 'block';
                            break;

                        case '3':
                            // Show fields if value is surat keterangan kerja
                            identitasField.style.display = 'block';
                            jabatanField.style.display = 'block';
                            departementField.style.display = 'block';
                            labeldepartementAwal.innerText = "Departement";
                            keterangField.style.display = 'none';
                            terhitungTglField.style.display = 'block';
                            break;

                        case '4':
                            // Show fields if value is surat mutasi
                            identitasField.style.display = 'block';
                            mutasiField.style.display = 'block';
                            labelJabatanAwal.innerText = "Jabatan Awal / Dept";
                            labelJabatanBaru.innerText = "Jabatan Baru / Dept";
                            tglEfektifField.style.display = 'block';
                            labeltglEfektif.innerText = "Tanggal Efektif";
                            break;


                        case '5':
                            // Show fields if value is surat tugas
                            identitasField.style.display = 'block';
                            divisi.style.display = 'block';
                            keterangField.style.display = 'block';
                            break;


                        case '6':
                            // Show fields if value is pkwt
                            identitasField.style.display = 'block';
                            PKWTfield.style.display = 'block';
                            alamatField.style.display = 'block';
                            jabatanAwalField.style.display = 'block';
                            tanggungjwbKPD.style.display = 'block';
                            break;


                        case '7':
                            // Show fields if value is surat permohonan
                            keterangField.style.display = 'block';
                            break;

                        case '8':
                            // Show fields if value is offering letter
                            identitasField.style.display = 'block';
                            nikField.style.display = 'none';
                            PKWTfield.style.display = 'block';
                            tmpttglLahir.style.display = 'none';
                            pendidikanField.style.display = 'none';
                            masakontrakField.style.display = 'block';
                            jabatanField.style.display = 'block';
                            break;

                        case '9':
                            // Show fields if value is permohonan promosi
                            noSuratField.style.display = 'none';
                            identitasField.style.display = 'block';
                            nikField.style.display = 'none';
                            mutasiField.style.display = 'block';
                            jenisKelamin.style.display = 'none';
                            PKWTfield.style.display = 'block';
                            tglEfektifField.style.display = 'block';
                            idKaryawanField.style.display = 'none';
                            tmpttglLahir.style.display = 'none';
                            pendidikanField.style.display = 'none';
                            departementField.style.display = 'block';
                            alasanField.style.display = 'block';
                            departementBaruField.style.display = 'block';
                            labelJabatanAwal.innerText = "Jabatan Awal";
                            labelJabatanBaru.innerText = "Jabatan Baru";
                            labeldepartementAwal.innerText = "Departement Awal";
                            labeldepartementBaru.innerText = "Departement Baru";
                            labeltglEfektif.innerText = "Mulai tanggal";

                            break;

                        case '10':
                            identitasField.style.display = 'block';
                            suratPanggilanField.style.display = 'block';
                            nikField.style.display = 'none';
                            jabatanField.style.display = 'block';
                            jabatanLabel.innerText = "Jabatan";
                            keterangField.style.display = 'block';
                            break;

                        case '11':
                            dataphkField.style.display = 'block';
                            pegawaiField.style.display = 'block';
                            break;

                        case '12':
                            identitasField.style.display = 'block';
                            tglEfektifField.style.display = 'block';
                            nikField.style.display = 'none';
                            mutasiField.style.display = 'block';
                            break;

                            // You can add more cases here if needed
                        default:
                            // Default action can be empty or any other logic
                            break;
                    }
                }


                const maxKopValues = {
                    'GEL': {{ $kopCounts['GEL'] }},
                    'QIN': {{ $kopCounts['QIN'] }},
                    'ERA': {{ $kopCounts['ERA'] }},
                    'GCR': {{ $kopCounts['GCR'] }},
                };

                const maxValues = {
                    '1': {{ $maxNoSuratPerihal1 }},
                    '3': {{ $maxNoSuratPerihal3 }},
                    '4': {{ $maxNoSuratPerihal4 }},
                    '5': {{ $maxNoSuratPerihal5 }},
                    '6': {{ $maxNoSuratPerihal6 }},
                    '7': {{ $maxNoSuratPerihal7 }},
                    '8': {{ $maxNoSuratPerihal8 }},
                    '9': {{ $maxNoSuratPerihal9 }},
                    '10': {{ $maxNoSuratPerihal10 }},
                    '11': {{ $maxNoSuratPerihal11 }},
                    '12': {{ $maxNoSuratPerihal12 }},
                };

                function setInitialNoSurat() {
                    const currentType = perihalSelect.value;
                    const maxNoSuratPerihal2 = {{ $maxNoSuratPerihal2 }};
                    const kop = document.getElementById('kop').value;
                    if (perihalSelect.value === '1') {
                        noSuratInput.value = (maxKopValues[kop] || 0) + 1;
                    } else if (perihalSelect.value === '9') {
                        kopSelect.value = 'GEL';
                    } else {
                        noSuratInput.value = (maxValues[currentType] || 0) + 1;;
                    }
                }


                perihalSelect.addEventListener('change', function() {
                    const selectedValue = this.value;
                    const perihalInput = document.getElementById('perihal');

                    const perihalMap = {
                        '1': 'Internal Memo',
                        '2': 'Pengajuan Test Psikologi Pegawai',
                        '3': 'Surat Keterangan Kerja',
                        '4': 'Surat Mutasi',
                        '5': 'Surat Tugas',
                        '6': 'Perjanjian Kerja Waktu Tertentu',
                        '7': 'Permohonan Telat Pembayaran Gedung',
                        '8': 'Surat Penawaran Kerja (Offering Letter)',
                        '9': 'Surat Permintaan Promosi',
                        '10': 'Surat Pemanggilan',
                        '11': 'Surat Non Aktif BPJS',
                        '12': 'Surat Keputusan',
                    };
                    perihalInput.value = perihalMap[selectedValue] || '';
                    handleFieldUpdates();
                });

                divisiSelect.addEventListener('change', function() {
                    const selectedValue = this.value;
                    const divisiInput = document.getElementById('divisi');

                    const divisiMap = {
                        'TNC': 'Talent And Culture',
                        'FIN-AR': 'Finance AR',
                        'FIN-AP': 'Finance AP',
                        'TAX': 'TAX',
                        'ACC': 'Accounting',
                        'MSS': 'Marketing Sales and Shipping',
                        'LEGAL': 'LEGAL',
                        'PRC': 'Procurement',
                        'IA': 'Internal Audit',
                        'IT': 'IT',
                        'Operation': 'Operation',
                    };
                    divisiInput.value = divisiMap[selectedValue] || '';
                    handleFieldUpdates();
                });

                function updatePrefix() {
                    const noSurat = String(noSuratInput.value || '0').padStart(PADDING_LENGTH, '0');
                    const tglSurat = new Date(tglSuratInput.value);
                    const romanMonth = toRoman(tglSurat.getMonth() + 1);
                    const year = tglSurat.getFullYear();
                    const kop = document.getElementById('kop').value;
                    const divisi = document.getElementById('divisiSelect').value;

                    const prefixMap = {
                        '1': `No : ${divisi}-${noSurat}/${kop}/IM/${romanMonth}/${year}`,
                        '2': `${noSurat}/${kop}/TNC/${romanMonth}/${year}`,
                        '3': `No : ${kop}/TNC/REF/${romanMonth}/${year}`,
                        '4': `${noSurat}/${kop}/HR-SM/${romanMonth}/${year}`,
                        '5': `${kop}/SKT/${noSurat}/${romanMonth}/${year}`,
                        '6': `No : TNC/${noSurat}/PKWT/${kop}JKT/${romanMonth}/${year}`,
                        '7': `No. ${kop}/HR/${noSurat}/${romanMonth}/${year}`,
                        '8': `TNC/${noSurat}/${kop}JKT/LOO/${romanMonth}/${year}`,
                        '9': `TNC/${noSurat}/${kop}/PROMOTION/${romanMonth}/${year}`,
                        '10': `${noSurat}/${kop}/TNC-EXT/${romanMonth}/${year}`,
                        '11': `${noSurat}/TNC/${kop}-BPJSKes/${romanMonth}/${year}`,
                        '12': `TNC/${noSurat}/${kop}JKT/SK/${romanMonth}/${year}`,
                    };

                    prefixInput.value = prefixMap[perihalSelect.value] || '';
                }

                function toRoman(num) {
                    const roman = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
                    return roman[num - 1] || '';
                }

                function handleFieldUpdates() {
                    setInitialNoSurat();
                    updatePrefix();

                }

                [kopSelect, perihalSelect, tglSuratInput, noSuratInput].forEach(element => {
                    element.addEventListener('change', handleFieldUpdates);
                });

                // Initialize
                handleFieldUpdates();
                perihalSelect.addEventListener('change', showFields);
            });
        </script>
    @endsection
