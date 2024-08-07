@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- history -->
        <div class="row">
            <div class="col">
                <section class="card mb-4">
                    <header class="card-header">
                        <img src="{{ asset('img/logos/nimc2.jpg') }}" width="130" alt="NIMC" />
                    <br><br>
                        <h2 class="card-title">NIN Verification Submission</h2>
                    </header>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Agent Email</th>
                                        <th>Verification Method</th>
                                        <th>Slip Type</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Response</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td class="pt-desktop">{{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration }}</td>
                                            <td class="pt-desktop">{{ $transaction->user->email }}</td>
                                            <td class="pt-desktop">{{ $transaction->method }}</td>
                                            <td class="pt-desktop">{{ $transaction->slip_type }}</td>
                                            <td>{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                            <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
                                            <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->response) }}</td>
                                            <td class="actions">
                                                <a href="{{ route('view.verification',['verificationId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $transactions->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </section>
            </div>
        </div>

    <!-- end: page -->
</section>

@endsection