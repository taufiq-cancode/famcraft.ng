@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- purchase airtime -->
        <div class="row">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <h2 class="card-title">NIN Verification</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="get">

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Method</label>
                                <div class="col-lg-6">
                                    <select class="form-control mb-3">
                                        <option>Select Verification Method</option>
                                        <option>By Demographics</option>
                                        <option>By Phone Number</option>
                                        <option>By NIN Number</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Name</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter surname">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter firstname">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Gender</label>
                                <div class="col-lg-6">
                                    <select class="form-control mb-3">
                                        <option>Select Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Date of Birth</label>
                                <div class="col-lg-6">
                                    <input type="date" class="form-control" id="inputDefault">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Phone Number</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter phone number">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NIN Number</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter NIN number">
                                </div>
                            </div>

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Generate Slip</label>
                                <div class="col-lg-6">
                                    <select class="form-control mb-3">
                                        <option>Select Slip Type</option>
                                        <option>Premium Slip</option>
                                        <option>Standard Slip</option>
                                        <option>Improved NIN Slip</option>
                                        <option>Basic Slip</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault"></label>
                                <div class="col-lg-6">
                                    <button type="button" class="mt-1 me-1 btn btn-primary btn-lg btn-block">Verify</button>
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
                        <h2 class="card-title">NIN Verification History</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIN Number</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pt-desktop">1</td>
                                    <td class="pt-desktop">2248012856</td>
                                    <td class="pt-desktop">Fajuyi Michael</td>
                                    <td class="pt-desktop">Success</td>
                                    <td class="hide-mob">12th, January 2024 <br> 12:00PM </td>
                                    <td class="actions">
                                        <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">Reciept</span> <i class="fas fa-eye"></i> </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-desktop">1</td>
                                    <td class="pt-desktop">2248012856</td>
                                    <td class="pt-desktop">Fajuyi Michael</td>
                                    <td class="pt-desktop">Success</td>
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