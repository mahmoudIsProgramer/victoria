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
                                        {{ App\Classe::where('id' , $classe_id)->value('name')}}
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
                            <th>Student</th>
                            <th>Student ID</th>
                            <th>Mobile</th>
                            <th>Adress</th>
                            <th>Email</th>
                            <th>User Name</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if($students)
                            @foreach ( $students as $index => $student  )
                            <tr>
                                <th scope="row">{{ ++$index}}</th>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->student_id_in_school }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->address }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->username }}</td>
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