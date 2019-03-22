@extends('layouts.adminapp')
@section('content')





         <!--------------right panel---------------->
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-2"></div>
               <div class="col-lg-10">
                  <div class="right-panel">
                     <!--bread crumb-->
                     <section class="all-schools mt-5 py-5">
                        <div class="container">
                           <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                 <li class="breadcrumb-item" aria-current="page">American</li>
                                 <li class="breadcrumb-item " aria-current="page">Grades</li>
                                 <li class="breadcrumb-item " aria-current="page">Grade 1</li>
                                 <li class="breadcrumb-item active" aria-current="page">Class A</li>
                              </ol>
                           </nav>
                        </div>
                     </section>
                     <!--/bread crumb-->
                     <!--------------------------------------------------------------------------------------->
                     <!--attendance view-->




                     <section class="attendance-view mb-4">
                        <div class="container">
                           <a href="{{url('/teacher/ViewAttendance/action/in/class').'/'.$school_id.'/'.$level_id.'/'.$year_id .'/'.$class_id }}"><button class="btn btn-warning px-4">View Attendance</button></a>
                           <p>Last Day : {{App\Attendance::orderBy('id' , 'Desc')->where('class_id' , $class_id)->value('created_at')}}</p>
                        </div>
                     </section>
                     <!--attendance view-->
                     <!----------------------------------------------------------------------------------------->
                     <section class="student-attendance">
                        
                        <form class=" text-center" method="post" action="{{url('/teacher/add/attendance')}}">
                        	{{ csrf_field() }}
                        	<input type="hidden" name="class_id" value="{{$class_id}}">
                        	@foreach($getallstudents as $student)
                           <div class="form-check custom-control custom-checkbox">
                              <input class="form-check-input custom-control-input" type="checkbox" name="students[]" value="{{$student->id}}" id="defaultCheck{{$student->id}}">
                              <label class="form-check-label custom-control-label" for="defaultCheck{{$student->id}}">
                              {{$student->username}}
                              </label>
                           </div>
                           @endforeach

                           <div class="text-center my-4">
                              <button type="submit" class="btn btn-warning px-4">Set Attendance</button>
                           </div>
                        </form>
                     </section>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
      <!--end side bar-->


@endsection