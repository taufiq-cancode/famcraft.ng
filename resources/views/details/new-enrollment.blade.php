@extends('admin-theme.theme-master')
@section('content')

<style>
    .pe-2 {
        padding-right: 1.5rem !important;
    }
    @media screen and (max-width:798px) {
        .form-mt {
            margin-top:12px !important;
        }
    }
</style>

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- purchase airtime -->
        <div class="row">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <img src="{{ asset('img/logos/nimc.jpg') }}" width="130" alt="NIMC" />
                    <br><br>
                        <h2 class="card-title">NIN Enrollment</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="POST" action="{{ route('update.new-enrollment', ['enrollmentId' => $transaction->id]) }}" enctype="multipart/form-data">
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

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Enrollment Type<span style="color: red"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="text" name="type" value="{{ Illuminate\Support\Str::title($transaction->type) }}" class="form-control" id="inputDefault" readonly="readonly">                                
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Name <span style="color: red"> *</span></label>
                                <div class="col-lg-2">
                                    <input type="text" name="surname" value="{{ $transaction->surname }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="firstname" value="{{ $transaction->firstname }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="middlename" value="{{ $transaction->middlename }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Gender & Date of Birth <span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <input type="text" name="gender" value="{{ Illuminate\Support\Str::title($transaction->gender) }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="dob" value="{{ $transaction->dob }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Nationality & Country of Birth <span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <input type="text" name="nationality" value="{{ $transaction->nationality }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="country_of_birth" value="{{ $transaction->country_of_birth }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Country & State of Residence<span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <input type="text" name="country_of_residence" value="{{ $transaction->country_of_residence }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            
                                <div class="col-lg-3">
                                    <input type="text" name="state_of_residence" value="{{ $transaction->state_of_residence }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            </div>

                            
                            
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">LGA of Residence & Town/city<span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <input type="text" name="lga_of_residence" value="{{ $transaction->lga_of_residence }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>

                                <div class="col-lg-3">
                                    <input type="text" name="town" value="{{ $transaction->town }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Address <span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <input type="text" name="address_line_1" value="{{ $transaction->address_line_1 }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="address_line_2" value="{{ $transaction->address_line_2 }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Height <span style="color: red"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="text" name="height" value="{{ $transaction->height }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Country & State of Origin</label>
                                <div class="col-lg-2">
                                    <input type="text" name="country_of_origin" value="{{ $transaction->country_of_origin }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>

                                <div class="col-lg-2">
                                    <input type="text" name="state_of_origin" value="{{ $transaction->state_of_origin }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>

                                <div class="col-lg-2">
                                    <input type="text" name="lga_of_origin" value="{{ $transaction->lga_of_origin }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Email & Phone Number <span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <input type="text" name="email" value="{{ $transaction->email }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="phone" value="{{ $transaction->phone }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            </div>

                            <div id="childEnrollmentDiv">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Parent's Name & NIN <span style="color: red"> *</span></label>
                                    <div class="col-lg-2">
                                        <input type="text" name="parent_surname" value="{{ $transaction->parent_surname }}" class="form-control" id="inputDefault" readonly="readonly">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="text" name="parent_firstname" value="{{ $transaction->parent_firstname }}" class="form-control" id="inputDefault" readonly="readonly">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="text" name="parent_nin" value="{{ $transaction->parent_nin }}" class="form-control" id="inputDefault" readonly="readonly">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Image <span style="color: red"> *</span></label>
                                <div class="col-lg-6">
                                    <div class="row mg-files" data-sort-destination="" data-sort-id="media-gallery" style="position: relative; height: auto;">
                                        <div class="thumbnail">
                                            <div class="thumb-preview">
                                                <a class="thumb-image" href="{{ asset('storage/' . $transaction->image) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $transaction->image) }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Left Finger <span style="color: red"> *</span></label>
                                <div class="col-lg-6">
                                    <div class="row mg-files" data-sort-destination="" data-sort-id="media-gallery" style="position: relative; height: auto;">
                                        <div class="thumbnail">
                                            <div class="thumb-preview">
                                                <a class="thumb-image" href="{{ asset('storage/' . $transaction->left_finger) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $transaction->left_finger) }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Right Finger <span style="color: red"> *</span></label>
                                <div class="col-lg-6">
                                    <div class="row mg-files" data-sort-destination="" data-sort-id="media-gallery" style="position: relative; height: auto;">
                                        <div class="thumbnail">
                                            <div class="thumb-preview">
                                                <a class="thumb-image" href="{{ asset('storage/' . $transaction->right_finger) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $transaction->right_finger) }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Thumb Finger <span style="color: red"> *</span></label>
                                <div class="col-lg-6">
                                    <div class="row mg-files" data-sort-destination="" data-sort-id="media-gallery" style="position: relative; height: auto;">
                                        <div class="thumbnail">
                                            <div class="thumb-preview">
                                                <a class="thumb-image" href="{{ asset('storage/' . $transaction->thumb_finger) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $transaction->thumb_finger) }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
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
    
                            @include('admin-theme.details-form')

                        </form>
                    </div>
                </section>
            </div>
        </div>

    <!-- end: page -->
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection