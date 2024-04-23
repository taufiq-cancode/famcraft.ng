@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body">
 
    <div class="row mt-4">
        <div class="col">
            <section class="card mb-4">
                <header class="card-header">
                    <h2 class="card-title">Transaction History</h2>
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

</section>

@endsection