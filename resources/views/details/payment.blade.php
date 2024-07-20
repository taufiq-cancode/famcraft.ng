@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <div class="row mt-desktop">
        <div class="col">
            <section class="card card-airtime">
                <header class="card-header">
                    <h2 class="card-title">Payment Details</h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" method="POST" action="{{ route('update.payment', ['paymentId' => $payment->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if (auth()->user()->role === "Administrator")
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Agent Details</label>
                                <div class="col-lg-3">
                                    <input type="text" value="{{ Illuminate\Support\Str::title($payment->user->first_name) }} {{ Illuminate\Support\Str::title($payment->user->last_name) }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" value="{{ $payment->user->email }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        <div class="form-group row pb-2">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Amount</label>
                            <div class="col-lg-6">
                                <input type="text" value="&#8358;{{ number_format($payment->amount) }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Payment Method</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $payment->payment_type }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Payment For</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $payment->payment_for }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Payment Remark</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $payment->remark }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Payment Date</label>
                            <div class="col-lg-3">
                                <input type="text" value="{{ $payment->created_at->format('jS F, Y') }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                            <div class="col-lg-3">
                                <input type="text" value="{{ $payment->created_at->format('g:i A') }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Payment Screenshot</label>
                            <div class="col-lg-6">
                                <div class="row mg-files" data-sort-destination="" data-sort-id="media-gallery" style="position: relative; height: auto;">
                                    <div class="thumbnail">
                                        <div class="thumb-preview">
                                            <a class="thumb-image" href="{{ asset('storage/' . $payment->screenshot) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $payment->screenshot) }}" class="img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row pb-2">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Payment Status</label>
                            <div class="col-lg-6">
                                <select name="status" class="form-control mb-3">
                                    <option selected="" value="{{ $payment->status }}" disabled="">{{ $payment->status }}</option>
                                    <option value="Success">Success</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Failed">Failed</option>
                                </select>
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

</section>

@endsection