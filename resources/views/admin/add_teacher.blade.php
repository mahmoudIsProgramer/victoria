@extends('layouts.adminapp')
@section('content')

<section class="member-login my-5 py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="main-victo mt-5 pt-5">
                <i class="fas fa-chalkboard-teacher "></i>
                </div>
            </div>
            <div class="col-md-6 text-center login-sheet">
                <h1 class="my-4">Add Teacher</h1>
                <div class="form-row">
                    <form  method = 'post' action = "{{url('admin/add_teacher_post')}}" class="m-auto" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="materials_selectbox_names">
                    
                        
                        @include('partials.errors')
                        @include('partials.success_insert')

                        <div class="col-9 m-auto">
                            <div class="input-group mb-1 ">
                                <input name = 'image' type="file" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <select name = 'school_id' class="form-control" >
                                {{-- <option>School</option> --}}
                                <option value = '1'>American</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="input-group mb-2">
                                <select name ='level_id' required   autofocus class="form-control level_id" >
                                <option>Level</option>
                                @foreach ($levels as  $level )
                                    <option value="{{$level->id}}">{{ $level->name }}</option>
                                @endforeach
                                
                                </select>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class=" my-4 teacher-grades">
                            <div class="grade-details mb-1 ">
                                {{-- this div contain years and it's classes  --}}
                                <div class="form-check grade-descrep years">
                                    
                                </div>
                            </div>
                            
                            </div>
                        </div>
                        <div class="col-12 materials">
                            <div class="input-group mb-2">
                                {{--  <select name = 'material_id'  required autofocus class="form-control" >
                                <option value = '' >Material</option>
                                @foreach ($materials as  $material )
                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach
                                </select>  --}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name = 'name' required autofocus  value = "{{ old('name')}}" type="text" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name= 'phone' type="text"  value = "{{ old('phone')}}" class="form-control" placeholder="Mobile Number (optional)">
                            </div>
                        </div>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name = 'address' type="text" value = "{{ old('address')}}" class="form-control" placeholder="Adress (optional)">
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name = 'email' type="email" value = "{{ old('email')}}" class="form-control" placeholder="Email (optional)">
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name='username' required autofocus  type="text" value = "{{ old('username')}}" class="form-control" placeholder="User Name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name = 'password' required autofocus  type="password" value = "{{ old('password')}}" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <input name = 'confirmpassword' required autofocus type="password" value = "{{ old('confirmpassword')}}" class="form-control" placeholder="Confirm Password">
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