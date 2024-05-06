@extends('admin-theme.theme-master')
@section('content')

<section role="main" class="content-body">
    <!-- start: page -->

    <div class="row mt-4">
        <div class="col">
            <section class="card mb-4">
                <header class="card-header">
                    <h2 class="card-title">Agents</h2>
                </header>
                <div class="card-body">
                    <table class="table table-responsive-md mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Balance</th>
                                <th>Date Registered</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="pt-desktop">{{ $loop->iteration }}</td>
                                    <td class="pt-desktop">{{ Illuminate\Support\Str::title($user->first_name) }} {{ Illuminate\Support\Str::title($user->last_name) }}</td>
                                    <td class="pt-desktop">{{ $user->email }}</td>
                                    <td class="pt-desktop">&#8358;{{ number_format(optional($user->wallet)->balance) }}</td>
                                    <td class="hide-mob">{{ $user->created_at->format('jS F, Y') }} <br> {{ $user->created_at->format('g:i A') }}</td>
                                    <td class="pt-desktop">{{ $user->role }}</td>    
                                    <td class="pt-desktop">{{ $user->is_active ? 'Active' : 'Inactive' }}</td>    

                                    <td class="actions">
                                        <a href="{{ route('view.user',['userId' => $user->id]) }}" class="mb-1 mt-1 me-1 btn btn-secondary" style="color: white"><span class="hide-mob">View</span> <i class="fas fa-eye"></i> </a>
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