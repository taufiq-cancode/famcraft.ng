@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body card-margin">

    <!-- start: page -->

        <!-- purchase airtime -->
        <div class="row">
            <div class="col">
                <section class="card card-airtime">
                    <header class="card-header">
                        <h2 class="card-title">Notifications</h2>
                    </header>
                    <div class="card-body">
                        <form class="form-horizontal form-bordered" method="POST" action="{{ route('submit.notification') }}">
                            @csrf
                            @method('POST')

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Notification Title</label>
                                <div class="col-lg-6">
                                    <input type="text" name="title" class="form-control" id="inputDefault" placeholder="Enter notification title" maxlength="50">
                                </div>
                            </div>

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Notification Details</label>
                                <div class="col-lg-6">
                                    <textarea type="text" name="details" class="form-control" id="inputDefault" placeholder="Enter notification details"></textarea>
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
                        <h2 class="card-title">Notification History</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifies as $notify)
                                    <tr>
                                        <td class="pt-desktop">{{ $loop->iteration }}</td>
                                        <td class="pt-desktop">{{ $notify->title }}</td>
                                        <td class="">{{ $notify->created_at->format('jS F, Y') }} <br> {{ $notify->created_at->format('g:i A') }}</td>
                                        <td class="actions">
                                            <a href="{{ route('view.notification',['notificationId' => $notify->id]) }}" class="mb-1 mt-1 me-1 btn btn-primary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
                                        </td>
                                        <td class="actions">
                                            <form action="{{ route('delete.notification', ['notificationId' => $notify->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="mb-1 mt-1 me-1 btn btn-danger" style="color: white">
                                                    <span class="hide-mob">Delete</span> <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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

@endsection