@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- purchase airtime -->
        <div class="row">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <img src="{{ asset('img/logos/nimc.jpg') }}" width="130" alt="NIMC" />
                        <br><br>
                        <h2 class="card-title">NIN Modification</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="POST" action="{{ route('submit.modification') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NIN Number</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="nin" id="inputDefault" placeholder="Enter NIN number" required>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Tracking ID</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="tracking_id" id="inputDefault" placeholder="Enter tracking ID" required>
                                </div>
                            </div>

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Modification Type</label>
                                <div class="col-lg-6">
                                    <select id="modificationType" name="modification_type" class="form-control mb-3" required>
                                        <option value="">Select Modification Type</option>
                                        <option value="name">Name</option>
                                        <option value="dob">Date of Birth</option>
                                        <option value="name_dob">Name & Date of Birth</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                            </div>

                            <div id="nameFields" style="display: none;">
                                <div class="form-group row pb-2">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Name <span style="color: red"> *</span></label>
                                    <div class="col-lg-2">
                                        <input type="text" name="surname" class="form-control" id="inputDefault" placeholder="Surname">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="text" name="firstname" class="form-control form-mt" id="inputDefault" placeholder="Firstname" >
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="text" name="middlename" class="form-control form-mt" id="inputDefault" placeholder="Middlename">
                                    </div>
                                </div>
                            </div>
                            
                            <div id="dobFields" style="display: none;">
                                <div class="form-group row pb-2">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Date of Birth <span style="color: red"> *</span></label>
                                    <div class="col-lg-6">
                                        <input type="date" name="dob" class="form-control" id="inputDefault">
                                    </div>
                                </div>
                            </div>
                            
                            <div id="nameDobFields" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Name <span style="color: red"> *</span></label>
                                    <div class="col-lg-2">
                                        <input type="text" name="surname_2" class="form-control" id="inputDefault" placeholder="Surname">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="text" name="firstname_2" class="form-control form-mt" id="inputDefault" placeholder="Firstname">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="text" name="middlename_2" class="form-control form-mt" id="inputDefault" placeholder="Middlename">
                                    </div>
                                </div>
                                
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Date of Birth <span style="color: red"> *</span></label>
                                    <div class="col-lg-6">
                                        <input type="date" name="dob_2" class="form-control" id="inputDefault">
                                    </div>
                                </div>
                            </div>
                            
                            <div id="othersFields" style="display: none;">
                                <div class="form-group row pb-2">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Details to Modify <br>
                                        <span style="color:red"> * Please select what you want to modify only</span>
                                    </label>
                                    <div class="col-lg-3">

                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="title" id="checkboxTitle">
                                            <label for="checkboxTitle">Title</label>
                                        </div>

                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="surname" id="checkboxSurname">
                                            <label for="checkboxSurname">Surname</label>
                                        </div>

                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="firstname" id="checkboxFirstname">
                                            <label for="checkboxFirstname">Firstname</label>
                                        </div>
                                        
                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="othername" id="checkboxOthername">
                                            <label for="checkboxOthername">Othername</label>
                                        </div>

                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="gender" id="checkboxGender">
                                            <label for="checkboxGender">Gender</label>
                                        </div>

                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="date_of_birth" id="checkboxDOB">
                                            <label for="checkboxDOB">Date of Birth</label>
                                        </div>

                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="phone" id="checkboxPhone">
                                            <label for="checkboxPhone">Phone Number</label>
                                        </div>

                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="residential_address" id="checkboxResAdd">
                                            <label for="checkboxResAdd">Residential Address</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="residential_town" id="checkboxResTown">
                                            <label for="checkboxResTown">Residential Town</label>
                                        </div>

                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="residential_lg" id="checkboxResLG">
                                            <label for="checkboxResLG">Residential LG</label>
                                        </div>
                                        
                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="residential_state" id="checkboxResState">
                                            <label for="checkboxResState">Residential State</label>
                                        </div>

                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="religion" id="checkboxReligion">
                                            <label for="checkboxReligion">Religion</label>
                                        </div>
                                        
                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="profession" id="checkboxProfession">
                                            <label for="checkboxProfession">Profession</label>
                                        </div>

                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="passport" id="checkboxPassport">
                                            <label for="checkboxPassport">Passport</label>
                                        </div>

                                        <div class="checkbox-custom checkbox-default">
                                            <input type="checkbox" name="details_to_modify[]" value="state_of_origin" id="checkboxSOG">
                                            <label for="checkboxSOG">State of Origin</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <br>

                            <div id="titleField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Title <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" name="title" class="form-control" id="inputDefault" placeholder="Mr / Mrs / Miss">
                                    </div>
                                </div>
                            </div>

                            <div id="firstnameField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Firstname <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" name="firstname_3" class="form-control" id="inputDefault" placeholder="Firstname">
                                    </div>
                                </div>
                            </div>

                            <div id="surnameField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Surname <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" name="surname_3" class="form-control" id="inputDefault" placeholder="Surname">
                                    </div>
                                </div>
                            </div>

                            <div id="othernameField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Othername <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" name="middlename_3" class="form-control" id="inputDefault" placeholder="Othername">
                                    </div>
                                </div>
                            </div>

                            <div id="genderField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Gender <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <select name="gender" class="form-control mb-3">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="DOBField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end" for="inputDefault">Date of Birth <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="date" name="dob_3" class="form-control" id="inputDefault">
                                    </div>
                                </div>
                            </div>

                            <div id="phoneField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Phone Number <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" name="phone" class="form-control" id="inputDefault" placeholder="Phone Number">
                                    </div>
                                </div>
                            </div>

                            <div id="resStateField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residential State <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" name="state_of_residence" class="form-control" id="inputDefault" placeholder="Residential State" >
                                    </div>
                                </div>
                            </div>

                            <div id="resLGField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residential Local Government <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" name="lga_of_residence" class="form-control" id="inputDefault" placeholder="Residential Local Government" >
                                    </div>
                                </div>
                            </div>

                            <div id="resTownField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residential Town/City <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" name="town" class="form-control" id="inputDefault" placeholder="Residential Town/City" >
                                    </div>
                                </div>
                            </div>

                            <div id="resAddField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residential Address <span style="color: red"> *</span></label>
                                    <div class="col-lg-3">
                                        <input type="text" name="address_line_1" class="form-control" id="inputDefault" placeholder="Address line 1">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="address_line_2" class="form-control form-mt" id="inputDefault" placeholder="Address line 1">
                                    </div>
                                </div>
                            </div>

                            <div id="religionField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Religion <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <select name="religion" class="form-control mb-3" >
                                            <option value="">Select Religion</option>
                                            <option value="Christianity">Christianity</option>
                                            <option value="Islam">Islam</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="professionField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Profession <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" name="profession" class="form-control" id="inputDefault" placeholder="Profession">
                                    </div>
                                </div>
                            </div>

                            <div id="passportField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Passport <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="file" name="passport" class="form-control" id="inputDefault" placeholder="Passport" accept="image/jpeg, image/jpg, image/png">
                                    </div>
                                </div>
                            </div>

                            <div id="SOGField" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">State of Origin <span style="color: red">*</span></label>
                                    <div class="col-lg-6">
                                        <select name="state_of_origin" class="form-control mb-3">
                                            <option value="">Select State of Origin</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state['state'] }}">{{ $state['state'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault"></label>
                                <div class="col-lg-6">
                                    <button type="submit" class="mt-1 me-1 btn btn-primary btn-lg btn-block">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>

        <!-- airtime history -->
        <div class="row">
            <div class="col">
                <section class="card mb-4">
                    <header class="card-header">
                     
                        <h2 class="card-title">NIN Modification History</h2>
                    </header>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIN Number</th>
                                        <th>Modification Type</th>
                                        <th>Amount</th>
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
                                        <td class="pt-desktop">{{ $transaction->nin }}</td>
                                        <td class="pt-desktop">{{ $transaction->modification_type }}</td>
                                        <td class="pt-desktop">&#8358;{{ number_format($transaction->price) }}</td>
                                        <td>{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->response) }}</td>
                                        <td class="actions">
                                            <a href="{{ route('view.modification',['modificationId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach                             
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    <!-- end: page -->
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.getElementById("modificationType").addEventListener("change", function() {
        var selectedOption = this.value;
    
        // Hide all field divs
        document.getElementById("nameFields").style.display = "none";
        document.getElementById("dobFields").style.display = "none";
        document.getElementById("nameDobFields").style.display = "none";
        document.getElementById("othersFields").style.display = "none";
    
        // Show the selected field div
        if (selectedOption === "name") {
            document.getElementById("nameFields").style.display = "block";
        } else if (selectedOption === "dob") {
            document.getElementById("dobFields").style.display = "block";
        } else if (selectedOption === "name_dob") {
            document.getElementById("nameDobFields").style.display = "block";
        } else if (selectedOption === "others") {
            document.getElementById("othersFields").style.display = "block";
        }
    });
