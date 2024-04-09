@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- purchase airtime -->
        <div class="row">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <h2 class="card-title">NIN Modification</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="get">

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NIN Number</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter NIN number">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Tracking ID</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" placeholder="Enter tracking ID">
                                </div>
                            </div>

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Modification Type</label>
                                <div class="col-lg-6">
                                    <select class="form-control mb-3">
                                        <option>Select Modification Type</option>
                                        <option>Name</option>
                                        <option>Date of Birth</option>
                                        <option>Name & Date of Birth</option>
                                        <option>Others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Details to Modify <br>
                                    <span style="color:red"> * Please select what you want to modify only</span>
                                </label>
                                <div class="col-lg-3">
                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="title" id="checkboxExample1">
                                        <label for="checkboxExample1">Title</label>
                                    </div>

                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="surname" id="checkboxExample1">
                                        <label for="checkboxExample1">Surname</label>
                                    </div>

                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="firstname" id="checkboxExample1">
                                        <label for="checkboxExample1">Firstname</label>
                                    </div>
                                    
                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="othername" id="checkboxExample1">
                                        <label for="checkboxExample1">Othername</label>
                                    </div>

                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="gender" id="checkboxExample1">
                                        <label for="checkboxExample1">Gender</label>
                                    </div>

                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="phone" id="checkboxExample1">
                                        <label for="checkboxExample1">Phone Number</label>
                                    </div>

                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="residential_address" id="checkboxExample1">
                                        <label for="checkboxExample1">Residential Address</label>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="residential_town" id="checkboxExample1">
                                        <label for="checkboxExample1">Residential Town</label>
                                    </div>

                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="residential_lg" id="checkboxExample1">
                                        <label for="checkboxExample1">Residential LG</label>
                                    </div>
                                    
                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="residential_state" id="checkboxExample1">
                                        <label for="checkboxExample1">Residential State</label>
                                    </div>

                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="religion" id="checkboxExample1">
                                        <label for="checkboxExample1">Religion</label>
                                    </div>
                                    
                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="profession" id="checkboxExample1">
                                        <label for="checkboxExample1">Profession</label>
                                    </div>

                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="passport" id="checkboxExample1">
                                        <label for="checkboxExample1">Passport</label>
                                    </div>

                                    <div class="checkbox-custom checkbox-default">
                                        <input type="checkbox" value="state_of_origin" id="checkboxExample1">
                                        <label for="checkboxExample1">State of Origin</label>
                                    </div>
                                </div>
                            </div>          

                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault"></label>
                                <div class="col-lg-6">
                                    <button type="button" class="mt-1 me-1 btn btn-primary btn-lg btn-block">Submit</button>
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
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Modification Type</th>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th class="hide-mob">Status</th>
                                    <th class="hide-mob">Date</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pt-desktop">1</td>
                                    <td class="pt-desktop">Name & Date of Birth</td>
                                    <td class="pt-desktop">89773762211743</td>
                                    <td class="pt-desktop">&#8358;2,000.00</td>
                                    <td class="pt-desktop hide-mob">Success</td>
                                    <td class="hide-mob">12th, January 2024 <br> 12:00PM </td>
                                    <td class="actions">
                                        <button type="button" class="mb-1 mt-1 me-1 btn btn-secondary"><span class="hide-mob">Reciept</span> <i class="fas fa-eye"></i> </button>
                                    </td>
                                </tr>

                             
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>

    <!-- end: page -->
</section>

@endsection