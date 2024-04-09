@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body">
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-4 col-xl-4 mb-4 mb-xl-0 mt-4">
            <section class="card">
                <div class="card-body">
                    <div class="thumb-info mb-3">
                        <img src="img/!logged-user.jpg" class="rounded img-fluid" alt="John Doe">
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner">John Doe</span>
                            <span class="thumb-info-type">CEO</span>
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
                                    <h5><b>Account Name:</b> Taofeek Adekunle</h5>
                                    <h5><b>Bank Name:</b> Paystack Titan</h5>
                                    <h5><b>Account Number:</b> 0223611578</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

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
                                <th>Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="pt-desktop">1</td>
                                <td class="pt-desktop">Wallet Credit</td>
                                <td class="pt-desktop">N14,000</td>
                                <td class="hide-mob">12th, January 2024 <br> 12:00PM </td>
                                <td class="pt-desktop">Success</td>
                                <td class="actions">
                                    <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">Reciept</span> <i class="fas fa-eye"></i> </button>
                                </td>
                            </tr>

                            <tr>
                                <td class="pt-desktop">1</td>
                                <td class="pt-desktop">Wallet Credit</td>
                                <td class="pt-desktop">N14,000</td>
                                <td class="hide-mob">12th, January 2024 <br> 12:00PM </td>
                                <td class="pt-desktop">Success</td>
                                <td class="actions">
                                    <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">Reciept</span> <i class="fas fa-eye"></i> </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->


</section>

@endsection