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
                    <form class="form-horizontal form-bordered" enctype="multipart/form-data">
                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Generated Slip <span style="color: red"> *</span></label>
                            <div class="col-lg-6">
                                <div class="row mg-files" data-sort-destination="" data-sort-id="media-gallery" style="position: relative; height: auto;">
                                    @php
                                        $queryString = http_build_query(['data' => $data]);
                                    @endphp

                                    @if ($data['slipType'] === 'standard-slip')
                                        <a href="{{ route('slip.standard') . '?' . $queryString }}" class="mb-1 mt-1 me-1 btn btn-primary" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                            Download Standard Slip
                                        </a>
                                    @elseif ($data['slipType'] === 'premium-slip')
                                        <a href="{{ route('slip.premium') . '?' . $queryString }}" class="mb-1 mt-1 me-1 btn btn-primary" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                            Download Premium Slip
                                        </a>
                                    @elseif ($data['slipType'] === 'improved-nin-slip')
                                        <a href="{{ route('slip.improved') . '?' . $queryString }}" class="mb-1 mt-1 me-1 btn btn-primary" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                            Download Improved Slip
                                        </a>
                                    @elseif ($data['slipType'] === 'nvs-slip')
                                        <a href="{{ route('slip.nvs') . '?' . $queryString }}" class="mb-1 mt-1 me-1 btn btn-primary" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                            Download NVS Slip
                                        </a>
                                    @elseif ($data['slipType'] === 'basic-slip')
                                        <a href="{{ route('slip.basic') . '?' . $queryString }}" class="mb-1 mt-1 me-1 btn btn-primary" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                            Download Basic Slip
                                        </a>
                                    @endif    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Photo <span style="color: red"> *</span></label>
                            <div class="col-lg-6">
                                <div class="row mg-files" data-sort-destination="" data-sort-id="media-gallery" style="position: relative; height: auto;">
                                    <div class="thumbnail">
                                        <div class="thumb-preview">
                                            <a class="thumb-image" href="data:image/jpeg;base64,{{ base64_encode($verificationData['image_data']) }}" target="_blank">
                                                <img src="data:image/jpeg;base64,{{ base64_encode($verificationData['image_data']) }}" class="img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NIN & Tracking ID</label>
                            <div class="col-lg-3">
                                <input type="text" value="{{ $verificationData['message']['nin'] ?? null }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                            <div class="col-lg-3">
                                <input type="text" value="{{ $verificationData['message']['trackingId'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Title</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $verificationData['message']['title'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

            
                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Name</label>
                            <div class="col-lg-2 pb-2">
                                <input type="text" value="{{ $verificationData['message']['surname'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                            <div class="col-lg-2 pb-2">
                                <input type="text" value="{{ $verificationData['message']['firstname'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                            <div class="col-lg-2 pb-2">
                                <input type="text" value="{{ $verificationData['message']['middlename'] ?? null}}" id="inputReadOnly" placeholder="Middlename" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        
                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Gender & Date of Birth <span style="color: red"> *</span></label>
                            <div class="col-lg-3">
                                <input type="text" name="gender" value="{{ Illuminate\Support\Str::title($verificationData['message']['gender']) ?? null }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="dob" value="{{ $verificationData['message']['birthdate'] ?? null }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Nationality & Country of Birth <span style="color: red"> *</span></label>
                            <div class="col-lg-3">
                                <input type="text" name="nationality" value="{{ $verificationData['message']['birthcountry'] ?? null}}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="country_of_birth" value="{{ $verificationData['message']['birthstate'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="country_of_birth" value="{{ $verificationData['message']['birthlga'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Country & State of Residence<span style="color: red"> *</span></label>
                            <div class="col-lg-3">
                                <input type="text" name="country_of_residence" value="{{ $verificationData['message']['surname'] ?? null }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        
                            <div class="col-lg-3">
                                <input type="text" name="state_of_residence" value="{{ $verificationData['message']['residence_state'] ??null }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">LGA of Residence & Town/city<span style="color: red"> *</span></label>
                            <div class="col-lg-3">
                                <input type="text" name="lga_of_residence" value="{{ $verificationData['message']['residence_lga'] ?? null}}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>

                            <div class="col-lg-3">
                                <input type="text" name="town" value="{{ $verificationData['message']['residence_Town'] ?? null}}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Residence Status<span style="color: red"> *</span></label>
                            <div class="col-lg-3">
                                <input type="text" name="lga_of_residence" value="{{ $verificationData['message']['residencestatus'] ?? null}}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Address <span style="color: red"> *</span></label>
                            <div class="col-lg-6">
                                <input type="text" name="address_line_1" value="{{ $verificationData['message']['residence_AdressLine1'] ?? null}}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Religion & Profession <span style="color: red"> *</span></label>
                            <div class="col-lg-3">
                                <input type="text" name="address_line_1" value="{{ $verificationData['message']['religion'] ?? null}}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="address_line_2" value="{{ $verificationData['message']['profession'] ?? NULL}}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Education Level & Employment Status <span style="color: red"> *</span></label>
                            <div class="col-lg-3">
                                <input type="text" name="address_line_1" value="{{ $verificationData['message']['educationallevel'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="address_line_2" value="{{ $verificationData['message']['employmentstatus'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Height <span style="color: red"> *</span></label>
                            <div class="col-lg-6">
                                <input type="text" name="height" value="{{ $verificationData['message']['heigth'] ?? null}}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Spoken Language <span style="color: red"> *</span></label>
                            <div class="col-lg-3">
                                <input type="text" name="height" value="{{ $verificationData['message']['nspokenlang'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="height" value="{{ $verificationData['message']['ospokenlang'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Marital Status <span style="color: red"> *</span></label>
                            <div class="col-lg-6">
                                <input type="text" name="height" value="{{ $verificationData['message']['maritalstatus'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Country, state & LGA of Birth <span style="color: red"> *</span></label>
                            <div class="col-lg-3">
                                <input type="text" name="nationality" value="{{ $verificationData['message']['birthcountry'] ?? null}}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="country_of_birth" value="{{ $verificationData['message']['birthstate'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="country_of_birth" value="{{ $verificationData['message']['birthlga'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Email & Phone Number <span style="color: red"> *</span></label>
                            <div class="col-lg-3">
                                <input type="text" name="email" value="{{ $verificationData['message']['telephoneno'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="phone" value="{{ $verificationData['message']['email'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div id="childEnrollmentDiv">
                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Parent's Name & NIN <span style="color: red"> *</span></label>
                                <div class="col-lg-2">
                                    <input type="text" name="parent_surname" value="{{ $verificationData['message']['pfirstname'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="parent_firstname" value="{{ $verificationData['message']['psurname'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="parent_nin" value="{{ $verificationData['message']['pmiddlename'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NOK Firstname, Surname, Middlename <span style="color: red"> *</span></label>
                            <div class="col-lg-2">
                                <input type="text" name="parent_surname" value="{{ $verificationData['message']['nok_firstname'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-2">
                                <input type="text" name="parent_firstname" value="{{ $verificationData['message']['nok_firstname'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-2">
                                <input type="text" name="parent_nin" value="{{ $verificationData['message']['nok_middlename'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NOK State, Town, Address <span style="color: red"> *</span></label>
                            <div class="col-lg-2">
                                <input type="text" name="parent_surname" value="{{ $verificationData['message']['nok_state'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-2">
                                <input type="text" name="parent_firstname" value="{{ $verificationData['message']['nok_town'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                            <div class="col-lg-2">
                                <input type="text" name="parent_nin" value="{{ $verificationData['message']['nok_address1'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NOK Address <span style="color: red"> *</span></label>
                            <div class="col-lg-2">
                                <input type="text" name="parent_surname" value="{{ $verificationData['message']['nok_address1'] ?? NULL }}" class="form-control" id="inputDefault" readonly="readonly">
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