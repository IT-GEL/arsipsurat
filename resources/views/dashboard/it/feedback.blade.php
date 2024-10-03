@extends('dashboard.layouts.main')

@section('container')

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
                <h6 class="mb-0">Daftar Feedback User</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama User yang Memberi Feedback</th>
                            <th scope="col">Tanggal Feedback</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fd as $index => $feedback)
                        <tr class="text-center">
                            <td>{{ $index + 1 }}</td> <!-- Auto increment -->
                            <td>{{ $feedback->users }}</td>
                            <td>{{ date('d M Y', strtotime($feedback->created_at)) }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('/feedback-show/', $feedback->id) }}">
                                    <i class="bi bi-info-square"></i>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
