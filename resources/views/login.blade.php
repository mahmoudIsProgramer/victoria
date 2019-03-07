@extends('layouts.adminapp')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-10">
            <div class="right-panel">
                <!--login-->
                <section class="member-login my-5 py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="main-victo mt-5 pt-5">
                            <i class="fa fa-user-alt"></i>
                            </div>
                        </div>
                        <div class="col-md-6 text-center login-sheet">
                            <h1 class="my-5">Member Login</h1>
                            <div class="form-row">
                            <form   method = 'POST'  action = "{{ url('user/login') }}" class="m-auto">
                                @include('partials.not_found')
                                @if ($errors->any()) 
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                {{ csrf_field() }}
                                <div class="col-12">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-envelope fa-lg"></i></div>
                                        </div>
                                        <input name = 'username' type="text" required autofocus value = "{{  old('username')}}" class="form-control" placeholder="User Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-unlock fa-lg"></i></div>
                                        </div>
                                        <input  name = 'password' type="password" required autofocus class="form-control" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-2">
                                        <select name = 'usertype' required autofocus class="form-control" >
                                        <option value = ''>User Type</option>
                                        {{-- <option value = 'teacher' {{(old('usertype') =='teacher')?'selected':''}} >Teacher</option>
                                        <option value = 'student' {{(old('usertype') =='student')?'selected':''}}>Student</option> --}}
                                        <option value = 'admin'   {{(old('usertype') =='admin')?'selected':''}}>Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-2">
                                        <select name = 'school_id' required autofocus class="form-control" >
                                        <option value = '' >Select School</option>
                                        <option value = '1' {{(old('school_id') =='1')?'selected':''}}>American</option>
                                        {{-- <option value = '2'>Test1</option>
                                        <option value = '3'>Test2</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-5">
                                        <button type="submit" class="btn btn-warning btn-block py-3"> Login</button>
                                        <a href="#" class="ml-5"><span>Forget Username / Password?</span></a>
                                    </div>
                                </div>
                            </form>
                            {{-- end form  --}}
                            </div>
                        </div>
                    </div>
                </div>
                </section>
                <!--/login-->
            </div>
        </div>
    </div>
</div>
@endsection