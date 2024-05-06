@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

    <div class="row mt-desktop">
        <div class="col">
            <section class="card card-airtime">
                <header class="card-header">
                    <h2 class="card-title">Notification Details</h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal form-bordered">

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Title</label>
                            <div class="col-lg-6">
                                <input type="text" value="{{ Illuminate\Support\Str::title($notification->title) }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                        </div>

                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Details</label>
                            <div class="col-lg-6">
                                <textarea type="text" id="inputReadOnly" class="form-control" readonly="readonly">{{ $notification->details }}</textarea>                        
                            </div>
                        </div>
                       
                        <div class="form-group row pb-4">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Notification Date</label>
                            <div class="col-lg-3">
                                <input type="text" value="{{ $notification->created_at->format('jS F, Y') }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                            </div>
                            <div class="col-lg-3">
                                <input type="text" value="{{ $notification->created_at->format('g:i A') }}" id="inputReadOnly" class="form-control" readonly="readonly">                         
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