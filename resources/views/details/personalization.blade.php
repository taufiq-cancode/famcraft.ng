@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

    <div class="row mt-desktop">
        <div class="col">
            <section class="card card-airtime">
                <header class="card-header">
                    <h2 class="card-title">NIN Personalization</h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" method="POST" action="{{ route('update.personalization', ['personalizationId' => $transaction->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if (auth()->user()->role === "Administrator")
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Agent Details</label>
                                <div class="col-lg-3">
                                    <input type="text" value="{{ Illuminate\Support\Str::title($transaction->user->first_name) }} {{ Illuminate\Support\Str::title($transaction->user->last_name) }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" value="{{ $transaction->user->email }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Transaction ID</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $transaction->transaction_id }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Transaction Date</label>
                            <div class="col-lg-3">
                                <input type="text" value="{{ $transaction->created_at->format('jS F, Y') }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                            <div class="col-lg-3">
                                <input type="text" value="{{ $transaction->created_at->format('g:i A') }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Transaction Amount</label>
                            <div class="col-lg-6">
                                <input type="text" value="&#8358;{{ number_format($transaction->price) }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>
                    
                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Tracking ID</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $transaction->tracking_id }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-2">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Status</label>
                            <div class="col-lg-6">
                                <select name="status" class="form-control mb-3" @if (auth()->user()->role === "Agent") readonly="readonly" @endif >
                                    <option selected="" value="{{ $transaction->status }}" disabled="">{{ ucfirst(strtolower($transaction->status)) }}</option>
                                    @if (auth()->user()->role === "Administrator")
                                        <option value="completed">Completed</option>
                                        <option value="success">Success</option>
                                        <option value="failed">Failed</option>
                                        <option value="pending">Pending</option>  
                                        <option value="others">Others</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        @if (auth()->user()->role === "Agent")
                            @if($transaction->response !== null)
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="inputDefault" value="{{ $transaction->response }}" readonly="readonly">
                                    </div>
                                </div>
                            @endif

                            @if($transaction->response_text !== null)
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response Text</label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" id="inputDefault" readonly="readonly">{{ $transaction->response_text }}</textarea>
                                    </div>
                                </div>
                            @endif

                            @if($transaction->response_pdf !== null)
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response PDF(s)</label>
                                    <div class="col-lg-6">
                                        @foreach(json_decode($transaction->response_pdf) as $pdf)
                                            <a href="{{ asset($pdf) }}" download>
                                                <img src="{{ asset('img/icons/doc.png') }}" width="100px" class="img-fluid">
                                            </a><br><br>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif

                        @if (auth()->user()->role === "Administrator")
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" value="{{ $transaction->response }}" name="response" placeholder="Enter response">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response Text</label>
                                <div class="col-lg-6">
                                    <textarea class="form-control" id="inputDefault" name="response_text" placeholder="Enter response text">{{ $transaction->response_text }}</textarea>
                                </div>
                            </div>

                            @if($transaction->response_pdf !== null)
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response PDF(s)</label>
                                    <div class="col-lg-6">
                                        @foreach(json_decode($transaction->response_pdf) as $pdf)
                                            <a href="{{ asset($pdf) }}" download>
                                                <img src="{{ asset('img/icons/doc.png') }}" width="100px" class="img-fluid">
                                            </a><br><br>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response Document</label>
                                <div class="col-lg-6">
                                    <input type="file" name="response_pdf[]" class="form-control" id="inputDefault" accept="application/pdf" multiple>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault"></label>
                            @if (auth()->user()->role === "Administrator")
                                <div class="col-lg-3">
                                    <button type="submit" class="mt-1 me-1 btn btn-primary btn-lg btn-block">Update</button>
                                </div>
                            @endif

                            <div class="col-lg-3">
                                <button type="submit" class="mt-1 me-1 btn btn-secondary btn-lg btn-block">Download Receipt</button>
                            </div>
                        </div>

                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>

@endsection