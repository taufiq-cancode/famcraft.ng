@extends('admin-theme.theme-master')
@section('content')

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
                                            <h5><b>Account Name:</b> Taofeek Adekunle</h5>
                                            <h5><b>Bank Name:</b> Paystack Titan</h5>
                                            <h5><b>Account Number:</b> 0223611578</h5>
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
                            <div class="widget-summary" style="margin: 20px 0 20px 0;">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-secondary">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4><b>Wallet Balance</b></h4>
                                        <div class="info">
                                            <h5 style="font-size: 33px;">N140,890.30</h5>
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

    <div class="row mt-desktop" >
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
    </div>

    <h2 class="font-weight-semibold mt-desktop" style="font-size: 1.5em;color: black;">NIN Services</h2>

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
                                <a href="http://themeforest.net/item/porto-responsive-html5-template/4106987" target="_blank" class="btn btn-modern text-2 btn-light border-0" style="font-size:15px; color:black">Become an Agent</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


    <!-- end: page -->
</section>

@endsection