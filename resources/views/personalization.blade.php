@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- purchase airtime -->
        <div class="row">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <h2 class="card-title">NIN Personalization</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="get">

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Tracking ID</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter tracking ID" max="15">
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
                        <h2 class="card-title">NIN Personalization History</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIN</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Response</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pt-desktop">1</td>
                                    <td class="pt-desktop">9048012856</td>
                                    <td>12th, January 2024 <br> 12:00PM </td>
                                    <td class="pt-desktop hide-mob">Success</td>
                                    <td class="pt-desktop hide-mob">Completed</td>
                                    <td class="actions">
                                        <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">Reciept</span> <i class="fas fa-eye"></i> </button>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="pt-desktop">1</td>
                                    <td class="pt-desktop">9048012856</td>
                                    <td>12th, January 2024 <br> 12:00PM </td>
                                    <td class="pt-desktop hide-mob">Success</td>
                                    <td class="pt-desktop hide-mob">Completed</td>
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