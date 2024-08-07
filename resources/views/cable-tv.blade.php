@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">
    @include('admin-theme.coming-soon')
    <!-- start: page -->

        {{-- <!-- purchase airtime -->
        <div class="row">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <h2 class="card-title">Pay Cable-TV</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="get">

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Provider</label>
                                <div class="col-lg-6">
                                    <select class="form-control mb-3">
                                        <option>Select Provider</option>
                                        <option>Dstv</option>
                                        <option>Gotv</option>
                                        <option>Startimes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Smartcard Number</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter smartcard number">
                                </div>
                            </div>

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Package</label>
                                <div class="col-lg-6">
                                    <select class="form-control mb-3">
                                        <option>Select Package</option>
                                        <option>DStv Compact - &#8358;16,000</option>
                                        <option>DStv Premium - &#8358;11,500</option>
                                        <option>DStv Yanga - &#8358;7,800</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Amount</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter Amount" value="&#8358;11,500.00" disabled>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Subscription Period</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter Amount" value="30 Days" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault"></label>
                                <div class="col-lg-6">
                                    <button type="button" class="mt-1 me-1 btn btn-primary btn-lg btn-block">Pay</button>
                                </div>
                            </div>
  
                        </form>
                    </div>
                </section>
            </div>
        </div>

        <!-- airtime history -->
        <div class="row">
            <div class="col">
                <section class="card mb-4">
                    <header class="card-header">
                        <h2 class="card-title">Data Purchase History</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Smartcard Number</th>
                                    <th>Provider</th>
                                    <th class="hide-mob">Package</th>
                                    <th>Amount</th>
                                    <th class="hide-mob">Status</th>
                                    <th class="hide-mob">Date</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pt-desktop">1</td>
                                    <td class="pt-desktop">44048012856</td>
                                    <td class="pt-desktop">DStv</td>
                                    <td class="pt-desktop">DStv Compact Plus</td>
                                    <td class="pt-desktop">&#8358;20,000.00</td>
                                    <td class="pt-desktop hide-mob">Success</td>
                                    <td class="hide-mob">12th, January 2024 <br> 12:00PM </td>
                                    <td class="actions">
                                        <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">Receipt</span> <i class="fas fa-eye"></i> </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-desktop">2</td>
                                    <td class="pt-desktop">44048012856</td>
                                    <td class="pt-desktop">DStv</td>
                                    <td class="pt-desktop">DStv Compact Plus</td>
                                    <td class="pt-desktop">&#8358;20,000.00</td>
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
        </div> --}}

    <!-- end: page -->
</section>

@endsection