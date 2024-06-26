@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

    <!-- Instructions -->
    <div class="row mt-desktop-2">
        <div class="col-12">
            
            <section class="card">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h3>Please ensure the NIN is not <strong>Suspended, By Pass, or BVN Generated</strong></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
                </div>
            </section>
        </div>
    </div>

        <!-- purchase airtime -->
        <div class="row">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <h2 class="card-title">NIN Validation</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="POST" action="{{ route('submit.validation') }}">
                            @csrf
                            @method('POST')

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">NIN Number</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" name="nin" placeholder="Enter NIN number">
                                </div>
                            </div>

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Validation Category</label>
                                <div class="col-lg-6">
                                    <select name="validation_category" class="form-control mb-3">
                                        <option>Choose validation category</option>
                                        <option value="no-record-found">No record found</option>
                                        <option value="update-record">Update record</option>
                                        <option value="validation-modification">Validate modification</option>
                                        <option value="v-nin-validation">V-NIN validation</option>
                                        <option value="photograph-error">Photograph error</option>
                                        <option value="by-pass-nin">By pass NIN</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-2">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Validation For</label>
                                <div class="col-lg-6">
                                    <select name="validation_purpose" class="form-control mb-3">
                                        <option>Choose validation purpose</option>
                                        <option value="bank">Bank</option>
                                        <option value="sim">Sim</option>
                                        <option value="passport">Passport</option>
                                        <option value="others">Others</option>
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
                        <h2 class="card-title">NIN Validation History</h2>
                    </header>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIN Number</th>
                                        <th>Validation Category</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Response</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td class="pt-desktop">{{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration }}</td>
                                            <td class="pt-desktop">{{ $transaction->nin }}</td>
                                            <td class="pt-desktop">{{ $transaction->validation_category }}</td>
                                            <td class="pt-desktop">&#8358;{{ number_format($transaction->price) }}</td>
                                            <td class="">{{ $transaction->created_at->format('jS F, Y') }} <br> {{ $transaction->created_at->format('g:i A') }}</td>
                                            <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->status) }}</td>
                                            <td class="pt-desktop">{{ Illuminate\Support\Str::title($transaction->response) }}</td>
                                            <td class="actions">
                                                <a href="{{ route('view.validation',['validationId' => $transaction->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $transactions->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </section>
            </div>
        </div>

    <!-- end: page -->
</section>

@endsection