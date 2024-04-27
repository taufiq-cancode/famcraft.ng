@extends('admin-theme.theme-master')
@section('content')

<style>
    .pricing-table [class*="col-lg-"] {
        padding-left: 0px;
        padding-right: 10px !important;
    }
</style>

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- purchase airtime -->
        <div class="row mt-desktop">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <h2 class="card-title">Add Pricing</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="POST" action="{{ route('submit.pricing') }}">
                            @csrf
                            @method('POST')

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Item</label>
                                <div class="col-lg-6">
                                    <select name="item_name" class="form-control" required>
                                        <option>Select Item</option>
                                        <option value="per-verification-request">Per verification request</option>
                                        <option value="basic-slip">Basic slip</option>
                                        <option value="standard-slip">Standard slip</option>
                                        <option value="improved-slip">Improved slip</option>
                                        <option value="premium-slip">Premium slip</option>
                                        <option value="nvs-basic-slip">NVS basic slip</option>
                                        <option value="per-personalization-request">Per personalization request</option>
                                        <option value="no-record-found">No record found</option>
                                        <option value="photograph-error">Photograph error</option>
                                        <option value="vnin-validation">V-NIN validation</option>
                                        <option value="in-processing-error">In processing error</option>
                                        <option value="still-being-in-process">Still being in process</option>
                                        <option value="new-enrollment-for-old-tracking">New enrollment for old tracking</option>
                                        <option value="child-enrollment">Child enrollment</option>
                                        <option value="adult-enrollment">Adult enrollment</option>
                                        <option value="name-modification">Name modification</option>
                                        <option value="date-of-birth-modification">Date of birth modification</option>
                                        <option value="name-date-of-birth-modification">Name & Date of birth modification</option>
                                        <option value="dob-other-modification">DOB & other modification</option>
                                        <option value="other-modification">Other modification</option>
                                        <option value="bvn-nin-modification">BVN NIN modification</option>
                                        <option value="suspended-nin-modification">Suspended NIN modification</option>
                                        <option value="name-mod-ipe">Name mod ipe</option>
                                        <option value="mod-validation">Mod validation</option>
                                        <option value="dob-mod-ipe">DOB mod IPE</option>
                                        <option value="dob-mod-validation">DOB mod validation</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Category</label>
                                <div class="col-lg-6">
                                    <select name="pricing_category_id" class="form-control" required>
                                        <option>Select Pricing Category</option>
                                        @foreach ($pricing_categories as $pricing_category)
                                            <option value="{{ $pricing_category->id }}">{{ $pricing_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Item Price</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" name="price" placeholder="Enter item price">
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

        <br>

        <div class="row mt-desktop">
            <div class="col">
                <div class="pricing-table princig-table-flat row no-gutters mt-3 mb-3">
                    @foreach ($pricing_categories as $pricing_category)
                        <div class="col-lg-3 col-sm-6 mb-4">
                            <div class="plan">
                                <h3><span>{{ $pricing_category->name }}</span>Duration: <b>{{ $pricing_category->duration }}</b></h3>
                                <ul>
                                    @foreach ($pricing_category->pricings as $pricing)
                                        <li><strong>&#8358;{{ number_format($pricing->price)}} </strong> - {{ $pricing->item_name }}</li>                                    
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    <!-- end: page -->
</section>

@endsection