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
                                <a href="{{ route('makeAgent') }}" class="btn btn-modern text-2 btn-light border-0" style="font-size:15px; color:black">Become an Agent</a>
                            </div>
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

    <h2 class="font-weight-semibold mt-desktop" style="font-size: 1.5em;color: black;">Pricing</h2>


    <div class="pricing-table princig-table-flat row no-gutters mt-3 mb-3">
        <div class="col-lg-3 col-sm-6">
            <div class="plan">
                <h3><span>Modification</span>Duration: <b>48 - 96 Hours</b></h3>
                <ul>
                    <li><strong>&#8358;5,000</strong> for Name Modification</li>
                    <li><strong>&#8358;10,000</strong> for D.O.B Modification</li>
                    <li><strong>&#8358;13,000</strong> for both Name & D.O.B Modification</li>
                    <li><strong>&#8358;8,000</strong> for Name & Other Modification</li>
                    <li><strong>&#8358;15,000</strong> for DOB & Other Modification</li>
                    <li><strong>&#8358;5,000</strong> Other Modification <br> Gender, Phone Number, State, LGA, Residential Address.. etc</li>
                    <li><strong>&#8358;10,000</strong> BVN NIN Modification</li>
                    <li><strong>&#8358;10,000</strong> Suspended NIN Modification</li>

                    <li><a class="btn btn-success" href="#">Get started</a></li>
                </ul>
            </div>
        </div>


        <div class="col-lg-3 col-sm-6">
            <div class="plan">
                <h3><span>Verification</span>Duration: <b>Instantly</b></h3>
                <ul>
                    <li><strong>&#8358;150</strong> per Successful Search</li>
                    <li><strong>&#8358;50</strong> for Basic Slip</li>
                    <li><strong>&#8358;100</strong> for Standard Slip</li>
                    <li><strong>&#8358;150</strong> for Improved Slip</li>
                    <li><strong>&#8358;200</strong> for Premium Slip</li>
                    <li><strong>&#8358;50</strong> for NVS Basic Slip</li>

                    <li><a class="btn btn-success" href="#">Get started</a></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="plan">
                <h3><span>IPE Clearance</span>Duration: <b>48 Hours</b></h3>
                <ul>
                    <li><strong>&#8358;800</strong> per Submission</li>
                    <li><strong>&#8358;800</strong> for Inprocessing Error</li>
                    <li><strong>&#8358;800</strong> for Still Being In Process</li>
                    <li><strong>&#8358;800</strong> for New Enrollment For Old Tracking</li>

                    <li><a class="btn btn-success" href="#">Get started</a></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="plan">
                <h3><span>Validation</span>Duration: <b>48 - 96 Hours</b></h3>
                <ul>
                    <li><strong>&#8358;800</strong> per Request</li>
                    <li><strong>&#8358;800</strong> for No Record Found</li>
                    <li><strong>&#8358;800</strong> for Photograph Error</li>
                    <li><strong>&#8358;800</strong> for NIN Validation</li>

                    <li><a class="btn btn-success" href="#">Get started</a></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="pricing-table princig-table-flat row no-gutters mt-3 mb-3">
        <div class="col-lg-3 col-sm-6">
            <div class="plan">
                <h3><span>Name Modification IPE Clearance and Validation</span>Duration: <b>48 - 96 Hours</b></h3>
                <ul>
                    <li><strong>&#8358;5,000</strong> Name Mod IPE</li>
                    <li><strong>&#8358;2,500</strong> Mod Validation</li>

                    <li><a class="btn btn-success" href="#">Get started</a></li>
                </ul>
            </div>
        </div>

        
        <div class="col-lg-3 col-sm-6">
            <div class="plan">
                <h3><span>DOB Modification IPE Clearance and Validation</span>Duration: <b>48 - 96 Hours</b></h3>
                <ul>
                    <li><strong>&#8358;10,000</strong> DOB MOD IPE</li>
                    <li><strong>&#8358;800</strong> DOB MOD Validation</li>

                    <li><a class="btn btn-success" href="#">Get started</a></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="plan">
                <h3><span>NIN Enrollment</span>Duration: <b>24 - 48 Hours</b></h3>
                <ul>
                    <li><strong>&#8358;1,500</strong> for Child Enrollment</li>
                    <li><strong>&#8358;5,000</strong> for Adult Enrollment</li>                    

                    <li><a class="btn btn-success" href="#">Get started</a></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="plan">
                <h3><span>Personalization</span>Duration: <b>2 - 24 Hours</b></h3>
                <ul>
                    <li><strong>&#8358;300</strong> per Successful Request</li>

                    <li><a class="btn btn-success" href="#">Get started</a></li>
                </ul>
            </div>
        </div>

    </div>


    
@endif


    

    <!-- end: page -->
</section>

@endsection