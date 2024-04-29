@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- purchase airtime -->
        <div class="row">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <img src="{{ asset('img/logos/nimc2.jpg') }}" width="130" alt="NIMC" />
                    <br><br>
                        <h2 class="card-title">NIN Verification</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="POST" action="{{ route('submit.verification') }}">
                            @csrf
                            @method('POST')

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Method</label>
                                <div class="col-lg-6">
                                    <select id="verifyMethod" name="method" class="form-control mb-3" required>
                                        <option value="">Select Verification Method</option>
                                        <option value="by-demographics">By Demographics</option>
                                        <option value="by-phone">By Phone Number</option>
                                        <option value="by-nin">By NIN Number</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="demoFields" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Name</label>
                                    <div class="col-lg-3">
                                        <input type="text" name="surname" class="form-control" id="inputDefault" placeholder="Enter surname">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="firstname" class="form-control" id="inputDefault" placeholder="Enter firstname">
                                    </div>
                                </div>

                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Gender</label>
                                    <div class="col-lg-6">
                                        <select name="gender" class="form-control mb-3">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Date of Birth</label>
                                    <div class="col-lg-6">
                                        <input type="date" name="dob" class="form-control" id="inputDefault">
                                    </div>
                                </div>
                            </div>

                            <div class="phoneFields" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Phone Number</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="phone" class="form-control" id="inputDefault" placeholder="Enter phone number">
                                    </div>
                                </div>
                            </div>

                            <div class="NINFields" style="display: none;">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NIN Number</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="nin" class="form-control" id="inputDefault" placeholder="Enter NIN number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Generate Slip</label>
                                <div class="col-lg-6">
                                    <select name="slip_type" class="form-control mb-3">
                                        <option value="">Select Slip Type</option>
                                        <option value="premium-slip">Premium Slip</option>
                                        <option value="standard-slip">Standard Slip</option>
                                        <option value="improved-nin-slip">Improved NIN Slip</option>
                                        <option value="basic-slip">Basic Slip</option>
                                    </select>
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
                        <h2 class="card-title">NIN Verification History</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Verification Method</th>
                                    <th>Slip Type</th>
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
                                        <td class="pt-desktop">{{ $transaction->method }}</td>
                                        <td class="pt-desktop">{{ $transaction->slip_type }}</td>
                                        <td class="pt-desktop">&#8358;{{ number_format($transaction->price) }}</td>
                                        <td>{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
                                        <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->response) }}</td>
                                        <td class="actions">
                                            <a href="{{ route('view.verification',['verificationId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
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
    document.getElementById("verifyMethod").addEventListener("change", function() {
        var selectedOption = this.value;
    
        // Hide all field divs
        document.querySelector(".demoFields").style.display = "none";
        document.querySelector(".phoneFields").style.display = "none";
        document.querySelector(".NINFields").style.display = "none";
    
        // Show the selected field div
        if (selectedOption === "by-demographics") {
            document.querySelector(".demoFields").style.display = "block";
        } else if (selectedOption === "by-phone") {
            document.querySelector(".phoneFields").style.display = "block";
        } else if (selectedOption === "by-nin") {
            document.querySelector(".NINFields").style.display = "block";
        }
    });
</script>


@endsection