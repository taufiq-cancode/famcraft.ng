@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <div class="row">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <h2 class="card-title">Purchase Airtime</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="POST" action="{{ route('airtime.purchase') }}">
                            @csrf
                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="provider">Provider</label>
                                <div class="col-lg-6">
                                    <select class="form-control mb-3" name="provider" id="provider" required>
                                        <option value="">Select Provider</option>
                                        <option value="airtel">Airtel</option>
                                        <option value="glo">Glo</option>
                                        <option value="mtn">MTN</option>
                                        <option value="9mobile">9Mobile</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="phone">Phone Number</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone number" required>
                                </div>
                            </div>
                        
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="amount">Amount</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount" required>
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-end pt-2"></label>
                                <div class="col-lg-6">
                                    <button type="submit" class="mt-1 me-1 btn btn-primary btn-lg btn-block">Purchase</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <section class="card mb-4">
                    <header class="card-header">
                        <h2 class="card-title">Airtime Purchase History</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Phone Number</th>
                                    <th>Provider</th>
                                    <th>Amount</th>
                                    <th class="hide-mob">Status</th>
                                    <th class="hide-mob">Date</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pt-desktop">1</td>
                                    <td class="pt-desktop">09048012856</td>
                                    <td class="pt-desktop">Airtel</td>
                                    <td class="pt-desktop">&#8358;2,000.00</td>
                                    <td class="pt-desktop hide-mob">Success</td>
                                    <td class="hide-mob">12th, January 2024 <br> 12:00PM </td>
                                    <td class="actions">
                                        <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">Reciept</span> <i class="fas fa-eye"></i> </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-desktop">1</td>
                                    <td class="pt-desktop">09048012856</td>
                                    <td class="pt-desktop">Airtel</td>
                                    <td class="pt-desktop">&#8358;2,000.00</td>
                                    <td class="pt-desktop hide-mob">Success</td>
                                    <td class="hide-mob">12th, January 2024 <br> 12:00PM </td>
                                    <td class="actions">
                                        <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">Receipt</span> <i class="fas fa-eye"></i> </button>
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