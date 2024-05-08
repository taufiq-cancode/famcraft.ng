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

    @media screen and (max-width:798px) {
        .mt-desktop-2 {
            margin-top: 0px !important;
        }
    }
</style>

<section role="main" class="content-body">
    <header class="page-header page-header-left-breadcrumb">
        <h2 class="font-weight-semibold mt-4" style="font-size: 1.8em;color: black;">Welcome, {{ Illuminate\Support\Str::title(auth()->user()->first_name) }}! &#128075;  </h2>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-xl-6">
                    <section class="card card-featured-left card-featured-primary mb-3">
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
                                                            {{-- <form id="payForm" action="{{ route('initializeTransaction') }}" class="form-horizontal form-bordered" method="POST""> --}}
                                                            <form id="payForm" action="#" class="form-horizontal form-bordered" method="POST"">
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
                                                                {{-- <button onclick="event.preventDefault();document.getElementById('payForm').submit();" class="btn btn-primary modal-confirm">Proceed</button> --}}
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
                </div>
                <div class="col-xl-6">
                    <section class="card card-featured-left card-featured-secondary">
                        <div class="card-body">
                            <div class="widget-summary" style="margin: 25px 0;">
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
            
        </div>
    </div>

    {{-- <div class="row mt-desktop" >
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-xl-3">
                    <section class="card mb-4">
                        <a href="{{ route('airtime') }}">
                            <div class="card-body bg-primary">
                                <div class="widget-summary custom-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon custom-icon" style="margin-top:10px">
                                            <i class="icons icon-call-out" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <div class="info">
                                                <h4 class="h4-service" style="color: white; font-size:20px">Purchase Airtime</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                </div>

                <div class="col-xl-3">
                    <section class="card mb-4">
                        <a href="{{ route('data') }}">
                            <div class="card-body bg-primary">
                                <div class="widget-summary custom-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon custom-icon" style="margin-top:10px">
                                            <i class="icons icon-globe" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <div class="info">
                                                <h4 class="h4-service" style="color: white; font-size:20px">Purchase Data</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                </div>

                <div class="col-xl-3">
                    <section class="card mb-4">
                        <a href="{{ route('cable-tv') }}">
                            <div class="card-body bg-primary">
                                <div class="widget-summary custom-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon custom-icon" style="margin-top:10px">
                                            <i class="icons icon-screen-desktop" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <div class="info">
                                                <h4 class="h4-service" style="color: white; font-size:20px">Pay Cable TV</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </section>
                </div>

                <div class="col-xl-3">
                    <section class="card mb-4">
                        <a href="{{ route('airtime-cash') }}">
                            <div class="card-body bg-primary card-hov">
                                <div class="widget-summary custom-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon custom-icon" style="margin-top:10px">
                                            <i class="fa-solid fa-naira-sign fa-fw" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <div class="info">
                                                <h4 class="h4-service" style="color: white; font-size:20px">Airtime to Cash</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                </div>

               
                
            </div>
            
        </div>
    </div> --}}

@if (auth()->user()->role !== 'Agent')

    <div class="row mt-desktop-2">
        <div class="col-12">
            <section class="card mb-4">
                <div class="card-body bg-secondary">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="cta">
                                <h3>Access our <strong>NIN services</strong></h3>
                                <p class="mb-4">Become an agent to access NIN services such as Validation, Verification, IPE Clearance, New Enrollment, Modification and Personalization of NIMC document </p>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="cta-btn">
                                {{-- <form id="paymentForm" action="{{ route('initializeTransaction') }}" method="POST" style="display: none;"> --}}
                                <form id="paymentForm" action="#" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="email" id="email" value="{{ auth()->user()->email }}">
                                    <input type="hidden" name="userid" id="userid" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="payment_for" value="become-agent">
                                    <input type="hidden" name="amount" id="amount" value="10000">
                                </form>
                                {{-- <a href="{{ route('initializeTransaction') }}" onclick="event.preventDefault();document.getElementById('paymentForm').submit();" class="btn btn-modern text-2 btn-light border-0" style="font-size:15px; color:black">Become an Agent</a>                            </div>                                 --}}
                                <a href="#" class="btn btn-modern text-2 btn-light border-0" style="font-size:15px; color:black">Become an Agent</a>                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
@else

    <h2 class="font-weight-semibold mt-desktop" style="font-size: 1.5em;color: black;">NIN Services</h2>

    <div class="row mt-desktop">
        <div class="col-12">
            
            <section class="card">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h3><strong>Notice!</strong></h3>
                    <p style="color: black">All our services duration are intact. However, in some cases where unforeseen circumstances arise, it may take up few more hours to complete. <br> Please note that weekends (Saturdays and Sundays) are excluded from the processing time which means that all requests submitted during weekends will be processed on the next working day. This also applies to public holidays as they are considered non-working days.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
                </div>
            </section>
        </div>
    </div>

    <div class="row" >
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-xl-4">
                    <section class="card mb-4">
                        <a href="{{ route('verification') }}">
                            <div class="card-body bg-success">
                                <div class="widget-summary custom-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon custom-icon" style="margin-top:10px">
                                            <i class="fa-solid fa-certificate"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <div class="info">
                                                <h4 class="h4-service pt-3" style="color: white; font-size:20px">Verification</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                </div>

                <div class="col-xl-4">
                    <section class="card mb-4">
                        <a href="{{ route('validation') }}">
                            <div class="card-body bg-success">
                                <div class="widget-summary custom-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon custom-icon" style="margin-top:10px">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <div class="info">
                                                <h4 class="h4-service pt-3" style="color: white; font-size:20px">Validation</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                </div>

                <div class="col-xl-4">
                    <section class="card mb-4">
                        <a href="{{ route('ipe-clearance') }}">
                            <div class="card-body bg-success">
                                <div class="widget-summary custom-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon custom-icon" style="margin-top:10px">
                                            <i class="fa-solid fa-check-double"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <div class="info">
                                                <h4 class="h4-service pt-3" style="color: white; font-size:20px">IPE Clearance</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                </div>                
            </div>

            <div class="row mb-3">
                <div class="col-xl-4">
                    <section class="card mb-4">
                        <a href="{{ route('new-enrollment') }}">
                            <div class="card-body bg-success">
                                <div class="widget-summary custom-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon custom-icon" style="margin-top:10px">
                                            <i class="fa-regular fa-folder-open"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <div class="info">
                                                <h4 class="h4-service pt-3" style="color: white; font-size:20px">New Enrollment</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                </div>

                <div class="col-xl-4">
                    <section class="card mb-4">
                        <a href="{{ route('modification') }}">
                            <div class="card-body bg-success">
                                <div class="widget-summary custom-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon custom-icon" style="margin-top:10px">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <div class="info">
                                                <h4 class="h4-service pt-3" style="color: white; font-size:20px">Modification</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                </div>

                <div class="col-xl-4">
                    <section class="card mb-4">
                        <a href="{{ route('personalization') }}">
                            <div class="card-body bg-success">
                                <div class="widget-summary custom-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon custom-icon" style="margin-top:10px">
                                            <i class="fa-solid fa-user-pen"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <div class="info">
                                                <h4 class="h4-service pt-3" style="color: white; font-size:20px"> &nbsp; Personalization</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                </div>                
            </div>
        </div>
    </div>

    <div class="row mt-desktop-2">
        <div class="col-12">
            <section class="card mb-4">
                <div class="card-body bg-success">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="cta">
                                <br>
                                <h3>Join our <strong>WhatsApp group</strong></h3>
                                <p class="mb-4">Join our whatsapp group to get exlusive update and feedbacks</p>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="cta-btn">
                                <a href="https://chat.whatsapp.com/HjN7zXVq6UMDpuMo5dDEBs" class="btn btn-modern text-2 btn-light border-0" style="font-size:15px; color:black"> <i class="fab fa-whatsapp"></i> Join group</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <h2 class="font-weight-semibold mt-desktop" style="font-size: 1.5em;color: black;">Pricing</h2>

    <div class="row mt-desktop">
        <div class="col">
            <div class="pricing-table princig-table-flat row no-gutters mt-3 mb-3">
                @foreach ($pricing_categories as $pricing_category)
                    <div class="col-lg-3 col-sm-6 mb-4">
                        <div class="plan">
                            <h3><span>{{ $pricing_category->name }}</span>Duration: <b>{{ $pricing_category->duration }}</b></h3>
                            <ul>
                                @foreach ($pricing_category->pricings as $pricing)
                                    <li><strong>&#8358;{{ number_format($pricing->price)}} </strong> - {{ $pricing->item_name }}</li>                                    
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

 

    
@endif
</section>

<script>
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var numberInput = document.getElementById('numberInput').value;

        var numberWithoutComma = numberInput.replace(/,/g, '');

        document.getElementById('numberInput').value = numberWithoutComma;

        // Submit the form programmatically
        this.submit();
    });
</script>
@endsection