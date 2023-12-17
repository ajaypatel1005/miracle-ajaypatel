@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users Create') }}</div>

                <div class="card-body">
                @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible" id="div_success_msg">
                            {{ session()->get('success') }}
                        </div>
                @endif

                @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'users-store') || Auth::user()->user_type_id==1)

                    <form action="{{url('users-store')}}" method="post" class="row g-3" name="frm_users" id="frm_users" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="col-7">
                      <label for="user_type" class="form-label">Select User Type:<span class="text-danger">*</span></label>
                      
                      <select name="user_type" id="user_type" class="form-control @error('user_type') is-invalid @enderror">
                        <option value="">--------Select user type ------------</option>
                        @foreach ($userTypes as $types)
                            <option value="{{ $types->id }}">{{ $types->name}}</option>
                        @endforeach
                    </select>

                      @error('user_type')
                      <span class="text-danger">
                          <div class="invalid-feedback" ></div>
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-7">
                      <label for="name" class="form-label">Name:<span class="text-danger">*</span></label>
                      <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" required>
                      
                      @error('name')
                      <span class="text-danger">
                          <div class="invalid-feedback" ></div>
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-7">
                      <label for="email" class="form-label">Email:<span class="text-danger">*</span></label>
                      <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email ID" required>
                      
                      @error('email')
                      <span class="text-danger">
                          <div class="invalid-feedback" ></div>
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-7">
                      <label for="contact_no" class="form-label">Contact Number:<span class="text-danger">*</span></label>
                      <input type="text" name="contact_no" value="{{old('contact_no')}}" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" placeholder="Contact Number" required>
                      @error('contact_no')
                      <span class="text-danger">
                          <div class="invalid-feedback" ></div>
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-7">
                      <label for="password" class="form-label">Password:<span class="text-danger">*</span></label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                      @error('password')
                      <span class="text-danger">
                          <div class="invalid-feedback" ></div>
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-7">
                      <label for="password-confirm" class="form-label">Confirm Password:<span class="text-danger">*</span></label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    
                    <div class="col-7">
                        <input type = "submit" name = "submit" value = "SAVE" class="btn btn-outline-primary">                       
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