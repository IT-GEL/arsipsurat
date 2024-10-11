@extends('dashboard.layouts.main')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 mx-auto p-4" style="width: 210mm;">
                    <h6 class="mb-4">Edit Surat Keterangan Procurement</h6>
                    <form method="post" action="/dashboard/prc/{{ $prc->id }}">
                        @csrf

                        <input type="hidden" id="approve" name="approve" value="0">

                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat</label>
                            <input type="hidden" class="form-control @error('noSurat') is-invalid @enderror" id="noSurat"
                                name="noSurat" placeholder="Urutan Nomor Surat Terbaru" required
                                value="{{ old('noSurat', $prc->noSurat) }}">
                            <br>
                            <input type="text" class="form-control" id="prefixPO" name="prefixPO" readonly>
                            @error('noSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="idPerihal" class="form-label">Perihal Surat</label>
                            <select class="form-select @error('idPerihal') is-invalid @enderror" id="idPerihal"
                                name="idPerihal" required autofocus>
                                <option value="" disabled selected>Pilih Peruntukan Surat</option>
                                <option value="1">Purchase Order</option>
                            </select>
                            <input type="hidden" id="perihal" name="perihal" value="{{ old('perihal', $prc->perihal) }}">
                            @error('idPerihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kop" class="form-label">Pilih Kop Surat</label>
                            <select class="form-select @error('kop') is-invalid @enderror" id="kop" name="kop"
                                required autofocus>
                                <option value="" selected>Tanpa Kop</option>
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
                            <label for="vendor" class="form-label">Vendor</label>
                            <input type="text" class="form-control @error('y_buat') is-invalid @enderror" id="vendor"
                                name="vendor" required value="{{ old('vendor') }}">
                            @error('vendor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="faxno" class="form-label">Fax No.</label>
                            <input type="text" class="form-control @error('y_buat') is-invalid @enderror" id="faxno"
                                name="faxno" required value="{{ old('faxno') }}">
                            @error('faxno')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="att" class="form-label">Att</label>
                            <input type="text" class="form-control @error('y_buat') is-invalid @enderror" id="att"
                                name="att" required value="{{ old('att') }}">
                            @error('att')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prno" class="form-label">PR No</label>
                            <table>
                                <tr>
                                    <td width="200"><input type="text"
                                            class="form-control @error('prno') is-invalid @enderror" id="prno"
                                            onchange="prnoOnChange()" name="prno" required value="{{ old('prno') }}">
                                    </td>
                                    <td width="545"><input type="text"
                                            class="form-control @error('prefixPR') is-invalid @enderror" id="prefixPR"
                                            name="prefixPR" required value="{{ old('prefixPR') }}" readonly></td>
                                </tr>
                            </table>
                            @error('prno')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quotereff" class="form-label">Quote Reff</label>
                            <table>
                                <tr>
                                    <td width="200"><input type="text"
                                            class="form-control @error('prno') is-invalid @enderror" id="quotereff"
                                            onchange="prnoOnChange()" name="quotereff" required
                                            value="{{ old('prno') }}"></td>
                                    <td width="545"><input type="text"
                                            class="form-control @error('prefixQuote') is-invalid @enderror"
                                            id="prefixQuote" name="prefixQuote" required
                                            value="{{ old('prefixQuote') }}" readonly></td>
                                </tr>
                            </table>
                            @error('prno')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="top" class="form-label">Term Of Payment</label>
                            <select class="form-select @error('top') is-invalid @enderror" id="top" name="top"
                                required autofocus>
                                <option value="" selected>Pilih</option>
                                <option value="CBD">CBD</option>
                                <option value="COD">COD</option>
                                <option value="CIA">CIA</option>
                                <option value="NET30">NET 30</option>
                                <option value="NETEOM">NET EOM</option>
                            </select>
                            @error('top')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="keterangan" class="form-label">Daftar Order</label>
                        <div id="keterangan-field" class="mb-3 rounded p-3" style="background-color: white">
                            <div id="items-container">
                                @php $itemCount = isset($items) ? count($items) : 1; @endphp
                                @for ($i = 1; $i <= $itemCount; $i++)
                                    <div class="item rounded border border-secondary p-3 mb-3"
                                        id="item-{{ $i }}">
                                        <label for="keterangan" class="form-label">Deskripsi</label>
                                        <input type="text" class="form-control" id="deskripsi-{{ $i }}"
                                            name="items[{{ $i }}][deskripsi]" required
                                            value="{{ old('items.' . $i . '.deskripsi', $items[$i]['deskripsi'] ?? '') }}">

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="qty-{{ $i }}" class="form-label">Qty</label>
                                                <input type="text" class="form-control" id="qty-{{ $i }}"
                                                    name="items[{{ $i }}][qty]" required
                                                    value="{{ old('items.' . $i . '.qty', $items[$i]['qty'] ?? '') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="satuan-{{ $i }}" class="form-label">Satuan</label>
                                                <input type="text" class="form-control"
                                                    id="satuan-{{ $i }}"
                                                    name="items[{{ $i }}][satuan]" required
                                                    value="{{ old('items.' . $i . '.satuan', $items[$i]['satuan'] ?? '') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="harga-{{ $i }}" class="form-label">Harga</label>
                                                <input type="text" class="form-control"
                                                    id="harga-{{ $i }}"
                                                    name="items[{{ $i }}][harga]" required
                                                    value="{{ old('items.' . $i . '.harga', $items[$i]['harga'] ?? '') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="total-{{ $i }}" class="form-label">Total</label>
                                                <input type="text" class="form-control"
                                                    id="total-{{ $i }}"
                                                    name="items[{{ $i }}][total]" readonly
                                                    value="{{ old('items.' . $i . '.total', $items[$i]['total'] ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="supply-{{ $i }}" class="form-label">Supply
                                                    (ETA)</label>
                                                <input type="date" class="form-control"
                                                    id="supply-{{ $i }}"
                                                    name="items[{{ $i }}][supply]" required
                                                    value="{{ old('items.' . $i . '.supply', $items[$i]['supply'] ?? '') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="partno-{{ $i }}" class="form-label">Part
                                                    Number</label>
                                                <input type="text" class="form-control"
                                                    id="partno-{{ $i }}"
                                                    name="items[{{ $i }}][partno]" required
                                                    value="{{ old('items.' . $i . '.partno', $items[$i]['partno'] ?? '') }}">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger mt-3 delete-item">Hapus Item</button>
                                    </div>
                                @endfor
                            </div>
                            <button type="button" class="btn btn-secondary mt-3" id="add-item">Tambah Item</button>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const itemsContainer = document.getElementById('items-container');
                                    const addItemButton = document.getElementById('add-item');
                                    let itemCount = {{ $itemCount }}; // Start item count based on the number of items

                                    function calculateTotal(item) {
                                        const qtyInput = item.querySelector('[name^="items"][name$="[qty]"]');
                                        const hargaInput = item.querySelector('[name^="items"][name$="[harga]"]');
                                        const totalInput = item.querySelector('[name^="items"][name$="[total]"]');
                                        const qty = parseFloat(qtyInput.value) || 0;
                                        const harga = parseFloat(hargaInput.value) || 0;
                                        totalInput.value = qty * harga;
                                    }

                                    function addItem() {
                                        itemCount++;
                                        const newItem = document.querySelector('.item').cloneNode(true);
                                        newItem.id = `item-${itemCount}`;
                                        newItem.querySelectorAll('input').forEach(input => {
                                            const name = input.name.replace(/\d+/, itemCount); // Adjust index in name
                                            input.name = name;
                                            input.id = name;
                                            input.value = '';
                                        });
                                        itemsContainer.appendChild(newItem);

                                        newItem.querySelector('[name$="[qty]"]').addEventListener('input', () => calculateTotal(newItem));
                                        newItem.querySelector('[name$="[harga]"]').addEventListener('input', () => calculateTotal(newItem));
                                        newItem.querySelector('.delete-item').addEventListener('click', () => deleteItem(newItem));

                                        updateDeleteButtons();
                                    }

                                    function deleteItem(item) {
                                        item.remove();
                                        itemCount--;
                                        updateDeleteButtons();
                                    }

                                    function updateDeleteButtons() {
                                        const deleteButtons = document.querySelectorAll('.delete-item');
                                        if (deleteButtons.length === 1) {
                                            deleteButtons[0].disabled = true;
                                        } else {
                                            deleteButtons.forEach(button => button.disabled = false);
                                        }
                                    }

                                    addItemButton.addEventListener('click', addItem);

                                    document.querySelectorAll('.item').forEach(item => {
                                        item.querySelector('[name$="[qty]"]').addEventListener('input', () => calculateTotal(item));
                                        item.querySelector('[name$="[harga]"]').addEventListener('input', () => calculateTotal(
                                            item));
                                        item.querySelector('.delete-item').addEventListener('click', () => deleteItem(item));
                                    });

                                    updateDeleteButtons();
                                });
                            </script>
                        </div>

                        <div class="mb-3">
                            <label for="faxno" class="form-label">Delivery Date</label>
                            <textarea type="text" class="form-control @error('y_buat') is-invalid @enderror" id="devdate" name="devdate"
                                required value="{{ old('faxno') }}"></textarea>
                            @error('faxno')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="faxno" class="form-label">Delivery To</label>
                            <textarea type="text" class="form-control @error('y_buat') is-invalid @enderror" id="devto" name="devto"
                                required value="{{ old('faxno') }}"></textarea>
                            @error('faxno')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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

                        <div class="mb-3">
                            <label for="ttd" class="form-label">Approval</label>
                            <select class="form-select @error('ttd') is-invalid @enderror" id="ttd" name="ttd"
                                required autofocus>
                                <option value="" disabled selected>Yang akan approve...</option>
                                <option value="Capt. John Herley">Capt. John Herley</option>
                                <option value="Kendrick Winata">Kendrick Winata</option>
                            </select>
                            <input type="hidden" id="jabatan" name="jabatan" value="">
                            @error('ttd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>





                        <div class="mb-3">
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
                const noSuratInput = document.getElementById('noSurat');
                const suratizinGroup = document.getElementById('surat-izin');
                const keteranganField = document.getElementById('keterangan-field');
                const ket = document.getElementById('keterangan');
                const prefixInput = document.getElementById('prefixPO');
                const tglSuratInput = document.getElementById('tglSurat');
                const jabatanInput = document.getElementById('jabatan');
                const jabatanSelect = document.getElementById('ttd');
                const tglSurat = new Date(tglSuratInput.value);
                const romanMonth = toRoman(tglSurat.getMonth() + 1);
                const year = tglSurat.getFullYear();
                const prnoInput = document.getElementById('prno');
                let kop;

                document.getElementById('kop').addEventListener('change', function() {
                    kop = this.value;
                    updatePrefix();
                });

                const PADDING_LENGTH = 3;

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


                function setInitialNoSurat() {
                    const currentType = perihalSelect.value;
                    noSuratInput.value = (maxValues[currentType] || 0) + 1;
                }

                jabatanSelect.addEventListener('change', function() {
                    const jabatanInput = document.getElementById('jabatan');
                    switch (this.value) {
                        case 'Capt. John Herley':
                            jabatanInput.value = 'Manager Operasional';
                            console.log(jabatanInput.value);
                            break;
                        case 'Kendrick Winata':
                            jabatanInput.value = 'Direktur';
                            console.log(jabatanInput.value);
                            break;
                        default:
                            jabatanInput.value = '';
                    }
                })

                perihalSelect.addEventListener('change', function() {
                    const selectedValue = this.value;
                    const perihalInput = document.getElementById('perihal');

                    const perihalMap = {
                        '1': 'Purchase Order',
                        '2': 'Cop Bank',
                        '3': 'BPJS',
                        '4': 'Surat Tugas',
                        '5': 'Offering Letter',
                        '6': 'Paklaring',
                    };
                    perihalInput.value = perihalMap[selectedValue] || '';
                    handleFieldUpdates();
                });

                function updatePrefix() {
                    const noSurat = String(noSuratInput.value || '0').padStart(PADDING_LENGTH, '0');


                    const prefixMap = {
                        '1': `No:-${noSurat}/${kop}/${romanMonth}/${year}`,
                    };

                    prefixInput.value = prefixMap[perihalSelect.value] || '';
                }

                prnoInput.addEventListener('change', function() {
                    var PRNO = document.getElementById('prno').value;

                    var PPR = document.getElementById('prefixPR');

                    PPR.value = PRNO + '/SVY/' + kop + '/' + romanMonth + '/' + year;
                    handleFieldUpdates();

                })

                function toRoman(num) {
                    const roman = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
                    return roman[num - 1] || '';
                }

                function handleFieldUpdates() {
                    kop = document.getElementById('kop').value;
                    setInitialNoSurat();
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
