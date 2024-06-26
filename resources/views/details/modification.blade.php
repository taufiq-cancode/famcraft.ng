@extends('admin-theme.theme-master')
@section('content')

@php
    $detailsToModifyArray = json_decode($transaction->details_to_modify, true);

    if (!is_array($detailsToModifyArray)) {
        $detailsToModifyArray = [];
    }

    $detailsToModifyString = implode(' | ', $detailsToModifyArray);
@endphp

<section role="main" class="content-body card-margin">

    <!-- start: page -->

    <div class="row mt-desktop">
        <div class="col">
            <section class="card card-airtime">
                <header class="card-header">
                    <img src="{{ asset('img/logos/nimc.jpg') }}" width="130" alt="NIMC" />
                    <br><br>
                    <h2 class="card-title">NIN Modification</h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" method="POST" action="{{ route('update.modification', ['modificationId' => $transaction->id]) }}" enctype="multipart/form-data">
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
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NIN Number</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $transaction->nin }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Tracking ID</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $transaction->tracking_id }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Modification Type</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $transaction->modification_type }}" id="modificationType" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        @if(isset($transaction->title) && !empty($transaction->title))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">
                                    Title <span style="color: red">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->title }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->firstname) && !empty($transaction->firstname))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Firstname <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->firstname }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->surname) && !empty($transaction->surname))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Surname <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->surname }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->middlename) && !empty($transaction->middlename))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Othername <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->middlename }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->gender) && !empty($transaction->gender))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Gender <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ Illuminate\Support\Str::title($transaction->gender) }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->dob) && !empty($transaction->dob))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end" for="inputDefault">Date of Birth <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->dob }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->phone) && !empty($transaction->phone))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Phone Number <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->phone }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->state_of_residence) && !empty($transaction->state_of_residence))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residential State <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->state_of_residence }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->lga_of_residence) && !empty($transaction->lga_of_residence))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residential Local Government <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->lga_of_residence }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->town) && !empty($transaction->town))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residential Town/City <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->town }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->address_line_1) && !empty($transaction->address_line_1))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residential Address <span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <input type="text" value="{{ $transaction->address_line_1 }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" value="{{ $transaction->address_line_2 ?? NULL }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->religion) && !empty($transaction->religion))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Religion <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->religion }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->profession) && !empty($transaction->profession))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Profession <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->profession }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->state_of_origin) && !empty($transaction->state_of_origin))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">State of Origin <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->state_of_origin }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->lga_of_origin) && !empty($transaction->lga_of_origin))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">LGA of Origin <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->lga_of_origin }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        @endif

                        @if(isset($transaction->passport) && !empty($transaction->passport))
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Passport <span style="color: red"> *</span></label>
                                <div class="col-lg-6">
                                    <div class="row mg-files" data-sort-destination="" data-sort-id="media-gallery" style="position: relative; height: auto;">
                                        <div class="thumbnail">
                                            <div class="thumb-preview">
                                                <a class="thumb-image" href="{{ asset('storage/' . $transaction->passport) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $transaction->passport) }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <hr>

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

                        @include('admin-theme.details-form')


                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>

@endsection