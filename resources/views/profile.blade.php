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

    .btn-secondary{
        border: 0px;
    }
    .btn-secondary:focus, html .btn-secondary.focus {
        box-shadow: 0 0 0 3px transparent;
        background-color: #E36159;
        border-color: transparent;
    }
</style>

<section role="main" class="content-body">
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-4 col-xl-4 mb-4 mb-xl-0 mt-4">
            <section class="card">
                <div class="card-body">
                    <div class="thumb-info mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ Illuminate\Support\Str::title(auth()->user()->first_name) }}+{{ Illuminate\Support\Str::title(auth()->user()->last_name) }}&background=1f2937&color=fff" width="250px" class="rounded img-fluid" alt="John Doe">
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner">{{ Illuminate\Support\Str::title(auth()->user()->first_name) }} {{ Illuminate\Support\Str::title(auth()->user()->last_name) }}</span>
                            <span class="thumb-info-type">{{ Illuminate\Support\Str::title(auth()->user()->role) }} </span>
                        </div>
                    </div>
                    
                    @if(auth()->check())
                        <p>
                            Your referral link: 
                            <a id="referralLink">
                                {{ auth()->user()->referral_link }}
                            </a>
                            <button id="copyButton" type="button" style="width:100%" class="mb-1 mt-1 me-1 btn btn-secondary btn-block">
                                Copy Referral Link
                            </button>                        
                        </p>
                    @endif

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const copyButton = document.getElementById('copyButton');
                            const referralLink = document.getElementById('referralLink');

                            copyButton.addEventListener('click', function() {
                                const link = referralLink.href;
                                navigator.clipboard.writeText(link).then(() => {
                                    copyButton.textContent = 'Copied!';
                                    copyButton.style.backgroundColor = 'green';

                                    // Revert back after 2 seconds
                                    setTimeout(() => {
                                        copyButton.textContent = 'Copy Referral Link';
                                        copyButton.style.backgroundColor = '';
                                    }, 2000);
                                }).catch(err => {
                                    console.error('Failed to copy: ', err);
                                });
                            });
                        });
                    </script>

                </div>
            </section>
        </div>
        <div class="col-lg-8 col-xl-8 mt-4">
            @include('admin-theme.wallet-details');
            
            <div style="margin-top: -20px !important;">
                @include('admin-theme.wallet-balance');
            </div>    
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <section class="card mb-4">
                <header class="card-header">
                    <h2 class="card-title">Wallet Transaction History</h2>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Transaction Type</th>
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
                                        <td class="pt-desktop">&#8358;{{ number_format($transaction->amount) }}</td>
                                        <td>{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
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

    <div class="row mt-4">
        <div class="col">
            <section class="card mb-4">
                <header class="card-header">
                    <h2 class="card-title">Referral History</h2>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($referrals as $referral)
                                    <tr>
                                        <td class="pt-desktop">{{ $loop->iteration }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($referral->first_name) }} {{ Illuminate\Support\Str::title($referral->last_name) }}</td>
                                        <td>{{ $referral->created_at->format('jS F, Y') }} <br> {{ $referral->created_at->format('g:i A') }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($referral->role) }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $referrals->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->


</section>

@endsection