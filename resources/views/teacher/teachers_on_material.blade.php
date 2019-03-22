@extends('layouts.adminapp')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-10">
            <div class="right-panel">
                <!--bread crumb-->
                <section class="all-schools my-5 py-5">
                <div class="container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                                <li class="breadcrumb-item " aria-current="page">
                                        {{ App\School::where('id',$school_id)->value('name')}}
                                </li>
                                <li class="breadcrumb-item " aria-current="page">
                                        {{ App\Level::where('id' , $level_id)->value('name')}}
                                </li> 
                                <li class="breadcrumb-item" aria-current="page">
                                            {{ App\Year::where('id',$year_id)->value('name')}}  
                                </li> 
                                <li class="breadcrumb-item active" aria-current="page">
                                        {{ App\Material::where('id' , $material_id)->value('name')}}
                                </li>

                            {{-- <li class="breadcrumb-item" aria-current="page">American</li>
                            <li class="breadcrumb-item " aria-current="page">Play</li>
                            <li class="breadcrumb-item " aria-current="page">1st</li> --}}
                        </ol>
                    </nav>
                </div>
                </section>
                <!--/bread crumb-->
                <!--------------------------------------------------------------------------------------->
                <!--students details-->
                <div class="students-details">
                <div class="container">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Teachers</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Adress</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Class/Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($teachers)
                                @foreach ( $teachers as $index => $teacher  )
                                <tr>
                                    <th scope="row"> {{ ++$index }}</th>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->phone }}</td>
                                    <td>{{ $teacher->address }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->username }}</td>
                                    <td>1/1</td>
                                </tr>
                                @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                </div>
                </div>
                <!--/students details-->
                <!--------------------------------------------------------------------------------------->
            </div>
        </div>
    </div>
</div>
@endsection