</script>

<script>
    // Get references to the checkboxes
    const checkboxTitle = document.getElementById("checkboxTitle");
    const checkboxSurname = document.getElementById("checkboxSurname");
    const checkboxFirstname = document.getElementById("checkboxFirstname");
    const checkboxOthername = document.getElementById("checkboxOthername");
    const checkboxGender = document.getElementById("checkboxGender");
    const checkboxDOB = document.getElementById("checkboxDOB");
    const checkboxPhone = document.getElementById("checkboxPhone");
    const checkboxResAdd = document.getElementById("checkboxResAdd");
    const checkboxResTown = document.getElementById("checkboxResTown");
    const checkboxResLG = document.getElementById("checkboxResLG");
    const checkboxResState = document.getElementById("checkboxResState");
    const checkboxReligion = document.getElementById("checkboxReligion");
    const checkboxProfession = document.getElementById("checkboxProfession");
    const checkboxPassport = document.getElementById("checkboxPassport");
    const checkboxSOG = document.getElementById("checkboxSOG");
    
    // Get references to the corresponding input field divs
    const titleField = document.getElementById("titleField");
    const firstnameField = document.getElementById("firstnameField");
    const surnameField = document.getElementById("surnameField");
    const othernameField = document.getElementById("othernameField");
    const genderField = document.getElementById("genderField");
    const DOBField = document.getElementById("DOBField");
    const phoneField = document.getElementById("phoneField");
    const resStateField = document.getElementById("resStateField");
    const resLGField = document.getElementById("resLGField");
    const resTownField = document.getElementById("resTownField");
    const resAddField = document.getElementById("resAddField");
    const religionField = document.getElementById("religionField");
    const professionField = document.getElementById("professionField");
    const passportField = document.getElementById("passportField");
    const SOGField = document.getElementById("SOGField");
    
    // Add event listeners to the checkboxes
    checkboxTitle.addEventListener("change", function() {
        if (this.checked) {
            titleField.style.display = "block";
        } else {
            titleField.style.display = "none";
        }
    });

    checkboxFirstname.addEventListener("change", function() {
        if (this.checked) {
            firstnameField.style.display = "block";
        } else {
            firstnameField.style.display = "none";
        }
    });
    
    checkboxSurname.addEventListener("change", function() {
        if (this.checked) {
            surnameField.style.display = "block";
        } else {
            surnameField.style.display = "none";
        }    
    });

    checkboxOthername.addEventListener("change", function() {
        if (this.checked) {
            othernameField.style.display = "block";
        } else {
            othernameField.style.display = "none";
        }    
    });

    checkboxGender.addEventListener("change", function() {
        if (this.checked) {
            genderField.style.display = "block";
        } else {
            genderField.style.display = "none";
        }    
    });

    checkboxDOB.addEventListener("change", function() {
        if (this.checked) {
            DOBField.style.display = "block";
        } else {
            DOBField.style.display = "none";
        }    
    });

    checkboxPhone.addEventListener("change", function() {
        if (this.checked) {
            phoneField.style.display = "block";
        } else {
            phoneField.style.display = "none";
        }    
    });

    checkboxResAdd.addEventListener("change", function() {
        if (this.checked) {
            resAddField.style.display = "block";
        } else {
            resAddField.style.display = "none";
        }    
    });

    checkboxResTown.addEventListener("change", function() {
        if (this.checked) {
            resTownField.style.display = "block";
        } else {
            resTownField.style.display = "none";
        }    
    });

    checkboxResLG.addEventListener("change", function() {
        if (this.checked) {
            resLGField.style.display = "block";
        } else {
            resLGField.style.display = "none";
        }    
    });

    checkboxResState.addEventListener("change", function() {
        if (this.checked) {
            resStateField.style.display = "block";
        } else {
            resStateField.style.display = "none";
        }    
    });

    checkboxReligion.addEventListener("change", function() {
        if (this.checked) {
            religionField.style.display = "block";
        } else {
            religionField.style.display = "none";
        }    
    });

    checkboxProfession.addEventListener("change", function() {
        if (this.checked) {
            professionField.style.display = "block";
        } else {
            professionField.style.display = "none";
        }    
    });

    checkboxPassport.addEventListener("change", function() {
        if (this.checked) {
            passportField.style.display = "block";
        } else {
            passportField.style.display = "none";
        }    
    });

    checkboxSOG.addEventListener("change", function() {
        if (this.checked) {
            SOGField.style.display = "block";
        } else {
            SOGField.style.display = "none";
        }    
    });
    
</script>

@endsection