@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

    <div class="row mt-desktop">
        <div class="col">
            <section class="card card-airtime">
                <header class="card-header">
                    <img src="{{ asset('img/logos/nimc2.jpg') }}" width="130" alt="NIMC" />
                    <br><br>
                    <h2 class="card-title">NIN Verification</h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" method="POST" action="{{ route('update.verificationV2', ['verificationId' => $transaction->id]) }}" enctype="multipart/form-data">
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
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Verification Method</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $transaction->method }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Generated Slip</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $transaction->slip_type }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div id="demographicsFields" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Name</label>
                                <div class="col-lg-3">
                                    <input type="text" name="surname" value="{{ $transaction->surname }}" class="form-control" id="inputDefault" placeholder="Surname" readonly="readonly">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="firstname" value="{{ $transaction->firstname }}" class="form-control form-mt" id="inputDefault" placeholder="Firstname" readonly="readonly">
                                </div>
                            </div>
                    
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Gender <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ Illuminate\Support\Str::title($transaction->gender) }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end" for="inputDefault">Date of Birth <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->dob }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="phoneField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Phone Number <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->phone }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="NINField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NIN Number</label>
                                <div class="col-lg-6">
                                    <input type="text" name="nin" value="{{ $transaction->nin }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row pb-2">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Status</label>
                            <div class="col-lg-6">
                                <select name="status" class="form-control mb-3" @if (auth()->user()->role === "Agent") readonly="readonly" @endif >
                                    <option selected="" value="{{ $transaction->status }}" disabled="">{{ ucfirst(strtolower($transaction->status)) }}</option>
                                    @if (auth()->user()->role === "Administrator")
                                        <option value="invalidated">Invalidated</option>
                                        <option value="completed">Completed</option>
                                        <option value="bvn-nin">BVN-NIN</option>
                                        <option value="failed">Failed</option>
                                        <option value="pending">Pending</option>  
                                        <option value="others">Others</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        @include('admin-theme.details-form')

                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>

<script>
    var verificationMethod = "{{ $transaction->method }}";

    if (verificationMethod === 'by-demographics') {
        document.getElementById('demographicsFields').style.display = 'block';
    } else if (verificationMethod === 'by-phone') {
        document.getElementById('phoneField').style.display = 'block';
    } else if (verificationMethod === 'by-nin') {
        document.getElementById('NINField').style.display = 'block';
    }
</script>

@endsection