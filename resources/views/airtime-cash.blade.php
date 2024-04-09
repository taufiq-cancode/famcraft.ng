@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->
    
        <!-- Instructions -->
        <div class="row mt-desktop-2">
            <div class="col-12">
                
                <section class="card">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h3>Please read the <strong>instructions</strong> below</h3>
                        To convert <strong> airtime to cash, </strong> follow the steps below.


                        <ol>
                            <li>Make sure your sim is on MTN pulse by dialing <b>*406*1#</b> </li>
                            <li>
                                Ensure you have created a transfer pin by dialing <b>*321*1#</b>
                                <ol>
                                    <li>Select option 4 to create pin</li>
                                    <li>Enter your email address</li>
                                    <li>Select and answer security question</li>
                                    <li>Enter new pin</li>
                                    <li> Confirm pin </li>
                                </ol> 
                            </li>
                            <li>
                                To transfer dial <b>*321*1#</b>
                                <ol>
                                    <li>Select option 1 for airtime transfer</li>
                                    <li>Enter receiver's number (09048102856)</li>
                                    <li>Enter amount</li>
                                    <li>Enter transfer pin</li>
                                </ol> 
                            </li>
                        </ol>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
                    </div>
                </section>
            </div>
        </div>

        <!-- purchase airtime -->
        <div class="row mt-desktop">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <h2 class="card-title">Airtime to Cash</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="get">

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Airtime Amount</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter airtime amount">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Sender's Number</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter sender's phone number">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Receiver's Number</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" value="09048102856" placeholder="Enter receiver's phone number">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Beneficiary Bank</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter phone number">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Account Number</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter amount">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Account Name</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter amount">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault"></label>
                                <div class="col-lg-6">
                                    <button type="button" class="mt-1 me-1 btn btn-primary btn-lg btn-block">Submit</button>
                                </div>
                            </div>
  
                        </form>
                    </div>
                </section>
            </div>
        </div>

        <!-- airtime history -->
        <div class="row mt-desktop">
            <div class="col">
                <section class="card mb-4">
                    <header class="card-header">
                        <h2 class="card-title">Airtime to Cash History</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Sender's Phone Number</th>
                                    <th class="hide-mob">Status</th>
                                    <th class="hide-mob">Date</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pt-desktop">1</td>
                                    <td class="pt-desktop">&#8358;2,000.00</td>
                                    <td class="pt-desktop">09048012856</td>
                                    <td class="pt-desktop hide-mob">Success</td>
                                    <td class="hide-mob">12th, January 2024 <br> 12:00PM </td>
                                    <td class="actions">
                                        <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">Reciept</span> <i class="fas fa-eye"></i> </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-desktop">1</td>
                                    <td class="pt-desktop">&#8358;2,000.00</td>
                                    <td class="pt-desktop">09048012856</td>
                                    <td class="pt-desktop hide-mob">Success</td>
                                    <td class="hide-mob">12th, January 2024 <br> 12:00PM </td>
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