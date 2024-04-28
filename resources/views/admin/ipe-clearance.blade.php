@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- history -->
        <div class="row">
            <div class="col">
                <section class="card mb-4">
                    <header class="card-header">
                        <h2 class="card-title">IPE Clearance Submissions</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Agent Email</th>
                                    <th>Tracking ID</th>
                                    <th>IPE Category</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Response</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="pt-desktop">{{ $loop->iteration }}</td>
                                    <td class="pt-desktop">{{ $transaction->user->email }}</td>
                                    <td class="pt-desktop">{{ $transaction->tracking_id }}</td>
                                    <td class="pt-desktop">{{ $transaction->ipe_category }}</td>
                                    <td class="hide-mob">{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                    <td class="pt-desktop hide-mob">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
                                    <td class="pt-desktop hide-mob">{{ Illuminate\Support\Str::title($transaction->response) }}</td>
                                    <td class="actions">
                                        <a href="{{ route('view.ipe-clearance',['ipeId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
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