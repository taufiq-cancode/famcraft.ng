@extends('admin-theme.theme-master')
@section('content')

<style>
    .pricing-table [class*="col-lg-"] {
        padding-left: 0px;
        padding-right: 10px !important;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none; 
        margin: 0; 
    }

    input[type="number"] {
        -moz-appearance: textfield; 
    }
</style>

<section role="main" class="content-body">

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-xl-6">
                    @include('admin-theme.wallet-details')
                </div>
                <div class="col-xl-6">
                    @if(auth()->user()->role === 'Staff')
                        @include('admin-theme.wallet-balance-staff')
                    @else
                        @include('admin-theme.wallet-balance')
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    
    @if(auth()->user()->role === 'Staff')
        <div class="row">
            <div class="col">
                <section class="card mb-4">
                    <header class="card-header">
                        <h2 class="card-title">Withdrawal History</h2>
                    </header>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrawals as $transaction)
                                        <tr>
                                            <td class="pt-desktop">{{ $loop->iteration }}</td>
                                            <td class="pt-desktop">&#8358;{{ number_format($transaction->amount) }}</td>
                                            <td>{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                            <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
                                            <td class="actions">
                                                <a href="{{ route('view.withdrawal',['withdrawalId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <section class="card mb-4">
                <header class="card-header">
                    <h2 class="card-title">Transaction History</h2>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Transaction For</th>
                                    {{-- <th>Payment Method</th> --}}
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td class="pt-desktop">{{ $loop->iteration }}</td>
                                        <td class="pt-desktop">{{ $transaction->payment_for }}</td>
                                        {{-- <td class="pt-desktop">{{ $transaction->payment_type }}</td> --}}
                                        <td class="pt-desktop">&#8358;{{ number_format($transaction->amount) }}</td>
                                        <td>{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>



</section>

@endsection