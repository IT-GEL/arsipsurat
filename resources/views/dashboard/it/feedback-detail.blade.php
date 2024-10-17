@extends('dashboard.layouts.main')

@section('container')

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <center style="margin-top: 50px;">

            <!-- Applicant Details -->

            <table width="545">
                <tr>
                    <td>
                        <form action="{{ route('mss.approve', $fd->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('put')
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status"
                                name="status">
                                @if ($fd->status == 'Requested')
                                    <option value="Requested" selected>Requested</option>
                                    <option value="On Fix">On Fix</option>
                                    <option value="Complete">Complete</option>
                                @endif
                                @if ($fd->status == 'On Fix')
                                    <option value="On Fix" selected>On Fix</option>
                                    <option value="Complete">Complete</option>
                                @endif
                                @if ($fd->status == 'Complete')
                                    <option value="Complete" selected disabled readonly>Complete</option>
                                @endif
                            </select>
                            <button class="btn btn-primary">Update Status</button>
                        </form>
                    </td>
                </tr>
            </table>
            <br>
            <table width="545">
                <tr>
                    <td>Feedback :</td>
                </tr>
            </table>
<br><br>
            <table width="545">
                <tr>
                    <td>
                        {!! $fd->feedback !!}
                    </td>
                </tr>
            </table>
            <br /><br />

            <!-- Footer -->
            <br /><br /><br />
            <table width="545">
                <tr>
                    <td style="text-align: left"></td>
                </tr>
                <tr>
                    <td style="text-align: right">Dibuat Tanggal {{ $fd->created_at }}</td>
                </tr>
            </table>
            <br>

            <table width="400" style="margin-bottom: 100px">
                <tr>
                    <td style="text-align: right">Oleh {{ $fd->users }}</td>
                </tr>
            </table>
        </center>
    </div>
</div>
<!-- Recent Sales End -->

@endsection
