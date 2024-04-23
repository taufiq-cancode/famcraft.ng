@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

    <div class="row mt-desktop">
        <div class="col">
            <section class="card card-airtime">
                <header class="card-header">
                    <h2 class="card-title">NIN Modification</h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" method="POST" action="{{ route('update.validation', ['validationId' => $transaction->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Agent Details</label>
                            <div class="col-lg-3">
                                <input type="text" value="{{ Illuminate\Support\Str::title($transaction->user->first_name) }} {{ Illuminate\Support\Str::title($transaction->user->last_name) }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                            <div class="col-lg-3">
                                <input type="text" value="{{ $transaction->user->email }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
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

                        <hr>

                        <div id="nameFields" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Name</label>
                                <div class="col-lg-2">
                                    <input type="text" name="surname" value="{{ $transaction->surname }}" class="form-control" id="inputDefault" placeholder="Surname" readonly="readonly">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="firstname" value="{{ $transaction->firstname }}" class="form-control form-mt" id="inputDefault" placeholder="Firstname" readonly="readonly">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="middlename" value="{{ $transaction->middlename }}" class="form-control form-mt" id="inputDefault" placeholder="Middlename" readonly="readonly">
                                </div>
                            </div>
                        </div>
                        
                        <div id="dobFields" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Date of Birth</label>
                                <div class="col-lg-6">
                                    <input type="date" value="{{ $transaction->dob }}" id="inputReadOnly" class="form-control" readonly="readonly">                            
                                </div>
                            </div>
                        </div>
                        
                        <div id="nameDobFields" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Name</label>
                                <div class="col-lg-2">
                                    <input type="text" name="surname" value="{{ $transaction->surname }}" class="form-control" id="inputDefault" placeholder="Surname" readonly="readonly">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="firstname" value="{{ $transaction->firstname }}" class="form-control form-mt" id="inputDefault" placeholder="Firstname" readonly="readonly">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="middlename" value="{{ $transaction->middlename }}" class="form-control form-mt" id="inputDefault" placeholder="Middlename" readonly="readonly">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Date of Birth</label>
                                <div class="col-lg-6">
                                    <input type="text" name="dob" value="{{ $transaction->dob }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Status</label>
                            <div class="col-lg-6">
                                <select name="status" class="form-control mb-3">
                                    <option selected="" value="{{ $transaction->status }}" disabled="">{{ ucfirst(strtolower($transaction->status)) }}</option>
                                    <option value="invalidated">Invalidated</option>
                                    <option value="completed">Completed</option>
                                    <option value="bvn-nin">BVN-NIN</option>
                                    <option value="failed">Failed</option>
                                    <option value="pending">Pending</option>  
                                    <option value="others">Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="inputDefault" value="{{ $transaction->response }}" name="response" placeholder="Enter response">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault"></label>
                            <div class="col-lg-6">
                                <button type="submit" class="mt-1 me-1 btn btn-primary btn-lg btn-block">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>

<script>
    function displayFields() {
        var selectedOption = document.getElementById("modificationType").value;
    
        if (selectedOption === "name") {
            document.getElementById("nameFields").style.display = "block";
        } else if (selectedOption === "dob") {
            document.getElementById("dobFields").style.display = "block";
        } else if (selectedOption === "name_dob") {
            document.getElementById("nameDobFields").style.display = "block";
        } else if (selectedOption === "others") {
            document.getElementById("othersFields").style.display = "block";
        }
    }

    window.onload = function() {
        displayFields();
    };
</script>


@endsection