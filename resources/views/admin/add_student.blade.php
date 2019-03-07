@extends('layouts.adminapp')
@section('content')
<section class="member-login my-5 py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="main-victo mt-5 pt-5">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
            <div class="col-md-6 text-center login-sheet">
                <h1 class="my-4">Add Student</h1>

                <div class="form-row">
                
                    <form  method = 'post' action = "{{url('admin/add_student_post')}}" class="m-auto" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
            
                        @include('partials.errors')
                        @include('partials.success_insert')
                        <div class="col-9 m-auto">
                            <div class="input-group mb-1 ">
                                <input name ='image' type="file" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <select name ='school_id'  class="form-control"  required autofocus>
                                    <option value = '1' selected  > American </option>
                                </select>
                            </div>
                        </div>
                        @if ($errors->has('school_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('school_id') }}</strong>
                            </span>
                        @endif

                        <div class="col-12">
                            <div class="input-group mb-2">
                                <select name ='year_id' class="form-control year_id"  required autofocus >
                                    <option value = ''>Level</option>
                                    @foreach ($years as $year)
                                    <option value="{{$year->id}}">{{$year->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if ($errors->has('year_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('year_id') }}</strong>
                            </span>
                        @endif
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <select name = 'class_id' class="form-control class_id"  required autofocus >
                                    <option value = '' >Choose Class</option>
                                </select>
                            </div>
                        </div>
                        @if ($errors->has('class_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('class_id') }}</strong>
                            </span>
                        @endif
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name = 'name' value = "{{ old('name')}}"  type="text" class="form-control" placeholder="Name"  required autofocus>
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name = 'student_id_in_school'  value = "{{ old('student_id_in_school')}}" type="text" class="form-control" placeholder="Student ID (optional)">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name = 'phone'  value = "{{ old('phone')}}" type="text" class="form-control" placeholder="Mobile Number (optional)">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input  name = 'address'  value = "{{ old('address')}}" type="text" class="form-control" placeholder="Adress (optional)">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name = 'email'  value = "{{ old('email')}}" type="mail" class="form-control" placeholder="Email (optional)">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name = 'username'  value = "{{ old('username')}}" type="text" class="form-control" placeholder="User Name"  required autofocus>
                            </div>
                        </div>
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name = 'password'  value = "{{ old('password')}}" type="password" class="form-control" placeholder="Password"  required autofocus>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <div class="col-12">
                            <div class="input-group mb-2">
                                
                                <input  name = 'confirmpassword'  value = "{{ old('confirmpassword')}}" type="password" class="form-control" placeholder="Confirm Password"  required autofocus>
                            </div>
                        </div>
                        @if ($errors->has('confirmpassword'))
                            <span class="help-block">
                                <strong>{{ $errors->first('confirmpassword') }}</strong>
                            </span>
                        @endif
                        <div class="col-12">
                            <div class="input-group mb-5">
                                <button type="submit" class="btn btn-warning btn-block py-3"> Add</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
