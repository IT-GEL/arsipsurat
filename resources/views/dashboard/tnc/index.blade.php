@extends('dashboard.layouts.main')

@section('container')

    @if (auth()->user()->username == 'tnc' || auth()->user()->username == 'sudosu' || auth()->user()->username == 'head.tnc')
        <!-- Sale & Revenue Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-5">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-line fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Surat Keterangan Talent and Culture</p>
                            <h6 class="mb-0">{{ $totalTNC }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sale & Revenue End -->

        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Daftar Surat Divisi Talent and Culture</h6>
                    <div class="d-flex align-items-center mb-4">
                        <label for="sortOptions" class="form-label me-2">Sort By:</label>
                        <form method="GET" action="{{ url('/dashboard/tnc') }}" class="d-flex align-items-center">
                            <select id="sortOptions" name="sort" class="form-select me-2" onchange="this.form.submit()">
                                <option value="all" {{ request('sort') == 'all' ? 'selected' : '' }}>All</option>
                                <option value="today" {{ request('sort') == 'today' ? 'selected' : '' }}>Today</option>
                                <option value="tomorrow" {{ request('sort') == 'tomorrow' ? 'selected' : '' }}>Tomorrow
                                </option>
                                <option value="custom" {{ request('sort') == 'custom' ? 'selected' : '' }}>Custom Date
                                </option>
                            </select>
                            <div id="customDateInput"
                                style="display: {{ request('sort') == 'custom' ? 'block' : 'none' }};">
                                <input type="date" id="customDate" name="customDate" class="form-control me-2"
                                    value="{{ request('customDate') }}" onchange="this.form.submit()">
                            </div>
                        </form>
                        <a href="{{ url('/dashboard/tnc/create') }}" class="btn btn-primary"><i
                                class="bi bi-file-text-fill"></i> Tambah Surat</a>
                    </div>


                </div>

                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col"><a
                                        href="{{ request()->fullUrlWithQuery(['sort_by' => 'noSurat', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">No
                                        Surat
                                        @if(request('sort_by') == 'noSurat')
                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </a></th>
                                <th scope="col"><a
                                        href="{{ request()->fullUrlWithQuery(['sort_by' => 'perihal', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Perihal
                                        Surat
                                        @if(request('sort_by') == 'perihal')
                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </a></th>
                                <th scope="col"><a
                                        href="{{ request()->fullUrlWithQuery(['sort_by' => 'tglSurat', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Tanggal
                                        Surat
                                        @if(request('sort_by') == 'tglSurat')
                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </a></th>
                                <th scope="col"><a
                                        href="{{ request()->fullUrlWithQuery(['sort_by' => 'approve', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Status
                                        @if(request('sort_by') == 'approve')
                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </a></th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tncTable">
                            @foreach ($tnc as $item)
                                <tr>
                                    <td style="font-weight:bold;">{{ $item->prefix }}</td>
                                    <td>@if($item->idPerihal == '6')PKWT-{{ $item->namaKaryawan }}@else{{ $item->perihal }}@endif</td>
                                    <td>{{ date('d M Y', strtotime($item->tglSurat)) }}</td>
                                    <td>
                                        @if ($item->approve == '1')
                                            <i class="bi bi-check2-square"> Approved </i>
                                        @elseif($item->approve == '2')
                                            <i class="bi bi-x-circle"></i> Not Approved </i>
                                        @elseif($item->approve == '0')
                                            <i class="bi bi-question-circle"></i> Waiting for Approval </i>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ url('/dashboard/tnc/' . $item->id) }}"><i
                                                class="bi bi-info-square"></i></a>
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ url('/dashboard/tnc/' . $item->id . '/edit') }}"
                                            @if ($item->approve == '1') style="pointer-events:none; opacity:0.5;" @endif><i
                                                class="bi bi-pencil-square"></i></a>
                                        <form action="{{ url('/dashboard/tnc/' . $item->id) }}" method="post"
                                            class="d-inline delete-form">
                                            @method('delete')
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-danger border-0 delete-button"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>


                                        <form action="{{ route('tnc.approve', $item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="approve" value="yes">

                                            <button class="btn btn-sm {{ $item->approve ? 'btn-success' : 'btn-secondary' }}"
                                                    data-approved="{{ $item->approve }}"
                                                    onclick="{{ $item->approve ? 'return false;' : 'berhasil(this);' }}"
                                                    {{ $item->approve ? 'disabled' : '' }}>
                                                <i class="bi bi-check2-square"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tnc->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->
    @endif

    <script type="text/javascript">
        function filterTable() {
            const sortOption = document.getElementById('sortOptions').value;
            const customDateInput = document.getElementById('customDate');
            const customDate = new Date(customDateInput.value);
            const rows = Array.from(document.querySelectorAll('#tncTable tr'));

            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);

            rows.forEach(row => {
                const dateCell = new Date(row.cells[2].innerText);

                if (sortOption === 'today' && dateCell.toDateString() !== today.toDateString()) {
                    row.style.display = 'none';
                } else if (sortOption === 'tomorrow' && dateCell.toDateString() !== tomorrow.toDateString()) {
                    row.style.display = 'none';
                } else if (sortOption === 'custom' && customDateInput.value && dateCell.toDateString() !==
                    customDate.toDateString()) {
                    row.style.display = 'none';
                } else {
                    row.style.display = ''; // Show the row
                }
            });
        }

        // Toggle custom date input visibility
        document.getElementById('sortOptions').addEventListener('change', function() {
            const customDateInput = document.getElementById('customDateInput');
            customDateInput.style.display = this.value === 'custom' ? 'block' : 'none';
        });

        // Delete confirmation
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                swalWithBootstrapButtons.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form if confirmed
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelled",
                            text: "Your imaginary file is safe :)",
                            icon: "error"
                        });
                    }
                });
            });
        });

        function berhasil(button) {
            const isApproved = button.getAttribute('data-approved') === 'true';

            if (!isApproved) {
                button.classList.remove('btn-secondary');
                button.classList.add('btn-success');
                button.setAttribute('data-approved', 'true');
                button.disabled = true; // Disable to prevent double submissions

                Swal.fire({
                    title: "Approved!",
                    text: "Berhasil di approve",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    button.closest('form').submit(); // Submit the form
                });
            } else {
                Swal.fire({
                    title: "Already Approved!",
                    text: "This document has already been approved.",
                    icon: "info",
                    confirmButtonText: "OK"
                });
            }
        }
    </script>

@endsection
