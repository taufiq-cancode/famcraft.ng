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
                    <div class="d-flex">
                        <button type="button" class="mb-1 mt-1 me-1 btn btn-primary btn-block">Edit Profile</button>
                        <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary  btn-block">Change Password</button>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-lg-8 col-xl-8 mt-4">

            <section class="card card-featured-left card-featured-primary">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-primary" style="margin-top: 20px">
                                <i class="icons icon-wallet"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4><b>Wallet Details</b></h4>
                                <div class="info">
                                    <h5><b>Account Name:</b> {{ Illuminate\Support\Str::title(auth()->user()->first_name) }} {{ Illuminate\Support\Str::title(auth()->user()->last_name) }}</h5>
                                    <h5><b>Email:</b> {{ auth()->user()->email }}</h5>
                                    <a href="#modalSM" class="mb-1 mt-1 me-1 modal-sizes btn btn-sm btn-primary">Top up wallet</a>
                                    <div id="modalSM" class="modal-block modal-block-sm mfp-hide">
                                        <section class="card">
                                            <header class="card-header">
                                                <h2 class="card-title">Wallet Top-up</h2>
                                            </header>
                                            <div class="card-body">
                                                <div class="modal-wrapper">
                                                    <form id="paymentForm" action="{{ route('initializeTransaction') }}" class="form-horizontal form-bordered" method="POST"">
                                                        @csrf
                                                        @method('POST')
                            
                                                        <div class="form-group row pb-4">
                                                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Amount</label>
                                                            <div class="col-lg-6">
                                                                <input type="number" name="amount" class="form-control" id="inputDefault" placeholder="Enter top up amount">
                                                                <input type="hidden" name="email" id="email" value="{{ auth()->user()->email }}">
                                                                <input type="hidden" name="userid" id="userid" value="{{ auth()->user()->id }}">
                                                                <input type="hidden" name="payment_for" value="wallet-top-up">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <footer class="card-footer">
                                                <div class="row">
                                                    <div class="col-md-12 text-end">
                                                        <button onclick="event.preventDefault();document.getElementById('paymentForm').submit();" class="btn btn-primary modal-confirm">Proceed</button>
                                                        <button class="btn btn-default modal-dismiss">Cancel</button>
                                                    </div>
                                                </div>
                                            </footer>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="card card-featured-left card-featured-secondary">
                <div class="card-body">
                    <div class="widget-summary" style="margin: 12px 0 20px 0;">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary">
                                <i class="fa-solid fa-naira-sign"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4><b>Wallet Balance</b></h4>
                                <div class="info">
                                    @if(auth()->user()->wallet)
                                        <h5 style="font-size: 34px;">&#8358;{{ number_format(auth()->user()->wallet->balance, 2)}}</h5>
                                    @else
                                        <h5 style="font-size: 34px;">&#8358;0.00</h5>
                                    @endif   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
   

    </div>

    <div class="row mt-4">
        <div class="col">
            <section class="card mb-4">
                <header class="card-header">
                    <h2 class="card-title">Wallet Transaction History</h2>
                </header>
                <div class="card-body">
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
            </section>
        </div>
    </div>
    <!-- end: page -->


</section>

@endsection