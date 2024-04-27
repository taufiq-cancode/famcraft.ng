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
                    <h2 class="card-title">NIN Modification</h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" method="POST" action="{{ route('update.validation', ['validationId' => $transaction->id]) }}">
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

                        <div id="othersFields" style="display: none;">
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Details to Modify</label>
                                <div class="col-lg-6">
                                    <textarea id="detailsToModify" class="form-control" rows="5" readonly="readonly"> {{ $detailsToModifyString }} </textarea>                         
                                </div>
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

                        <div id="titleField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Title <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->title }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="firstnameField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Firstname <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->firstname }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="surnameField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Surname <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->middlename }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="othernameField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Othername <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->middlename }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="genderField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Gender <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ Illuminate\Support\Str::title($transaction->gender) }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="DOBField" style="display: none;">
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

                        <div id="resStateField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residential State <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->state_of_residence }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="resLGField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residential Local Government <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->lga_of_residence }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="resTownField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residential Town/City <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->town }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="resAddField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residential Address <span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <input type="text" value="{{ $transaction->address_line_1 }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" value="{{ $transaction->address_line_2 }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="religionField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Religion <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->religion }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="professionField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Profession <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->profession }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

                        <div id="passportField" style="display: none;">
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
                        </div>

                        <div id="SOGField" style="display: none;">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">State of Origin <span style="color: red">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $transaction->state_of_origin }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                </div>
                            </div>
                        </div>

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

                        @if (auth()->user()->role === "Administrator")
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" value="{{ $transaction->response }}" name="response" placeholder="Enter response">
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
<script>
    // Function to show or hide fields based on the textarea value
    function toggleFields() {
        var detailsToModify = document.getElementById('detailsToModify').value.trim();

        // Split the string by commas to get an array of strings
        var detailsArray = detailsToModify.split(' | ');

        // Get references to field containers
        var titleField = document.getElementById('titleField');
        var firstnameField = document.getElementById('firstnameField');
        var surnameField = document.getElementById('surnameField');
        var othernameField = document.getElementById('othernameField');
        var genderField = document.getElementById('genderField');
        var DOBField = document.getElementById('DOBField');
        var phoneField = document.getElementById('phoneField');
        var resStateField = document.getElementById('resStateField');
        var resLGField = document.getElementById('resLGField');
        var resTownField = document.getElementById('resTownField');
        var resAddField = document.getElementById('resAddField');
        var religionField = document.getElementById('religionField');
        var professionField = document.getElementById('professionField');
        var passportField = document.getElementById('passportField');
        var SOGField = document.getElementById('SOGField');

        // Hide all fields
        titleField.style.display = 'none';
        firstnameField.style.display = 'none';
        surnameField.style.display = 'none';
        othernameField.style.display = 'none';
        genderField.style.display = 'none';
        DOBField.style.display = 'none';
        phoneField.style.display = 'none';
        resStateField.style.display = 'none';
        resLGField.style.display = 'none';
        resTownField.style.display = 'none';
        resAddField.style.display = 'none';
        religionField.style.display = 'none';
        professionField.style.display = 'none';
        passportField.style.display = 'none';
        SOGField.style.display = 'none';

        // Show fields based on the values in the detailsArray
        detailsArray.forEach(function(detail) {
            if (detail === 'title') {
                titleField.style.display = 'block';
            } else if (detail === 'firstname') {
                firstnameField.style.display = 'block';
            } else if (detail === 'surname') {
                surnameField.style.display = 'block';
            } else if (detail === 'othername') {
                othernameField.style.display = 'block';
            } else if (detail === 'gender') {
                genderField.style.display = 'block';
            } else if (detail === 'date_of_birth') {
                DOBField.style.display = 'block';
            } else if (detail === 'phone') {
                phoneField.style.display = 'block';
            } else if (detail === 'residential_state') {
                resStateField.style.display = 'block';
            } else if (detail === 'residential_lg') {
                resLGField.style.display = 'block';
            } else if (detail === 'residential_town') {
                resTownField.style.display = 'block';
            } else if (detail === 'residential_address') {
                resAddField.style.display = 'block';
            } else if (detail === 'religion') {
                religionField.style.display = 'block';
            } else if (detail === 'profession') {
                professionField.style.display = 'block';
            } else if (detail === 'passport') {
                passportField.style.display = 'block';
            } else if (detail === 'state_of_origin') {
                SOGField.style.display = 'block';
            }
        });
    }

    // Call the function initially
    toggleFields();

    // Add an event listener to the textarea to call the function whenever its value changes
    document.getElementById('detailsToModify').addEventListener('change', toggleFields);
</script>





@endsection