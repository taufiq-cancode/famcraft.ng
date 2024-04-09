@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

    <!-- Instructions -->
    <div class="row mt-desktop-2">
        <div class="col-12">
            
            <section class="card">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h3>Please ensure the NIN is not <strong>Suspended, By Pass, or BVN Generated</strong></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
                </div>
            </section>
        </div>
    </div>

        <!-- purchase airtime -->
        <div class="row">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <h2 class="card-title">NIN Validation</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="get">

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NIN Number</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter NIN number">
                                </div>
                            </div>

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Validation Category</label>
                                <div class="col-lg-6">
                                    <select class="form-control mb-3">
                                        <option>Choose validation category</option>
                                        <option>No record found</option>
                                        <option>Update record</option>
                                        <option>Validate modification</option>
                                        <option>V-NIN validation</option>
                                        <option>Photograph error</option>
                                        <option>By pass NIN</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Validation For</label>
                                <div class="col-lg-6">
                                    <select class="form-control mb-3">
                                        <option>Choose validation purpose</option>
                                        <option>Bank</option>
                                        <option>Sim</option>
                                        <option>Passport</option>
                                        <option>Others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault"></label>
                                <div class="col-lg-6">
                                    <button type="button" class="mt-1 me-1 btn btn-primary btn-lg btn-block">Validate</button>
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
                        <h2 class="card-title">NIN Validation History</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIN Number</th>
                                    <th>Created At</th>
                                    <th>Response</th>
                                    <th>Status</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pt-desktop">1</td>
                                    <td class="pt-desktop">2248012856</td>
                                    <td class="hide-mob">12th, January 2024 <br> 12:00PM </td>
                                    <td class="pt-desktop">By Pass NIN</td>
                                    <td class="pt-desktop">Invalidated</td>
                                    <td class="actions">
                                        <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">Reciept</span> <i class="fas fa-eye"></i> </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-desktop">1</td>
                                    <td class="pt-desktop">2248012856</td>
                                    <td class="hide-mob">12th, January 2024 <br> 12:00PM </td>
                                    <td class="pt-desktop">By Pass NIN</td>
                                    <td class="pt-desktop">Invalidated</td>
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