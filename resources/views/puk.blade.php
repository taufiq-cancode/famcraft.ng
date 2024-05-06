@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- purchase airtime -->
        <div class="row mt-desktop">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <h2 class="card-title">PUK Retrieval</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="POST" action="{{ route('submit.puk') }}">
                            @csrf
                            @method('POST')

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Phone Number</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" name="phone" placeholder="Enter phone number">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Fullname</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" name="fullname" placeholder="Enter fullname">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Date of Birth</label>
                                <div class="col-lg-6">
                                    <input type="date" class="form-control" id="inputDefault" name="dob">
                                </div>
                            </div>

                         
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault"></label>
                                <div class="col-lg-6">
                                    <button type="submit" class="mt-1 me-1 btn btn-primary btn-lg btn-block">Request PUK</button>
                                </div>
                            </div>
  
                        </form>
                    </div>
                </section>
            </div>
        </div>

        <!-- airtime history -->
        <div class="row mt-desktop">
            <div class="col">
                <section class="card mb-4">
                    <header class="card-header">
                        <h2 class="card-title">PUK Retrieval History</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Phone Number</th>
                                    <th>Fullname</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Response</th> 
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
        
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td class="pt-desktop">{{ $loop->iteration }}</td>
                                        <td class="pt-desktop">{{ $transaction->phone }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->fullname) }}</td>
                                        <td class="pt-desktop">&#8358;{{ number_format($transaction->price) }}</td>
                                        <td>{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->response) }}</td>
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