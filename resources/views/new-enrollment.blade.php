@extends('admin-theme.theme-master')
@section('content')

<style>
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
                        <h2 class="card-title">New NIN Enrollment</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="POST" action="{{ route('submit.new-enrollment') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Enrollment Type<span style="color: red"> *</span></label>
                                <div class="col-lg-6">
                                    <select id="enrollmentType" name="type" class="form-control mb-3" required>
                                        <option>Select Enrollment Type</option>
                                        <option value="adult">Adult Enrollment</option>
                                        <option value="child">Child Enrollment</option>
                                    </select>                                    
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NIN Number</label>
                                <div class="col-lg-6">
                                    <input type="text" name="nin" class="form-control" id="inputDefault" placeholder="NIN Number">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Name <span style="color: red"> *</span></label>
                                <div class="col-lg-2">
                                    <input type="text" name="surname" class="form-control" id="inputDefault" placeholder="Surname" required>
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="firstname" class="form-control form-mt" id="inputDefault" placeholder="Firstname" required>
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="middlename" class="form-control form-mt" id="inputDefault" placeholder="Middlename" required>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Gender & Date of Birth <span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <select name="gender" class="form-control mb-3" required>
                                        <option>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <input type="date" name="dob" class="form-control" id="inputDefault" required>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Nationality & Country of Birth <span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <select name="nationality" class="form-control mb-3" required>
                                        <option>Select Nationality</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select name="country_of_birth" class="form-control mb-3" required>
                                        <option>Select Country of Birth</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Country & State of Residence<span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <select name="country_of_residence" class="form-control mb-3" required>
                                        <option>Select Country of Residence</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <select name="state_of_residence" class="form-control mb-3" required>
                                        <option>Select State of Residence</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">LGA of Residence & Town/city<span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <select name="lga_of_residence" class="form-control mb-3" required>
                                        <option>Select LGA of Residence</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <input type="text" name="town" class="form-control" id="inputDefault" placeholder="Town of Residence" required>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Address <span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <input type="text" name="address_line_1" class="form-control" id="inputDefault" placeholder="Address line 1" required>
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="address_line_2" class="form-control form-mt" id="inputDefault" placeholder="Address line 1">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Postal/zip Code & Height <span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <input type="text" name="zipcode" class="form-control" id="inputDefault" placeholder="Enter postal/zip code">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="height" class="form-control form-mt" id="inputDefault" placeholder="Enter height" required>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Country & State of Origin</label>
                                <div class="col-lg-3">
                                    <select name="country_of_birth" class="form-control mb-3">
                                        <option>Select Country of Origin</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <select name="country_of_birth" class="form-control mb-3">
                                        <option>Select State of Origin</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Email & Phone Number <span style="color: red"> *</span></label>
                                <div class="col-lg-3">
                                    <input type="text" name="email" class="form-control" id="inputDefault" placeholder="Enter email address" required>
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="phone" class="form-control form-mt" id="inputDefault" placeholder="Enter phone number" required>
                                </div>
                            </div>

                            <div id="childEnrollmentDiv">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Parent's Name & NIN <span style="color: red"> *</span></label>
                                    <div class="col-lg-2">
                                        <input type="text" name="parent_surname" class="form-control" id="inputDefault" placeholder="Parent's surname">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="text" name="parent_firstname" class="form-control form-mt" id="inputDefault" placeholder="Parent's firstname">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="text" name="parent_nin" class="form-control form-mt" id="inputDefault" placeholder="Parent's NIN">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Image <span style="color: red"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="file" name="image" class="form-control" id="inputDefault" accept="image/jpeg, image/jpg, image/png" required>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Left 4 Fingers <span style="color: red"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="file" name="left_4_fingers[]" class="form-control" id="max4" accept="image/jpeg, image/jpg, image/png" multiple required>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Right 4 Fingers <span style="color: red"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="file" name="right_4_fingers[]" class="form-control" id="max4" accept="image/jpeg, image/jpg, image/png" multiple required>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">2 Thumb Fingers <span style="color: red"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="file" name="thumb_2_fingers[]" class="form-control" id="max2" accept="image/jpeg, image/jpg, image/png" multiple required>
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

        <!-- new enrollment history -->
        <div class="row">
            <div class="col">
                <section class="card mb-4">
                    <header class="card-header">
                        <h2 class="card-title">NIN Enrollment History</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th class="hide-mob">Date</th>
                                    <th class="hide-mob">Response</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td class="pt-desktop">{{ $loop->iteration }}</td>
                                <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->firstname) .' '. Illuminate\Support\Str::title($transaction->surname) .' '. Illuminate\Support\Str::title($transaction->middlename)}}</td>
                                <td class="pt-desktop">{{ $transaction->email }}</td>
                                <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->type) }}</td>
                                <td class="pt-desktop hide-mob">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
                                <td class="hide-mob">{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                <td class="pt-desktop hide-mob">{{ Illuminate\Support\Str::title($transaction->response) }}</td>
                                <td class="actions">
                                    <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">Reciept</span> <i class="fas fa-eye"></i> </button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#max4').on('change', function() {
            var numFiles = $(this)[0].files.length;
            if (numFiles < 4) {
                alert('Please select at least 4 images.');
                $(this).val('');
            } else if (numFiles > 4) {
                alert('Please select only 4 images.');
                $(this).val('');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#max2').on('change', function() {
            var numFiles = $(this)[0].files.length;
            if (numFiles < 2) {
                alert('Please select at least 2 images.');
                $(this).val('');
            } else if (numFiles > 2) {
                alert('Please select only 2 images.');
                $(this).val('');
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectElement = document.getElementById('enrollmentType');

        var childDiv = document.getElementById('childEnrollmentDiv');

        selectElement.addEventListener('change', function() {
            if (selectElement.value === 'adult') {
                childDiv.style.display = 'none';
            } else {
                childDiv.style.display = 'block';
            }
        });
    });
</script>



@endsection