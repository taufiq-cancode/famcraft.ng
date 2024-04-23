@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

    <div class="row mt-desktop">
        <div class="col">
            <section class="card card-airtime">
                <header class="card-header">
                    <h2 class="card-title">NIN IPE Clearance</h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" method="POST" action="{{ route('update.validation', ['validationId' => $transaction->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">IPE Category</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $transaction->ipe_category }}" id="inputReadOnly" class="form-control" readonly="readonly">                            
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Tracking ID</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ $transaction->tracking_id }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-2">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Status</label>
                            <div class="col-lg-6">
                                <select name="status" class="form-control mb-3">
                                    <option selected="" value="{{ $transaction->status }}" disabled="">{{ ucfirst(strtolower($transaction->status)) }}</option>
                                    <option value="completed">Completed</option>
                                    <option value="success">Success</option>
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

@endsection