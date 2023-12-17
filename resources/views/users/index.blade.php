@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible" id="div_success_msg">
                            {{ session()->get('success') }}
                        </div>
                @endif
                
                @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'users-store') || Auth::user()->user_type_id==1)
                <a class="btn btn-primary" href="{{ url('users-create') }}">Create</a>
                @endif

                @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'users-list') || Auth::user()->user_type_id==1)

                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email ID</th>
                        <th>Contact Number</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @php
                        $count=1;
                    @endphp
                    
                    @foreach($users as $row)
                    <tr>
                        <td>{{$count++}}</td>
                        <td>{{$row->name}}</td>                
                        <td>{{$row->email}}</td>                
                        <td>{{$row->contact_no}}</td>                
                        <td>
                        @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'users-update') || Auth::user()->user_type_id==1)
                            <a  href="{{url('users-edit/'.$row->id)}}" class="btn btn-info">Edit</a> 
                            @endif
                            @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'users-delete') || Auth::user()->user_type_id==1)
                            <a  href="{{url('users-delete/'.$row->id)}}" class="btn btn-danger delete-btn" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
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