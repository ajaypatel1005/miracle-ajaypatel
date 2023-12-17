@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'users') || Auth::user()->user_type_id==1)
                    <div class="card" style="width: 18rem;">
                    
                    <a href="users" class="btn btn-primary">
                    <div class="card-body">
                        <h5 class="card-title">Manage User</h5>
                    </div>
                        </a>
                    </div>
                    @endif

                    @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'user-type') || Auth::user()->user_type_id==1)
                    <div class="card mt-2" style="width: 18rem;">
                    
                    <a href="user-type" class="btn btn-primary">
                    <div class="card-body">
                        <h5 class="card-title">Manage Users Types</h5>
                    </div>
                        </a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
