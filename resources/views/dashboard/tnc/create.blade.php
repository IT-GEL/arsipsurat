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

                        <div class="mb-3">
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
                            <select class="form-select @error('kop') is-invalid @enderror" id="kop"
                                name="kop" autofocus>
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
                            <label for="idPerihal" class="form-label">Perihal Surat</label>
                            <select class="form-select @error('idPerihal') is-invalid @enderror" id="idPerihal"
                                name="idPerihal" required autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Surat</option>
                                <option value="1">Internal Memo</option>
                                <option value="2">Pengajuan Test Psikolog Waskita</option>
                                <option value="3">Surat Keterangan Kerja</option>
                                <option value="4">Surat Mutasi</option>
                                <option value="5">Surat Tugas</option>
                                <option value="6">PKWT</option>
                            </select>
                            <input type="hidden" id="perihal" name="perihal" value="{{ old('perihal') }}">
                            @error('idPerihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="identitas-field"  style="display: none;">
                            <div id="Nama-field" class="mb-3">
                                <label for="namaKaryawan" class="form-label" >Nama</label>
                                <input type="text" name="namaKaryawan" id="namaKaryawan" class="form-control @error('namaKaryawan') is-invalid @enderror">
                                @error('namaKaryawan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="nik-field" class="mb-3">
                                <label for="nik" class="form-label" >No KTP / NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div id="pkwt-field" style="display: none;">
                            <div id="tempatLahir" class="mb-3">
                                <table style="width:745px;">
                                    <tr>
                                        <td><label for="tempatLahir" class="form-label" >Tempat</label></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ </td>
                                        <td><label for="tanggalLahir" class="form-label" >Tanggal lahir</label></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="tempatLahir" id="tempatLahir"  class="form-control @error('tempatLahir') is-invalid @enderror"></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ </td>
                                        <td><input type="date" name="tanggalLahir" id="tanggalLahir"  class="form-control @error('tanggalLahir') is-invalid @enderror"></td>
                                    </tr>
                                </table>
                            </div>
                            <div id="jenisKelamin-field" class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <div>
                                    <input type="radio" name="jenisKelamin" id="lakiLaki" value="Laki-Laki" class="@error('jenisKelamin') is-invalid @enderror">
                                    <label for="lakiLaki">Laki-Laki</label>
                                </div>
                                <div>
                                    <input type="radio" name="jenisKelamin" id="perempuan" value="Perempuan" class="@error('jenisKelamin') is-invalid @enderror">
                                    <label for="perempuan">Perempuan</label>
                                </div>
                                @error('jenisKelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div id="pendidikan-field" class="mb-3">
                                <label for="pendidikan" class="form-label" >Pendidikan</label>
                                <input type="text" name="pendidikan" id="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror">
                                @error('pendidikan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="alamat-field" class="mb-3">
                                <label for="alamat" class="form-label" >Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror">
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div id="tanggalMasukKerja-field" class="mb-3">
                                <label for="tanggalMasukKerja" class="form-label" >Tanggal awal masuk bekerja</label>
                                <input type="date" name="tanggalMasukKerja" id="tanggalMasukKerja" class="form-control @error('tanggalMasukKerja') is-invalid @enderror">
                                @error('tanggalMasukKerja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div id="mutasi-field"  style="display: none;">
                            <div id="idKaryawan-field" class="mb-3">
                                <label for="idKaryawan" class="form-label" >ID</label>
                                <input type="text" name="idKaryawan" id="idKaryawan" class="form-control @error('idKaryawan') is-invalid @enderror">
                                @error('idKaryawan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="jabatanAwal-field" class="mb-3">
                                <label for="jabatanAwal" class="form-label" >Jabatan Awal / Dept</label>
                                <input type="text" name="jabatanAwal" id="jabatanAwal" class="form-control @error('jabatanAwal') is-invalid @enderror">
                                @error('jabatanAwal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="jabatanBaru-field" class="mb-3">
                                <label for="jabatanBaru" class="form-label" >Jabatan Baru / Dept</label>
                                <input type="text" name="jabatanBaru" id="jabatanBaru" class="form-control @error('jabatanBaru') is-invalid @enderror">
                                @error('jabatanBaru')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="tglEfektif-field" class="mb-3">
                                <label for="tglEfektif" class="form-label" >Tanggal Efektif</label>
                                <input type="date" name="tglEfektif" id="tglEfektif" class="form-control @error('tglEfektif') is-invalid @enderror">
                                @error('tglEfektif')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div id="jabatan-field" class="mb-3" style="display: none;">
                            <label for="jabatan" class="form-label" >Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="departement-field" class="mb-3" style="display: none;">
                            <label for="departement" class="form-label" >Departement</label>
                            <input type="text" name="departement" id="departement"  class="form-control @error('departement') is-invalid @enderror">
                            @error('departement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="terhitungTgl-field" class="mb-3" style="display: none;">
                            <table style="width:745px;">
                                <tr>
                                    <td><label for="startingDate" class="form-label" >Terhitung dari tanggal</label></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
                                    <td><label for="endDate" class="form-label" >Sampai tanggal</label></td>
                                </tr>
                                <tr>
                                    <td><input type="date" name="startingDate" id="startingDate"  class="form-control @error('startingDate') is-invalid @enderror"></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
                                    <td><input type="date" name="endDate" id="endDate"  class="form-control @error('endDate') is-invalid @enderror"></td>
                                </tr>
                            </table>
                        </div>

                        <div id="divisi-field" class="mb-3" style="display: none;">
                            <label for="divisi" class="form-label">Untuk Divisi</label>
                            <select class="form-select @error('divisi') is-invalid @enderror" id="divisiSelect"
                                name="divisi" autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Divisi</option>
                                <option value="TNC" >Talent And Culture</option>
                                <option value="FIN-AR">Finance AR</option>
                                <option value="FIN-AP">Finance AP</option>
                                <option value="TAX" >TAX</option>
                                <option value="ACC" >Accounting</option>
                                <option value="MSS" >Marketing Sales and Shipping</option>
                                <option value="LEGAL" >LEGAL</option>
                                <option value="PRC" >Procurement</option>
                                <option value="IA" >Internal Audit</option>
                                <option value="IT" >IT</option>
                                <option value="Operation" >Operation</option>
                            </select>
                            <input type="hidden" id="divisi" name="divisi" value="{{ old('divisi') }}">
                            @error('idPerihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="tujuanSurat-field" class="mb-3" style="display: none;">
                            <label for="tujuanSurat" class="form-label" >Tujuan Surat</label>
                            <input type="text" name="tujuanSurat" id="tujuanSurat" placeholder="Surat ditujukan kepada..." class="form-control @error('jml_lampiran') is-invalid @enderror">
                            @error('tujuanSurat')
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

                                    function updateKeterangan() {
                                        if (perihalSelect.value === '1') {
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
                                                <p>Bersama ini kami sampaikan permohonan untuk dapat dilakukan test psikolog untuk pegawai kami atas nama :&nbsp;</p>
                                                <table style="border-collapse: collapse; width: 701px; margin-left: -0.274725%; height: 14px;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 9.2033%; text-align: center;">NO</td>
                                                            <td style="width: 39.1484%; text-align: center;">Nama</td>
                                                            <td style="width: 20.1141%; text-align: center;">Jabatan</td>
                                                            <td style="width: 32.097%; text-align: center;">No Handphone &amp; Email</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">1</td>
                                                            <td><br></td>
                                                            <td><br></td>
                                                            <td><br></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <br>
                                                <p>Untuk mengikuti psikotest untuk persyaratan menjadi karyawan PT Global Energi Lestari yang akan di adakan pada :&nbsp;</p>
                                                <p>Hari/Tanggal : Selasa, 6 Desember 2022</p>
                                                <p>Jam&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : 11.00 WIB s/d Selesai</p>
                                                <p><br></p>
                                                <p>Demikian surat permohonan ini dikeluarkan dan ditandatangani, atas perhatian dan kerjasamanya terima kasih.</p>
                                                `; // Reset or set other values based on different selections

                                        } else if (perihalSelect.value === '5') {
                                            keterangan.value = `<p><span>Dalam Rangka Menghadiri Undangan
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
                                        }else {
                                            keterangan.value=``;
                                        }
                                    }

                                    // Initial check
                                    updateKeterangan();

                                    // Update keterangan when the dropdown value changes
                                    perihalSelect.addEventListener('change', updateKeterangan);

                                });
                            </script>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="tglSurat" class="form-label">Tempat, Tanggal Surat</label>
                            <table>
                                <tr>
                                    <td>
                                        <input type="tmpt" class="form-control @error('tmpt') is-invalid @enderror"
                                            id="tmpt" name="tmpt" required value="{{ old('tmpt') }}"
                                            placeholder="Tempat Buat Surat">
                                    </td>
                                    <td> , </td>
                                    <td>
                                        <input type="date" class="form-control @error('tglSurat') is-invalid @enderror"
                                            id="tglSurat" name="tglSurat" required value="{{ old('tglSurat') }}">
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
                            <input type="text" class="form-control @error('y_buat') is-invalid @enderror" id="y_buat"
                                name="y_buat" required value="{{ old('y_buat') }}">
                            @error('y_buat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="jml-lampiran-field" class="mb-3" style="display: none;">
                            <label for="jml_lampiran" class="form-label" >Jumlah lampiran yang akan dilampirkan</label>
                            <input type="number" name="jml_lampiran" id="jml_lampiran" class="form-control @error('jml_lampiran') is-invalid @enderror">
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
                const terhitungTglField = document.getElementById('terhitungTgl-field');
                const mutasiField = document.getElementById('mutasi-field');
                const PKWTfield = document.getElementById('pkwt-field');




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


                    switch (perihalSelect.value) {
                        case '1':
                            // Show fields if value is 1
                            jml_lampiran.style.display = 'block';
                            upload_lampiran.style.display = 'block';
                            divisi.style.display = 'block';
                            keterangField.style.display = 'block';
                            break;

                        case '2':
                            // Show fields if value is 2
                            tujuanSurat.style.display = 'block';
                            keterangField.style.display = 'block';
                            break;

                        case '3':
                            // Show fields if value is 3
                            identitasField.style.display = 'block';
                            jabatanField.style.display = 'block';
                            departementField.style.display = 'block';
                            keterangField.style.display = 'none';
                            terhitungTglField.style.display = 'block';
                            break;

                        case '4':
                            // Show fields if value is 4
                            identitasField.style.display = 'block';
                            mutasiField.style.display = 'block';
                            break;


                        case '5':
                            // Show fields if value is 5
                            identitasField.style.display = 'block';
                            divisi.style.display = 'block';
                            keterangField.style.display = 'block';
                            break;


                        case '6':
                            // Show fields if value is 5
                            identitasField.style.display = 'block';
                            PKWTfield.style.display = 'block';
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
                };

                function setInitialNoSurat() {
                    const currentType = perihalSelect.value;
                    const maxNoSuratPerihal2 = {{ $maxNoSuratPerihal2 }};
                    const kop = document.getElementById('kop').value;
                    if (perihalSelect.value === '1') {
                        noSuratInput.value = (maxKopValues[kop] || 0) + 1;
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
                        '6': 'PERJANJIAN KERJA WAKTU TERTENTU',
                        '7': 'Paklaring',
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
                        '6': `No : TNC/${noSurat}/${kop}JKT/${romanMonth}/${year}`,
                        '7': `No:${noSurat}/${kop}/${romanMonth}/${year}`,
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
