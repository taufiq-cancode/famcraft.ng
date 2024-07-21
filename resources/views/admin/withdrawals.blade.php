@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- history -->
        <div class="row mt-desktop">
            <div class="col">
                <section class="card mb-4">
                    <header class="card-header">
                        <h2 class="card-title">Withdrawal Requests</h2>
                    </header>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrawals as $transaction)
                                        <tr>
                                            <td class="pt-desktop">{{ $loop->iteration }}</td>
                                            <td class="pt-desktop">&#8358;{{ number_format($transaction->amount) }}</td>
                                            <td>{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                            <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
                                            <td class="actions">
                                                <a href="{{ route('view.withdrawal',['withdrawalId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    <!-- end: page -->
</section>

@endsection