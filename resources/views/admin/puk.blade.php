@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- history -->
        <div class="row mt-desktop">
            <div class="col">
                <section class="card mb-4">
                    <header class="card-header">
                        <h2 class="card-title">PUK Retrieval Submissions</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Agent Email</th>
                                    <th>Phone Number</th>
                                    <th>Fullname</th>
                                    <th class="hide-mob">Status</th>
                                    <th class="hide-mob">Date</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td class="pt-desktop">{{ $loop->iteration }}</td>
                                        <td class="pt-desktop">{{ $transaction->user->email }}</td>
                                        <td class="pt-desktop">{{ $transaction->phone }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->fullname) }}</td>
                                        <td class="pt-desktop hide-mob">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
                                        <td class="hide-mob">{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                        <td class="actions">
                                            <a href="{{ route('view.puk',['pukTransactionId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>

    <!-- end: page -->
</section>

@endsection