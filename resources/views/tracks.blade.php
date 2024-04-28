@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body">
 
    <div class="row mt-4">
        <div class="col">
            <section class="card mb-4">
                <header class="card-header">
                    <h2 class="card-title">Transaction History</h2>
                </header>
                <div class="card-body">
                    <table class="table table-responsive-md mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Transaction ID</th>
                                <th>Transaction Type</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="pt-desktop">{{ $loop->iteration }}</td>
                                    <td class="pt-desktop">{{ $transaction->transaction_id }}</td>
                                    <td class="pt-desktop">{{ $transaction->transaction_type }}</td>
                                    <td class="pt-desktop">&#8358;{{ number_format($transaction->price) }}</td>
                                    <td>{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                    <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
                                    <td class="actions">
                                        @if($transaction->transaction_type === 'Modification')
                                            <a href="{{ route('view.modification',['modificationId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
                                        @elseif($transaction->transaction_type === 'PUK Retrieval')
                                            <a href="{{ route('view.puk',['pukTransactionId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
                                        @elseif($transaction->transaction_type === 'Validation')
                                            <a href="{{ route('view.validation',['validationId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
                                        @elseif($transaction->transaction_type === 'IPE Clearance')
                                            <a href="{{ route('view.ipe-clearance',['ipeId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
                                        @elseif($transaction->transaction_type === 'New Enrollment')
                                            <a href="{{ route('view.new-enrollment',['enrollmentId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>                                       
                                        @elseif($transaction->transaction_type === 'Personalization')
                                            <a href="{{ route('view.personalization',['personalizationId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>                                       
                                        @elseif($transaction->transaction_type === 'Verification')
                                            <a href="{{ route('view.verification',['verificationId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>                                       
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

</section>

@endsection