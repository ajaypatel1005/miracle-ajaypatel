@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Types') }}</div>

                <div class="card-body">
                @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible" id="div_success_msg">
                            {{ session()->get('success') }}
                        </div>
                @endif
                
                @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'user-type-store') || Auth::user()->user_type_id==1)
                <a class="btn btn-primary" href="{{ url('user-type-create') }}">Create</a>
                @endif

                @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'user-type-list') || Auth::user()->user_type_id==1)

                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @php
                        $count=1;
                    @endphp
                    
                    @foreach($userTypes as $row)
                    <tr>
                        <td>{{$count++}}</td>
                        <td>{{$row->name}}</td>                
                        <td>
                        @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'user-type-update') || Auth::user()->user_type_id==1)
                            <a  href="{{url('user-type-edit/'.$row->id)}}" class="btn btn-info">Edit</a> 
                            @endif
                            @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'user-type-delete') || Auth::user()->user_type_id==1)
                            <a  href="{{url('user-type-delete/'.$row->id)}}" class="btn btn-danger delete-btn" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>



@endsection