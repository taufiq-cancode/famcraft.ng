@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <div class="row mt-desktop">
        <div class="col">
            <section class="card card-airtime">
                <header class="card-header">
                    <h2 class="card-title">{{ Illuminate\Support\Str::title($user->first_name) }} {{ Illuminate\Support\Str::title($user->last_name) }}</h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" method="POST" action="{{ route('update.user', ['userId' => $user->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if (auth()->user()->role === "Administrator")
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Agent Details</label>
                                <div class="col-lg-3">
                                    <input type="text" value="{{ Illuminate\Support\Str::title($user->first_name) }} {{ Illuminate\Support\Str::title($user->last_name) }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" value="{{ $user->email }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Wallet Balance</label>
                            <div class="col-lg-6">
                                <input type="text" value="&#8358;{{ number_format(optional($user->wallet)->balance) }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Registration Date</label>
                            <div class="col-lg-3">
                                <input type="text" value="{{ $user->created_at->format('jS F, Y') }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                            <div class="col-lg-3">
                                <input type="text" value="{{ $user->created_at->format('g:i A') }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-2">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Role</label>
                            <div class="col-lg-6">
                                <select name="role" class="form-control mb-3">
                                    <option selected="" value="{{ $user->role }}" disabled="">{{ $user->role }}</option>
                                    <option value="Agent">Agent</option>
                                    <option value="Staff">Staff</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row pb-2">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Status</label>
                            <div class="col-lg-6">
                                <select name="status" class="form-control mb-3">
                                    <option selected="" value="{{ $user->is_active }}" disabled="">{{ $user->is_active ? 'Active' : 'Inactive' }}</option>
                                    <option value="0">Deactivate</option>
                                    <option value="1">Activate</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Top-up Amount</label>
                            <div class="col-lg-6">
                                <input type="number" name="topup_amount" class="form-control" placeholder="Enter top-up amount">                         
                            </div>
                        </div>
                    
                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Remark</label>
                            <div class="col-lg-6">
                                <input type="text" name="remark" class="form-control" placeholder="Enter top-up remark">                         
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault"></label>
                            @if (auth()->user()->role === "Administrator")
                                <div class="col-lg-3">
                                    <button type="submit" class="mt-1 me-1 btn btn-primary btn-lg btn-block">Update</button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <section class="card mb-4">
                <header class="card-header">
                    <h2 class="card-title">Payment History</h2>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Transaction For</th>
                                    <th>Amount</th>
                                    <th>Remark</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td class="pt-desktop">{{ ($payments->currentPage() - 1) * $payments->perPage() + $loop->iteration }}</td>
                                        <td class="pt-desktop">{{ $payment->payment_for }}</td>
                                        <td class="pt-desktop">&#8358;{{ number_format($payment->amount) }}</td>
                                        <td class="pt-desktop">{{ $payment->remark }}</td>
                                        <td>{{ $payment->created_at->format('jS F, Y') }} <br> {{ $payment->created_at->format('g:i A') }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($payment->status) }}</td>
                                        <td class="actions">
                                            <a href="{{ route('view.payment',['paymentId' => $payment->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $payments->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <section class="card mb-4">
                <header class="card-header">
                    <h2 class="card-title">Referral History</h2>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($referrals as $referral)
                                    <tr>
                                        <td class="pt-desktop">{{ $loop->iteration }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($referral->first_name) }} {{ Illuminate\Support\Str::title($referral->last_name) }}</td>
                                        <td>{{ $referral->created_at->format('jS F, Y') }} <br> {{ $referral->created_at->format('g:i A') }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($referral->role) }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $referrals->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </section>
        </div>
    </div>
    

</section>

@endsection