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
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Item Name</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" name="item_name" placeholder="Enter item name">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Item Price</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDefault" name="price" placeholder="Enter item price">
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