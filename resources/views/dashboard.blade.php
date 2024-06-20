@extends('admin-theme.theme-master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">


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
                    @include('admin-theme.wallet-details')
                </div>
                <div class="col-xl-6">
                    @include('admin-theme.wallet-balance')
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
                                <form id="payF" method="POST" style="display: none;">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="email" id="email" value="{{ auth()->user()->email }}">
                                    <input type="hidden" name="userid" id="userid" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="payment_for" value="become-agent">
                                </form>
                                <button type="submit" class="btn btn-modern text-2 btn-light border-0" onclick="pay()" style="font-size:15px; color:black">Become an Agent</a>                            </div>
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

@php
    $vpayApiKey = env('VPAY_API_KEY');
    $vpayApiDomain = env('VPAY_API_DOMAIN');
@endphp

<script src="https://dropin.vpay.africa/dropin/v1/initialise.js"></script>

<script>
    function generateTransactionRef() {
        const timestamp = Date.now();
        const randomNum = Math.floor(Math.random() * 1000000);
        return `trx-${timestamp}-${randomNum}`;
    }

    function pay() {
        const amount = 10000;
        const email = document.getElementById('email').value;
        const userId = document.getElementById('userid').value;
        const payment_for = 'become-agent';
        const payment_type = 'online-gateway';
        const transactionref = generateTransactionRef();

        const options = {
            domain: 'live',
            key: '9cc74024-6c63-48c4-930c-8ace6e388e1e',
            amount: amount,
            email: email,
            transactionref: transactionref,
            customer_service_channel: '+2348164418223, support@famcraft.ng',
            txn_charge: 6,
            txn_charge_type: 'flat', // or 'percentage'
            onSuccess: function(response) { 
                console.log('Transaction Successful!', response);
                const paymentData = {
                trxref: transactionref,
                reference: response.reference, // Assuming response contains a reference field
                user_id: userId,
                amount: amount,
                payment_for: payment_for,
                payment_type: payment_type,
                status: 'successful'
            };

            storePaymentData(paymentData);
            },
            onExit: function(response) { 
                console.log('Transaction Cancelled or Failed!', response);
            }
        };

        const dropinInstance = window.VPayDropin.create(options);
        dropinInstance.open();
    }
    
    function storePaymentData(paymentData) {
        fetch('/payment-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(paymentData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Payment data stored successfully!', data);
            } else {
                console.log('Failed to store payment data', data);
            }
        })
        .catch(error => {
            console.error('Error storing payment data:', error);
        });
    }
</script>
@endsection