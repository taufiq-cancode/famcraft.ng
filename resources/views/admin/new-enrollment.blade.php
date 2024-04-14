@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- history -->
        <div class="row">
            <div class="col">
                <section class="card mb-4">
                    <header class="card-header">
                        <h2 class="card-title">Airtime Purchase Submission</h2>
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
                                    <th>View</th>
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
                                        <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </button>
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
                                        <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </button>
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