@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Type Create') }}</div>

                <div class="card-body">
                @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible" id="div_success_msg">
                            {{ session()->get('success') }}
                        </div>
                @endif
                @if($userPermissionList && $userPermissionList->contains('permissions.slug', 'user-type-update') || Auth::user()->user_type_id==1)

                    <form action="{{url('user-type-update')}}" method="post" class="row g-3" name="frm_user_type" id="frm_user_type" enctype="multipart/form-data" novalidate>
                    @csrf

                    <input type="hidden" class="form-control" name="user_type_id" id="user_type_id" value="{{$data->id}}"/>
  
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
                      <label for="permission" class="form-label">Permission:</label>
                      
                      @include('permissions-tree', ['permissions' => $permissions,'data' => $data])
                    </div>

                    <div class="col-7">
                        <input type = "submit" name = "submit" value = "Update" class="btn btn-outline-primary">                       
                        <input type="reset" class="btn btn-outline-dark" value="Reset">
                        <a class="btn btn-outline-danger" href="{{ url('user-type') }}">Back</a>
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