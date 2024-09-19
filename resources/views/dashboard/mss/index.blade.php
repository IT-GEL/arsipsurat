@extends('dashboard.layouts.main')

@section('container')

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Surat Keterangan Marketing Sales Shipping</p>
                    <h6 class="mb-0">{{ $totalMSS }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Surat Divisi Marketing Sales Shipping</h6>
            <a href="/dashboard/mss/create" class="btn btn-primary"><i class="bi bi-file-text-fill"></i> Tambah Surat</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No Surat</th>
                        <th scope="col">Perihal Surat</th>
                        <th scope="col">Tanggal Surat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mss as $item)
                    <tr>
                        <td style="font-weight:bold;">{{ $item->prefix }}</td>
                        <td>{{ $item->perihal }}</td>
                        <td>{{ date('d M Y', strtotime($item->tglSurat)) }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="/dashboard/mss/{{ $item->id }}"><i class="bi bi-info-square"></i></a>
                            <a class="btn btn-sm btn-warning" href="/dashboard/mss/{{ $item->id }}/edit"><i class="bi bi-pencil-square"></i></a>
                            <form action="/dashboard/mss/{{ $item->noSurat }}" method="post" class="d-inline delete-form">
                                @method('delete')
                                @csrf 
                                <button type="button" class="btn btn-sm btn-danger border-0 delete-button"><i class="bi bi-trash"></i></button>
                            </form>
                            <a class="btn btn-sm btn-info" href="/dashboard/mss/{{ $item->id }}/cetak" target="_blank"><i class="bi bi-printer"></i></a>
                            |
                            <button class="btn btn-sm btn-secondary" onclick="berhasil(this)"><i class="bi bi-check2-square"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mss->links() }} <!-- Pagination links -->
        </div>
    </div>
</div>
<!-- Recent Sales End -->

<!-- SweetAlert CSS and JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css" rel="stylesheet">
<script type="text/javascript">

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
    // Change the button color to green
    button.classList.remove('btn-secondary');
    button.classList.add('btn-success');

    Swal.fire({
        title: "Approved!",
        text: "Berhasil di approve",
        icon: "success",
        confirmButtonText: "OK"
    });
}

</script>

@endsection
