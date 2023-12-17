@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Type Create') }}</div>

                <div class="card-body">
                @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible">
                            {{ session()->get('success') }}
                        </div>
                @endif
                @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible" >
                            {{ session()->get('error') }}
                        </div>
                @endif

                @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'users-update') || Auth::user()->user_type_id==1)

                    <form action="{{url('users-update')}}" method="post" class="row g-3" name="frm_users" id="frm_users" enctype="multipart/form-data" novalidate>
                    @csrf

                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{$data->id}}"/>
  
                    <div class="col-7">
                      <label for="user_type" class="form-label">Select User Type:<span class="text-danger">*</span></label>
                      
                      <select name="user_type" id="user_type" class="form-control @error('user_type') is-invalid @enderror">
                        <option value="">--------Select user type ------------</option>
                        @foreach ($userTypes as $types)
                            <option value="{{ $types->id }}" @if($types->id == $data->user_type_id) selected @endif>{{ $types->name}}</option>
                        @endforeach
                    </select>

                    <div class="col-7">
                      <label for="name" class="form-label">Name:<span class="text-danger">*</span></label>
                      <input type="text" name="name" value="{{$data->name}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" required> 
                      @error('name')
                      <span class="text-danger">
                          <div class="invalid-feedback" ></div>
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-7">
                      <label for="email" class="form-label">Email:<span class="text-danger">*</span></label>
                      <input type="text" name="email" value="{{$data->email}}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email ID" required>
                      
                      @error('email')
                      <span class="text-danger">
                          <div class="invalid-feedback" ></div>
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-7">
                      <label for="contact_no" class="form-label">Contact Number:<span class="text-danger">*</span></label>
                      <input type="text" name="contact_no" value="{{$data->contact_no}}" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" placeholder="Contact Number" required>
                      @error('contact_no')
                      <span class="text-danger">
                          <div class="invalid-feedback" ></div>
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-7 mt-2">
                        <input type = "submit" name = "submit" value = "Update" class="btn btn-outline-primary">                       
                        <input type="reset" class="btn btn-outline-dark" value="Reset">
                        <a class="btn btn-outline-danger" href="{{ url('users') }}">Back</a>
                    </div>
                    </form>

                    @else
                    <div class="alert alert-danger alert-dismissible">
                                Permission Not allow..!!
                        </div>
                        @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection