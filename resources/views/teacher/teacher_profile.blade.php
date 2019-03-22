@extends('layouts.adminapp')
@section('content')
      <div id="main" class=main>
         <!--------------right panel---------------->
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-2"></div>
               <div class="col-lg-10">
                  <div class="right-panel">
                     <div class="member-login">
                        <div class="container">
                           <div class="row ">
                              <div class=" col-md-8 m-auto">
                                 <div class="teacher-profile login-sheet my-5 py-5">
                                    <div class="form-row">
                                       <div class="col-9 m-auto">
                                          <div class="teacher-image mb-2">
                                             <img class="img-fluid" src="{{asset('images/'.auth()->guard('teacher')->user()->image)}}"/>
                                          </div>
                                       </div>
                                       <div class="col-12">
                                          <div class="input-group mb-2">
                                             <select disabled="disabled" class="form-control">

                @if(isset($allschools))
                                @foreach($allschools as $school)
                                    <option value= "{{$school->id}}" <?php if ($school->id == auth()->guard('teacher')->user()->school_id){ echo "selected";} ?> >{{$school->name}}</option>
                                @endforeach                    

                @endif
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-12">
                                          <div class="input-group mb-2">
                                             <input type="text" class="form-control" placeholder="{{auth()->guard('teacher')->user()->name}}" disabled="disabled">
                                          </div>
                                       </div>
                                       <div class="col-12">
                                          <div class="input-group mb-2">
                                             <input disabled type="text" class="form-control" placeholder="{{auth()->guard('teacher')->user()->phone}}">
                                          </div>
                                       </div>
                                       <div class="col-12">
                                          <div class="input-group mb-2">
                                             <input disabled type="text" class="form-control" placeholder="{{auth()->guard('teacher')->user()->address}}">
                                          </div>
                                       </div>
                                       <div class="col-12">
                                          <div class="input-group mb-2">
                                             <input disabled type="mail" class="form-control" placeholder="{{auth()->guard('teacher')->user()->email}}">
                                          </div>
                                       </div>
                                       <div class="col-12">
                                          <div class="input-group mb-2">
                                             <input disabled type="text" class="form-control" placeholder="{{auth()->guard('teacher')->user()->username}}">
                                          </div>
                                       </div>

                                       <div class="col-12">
                                          <div class="input-group mb-2">
                                             <table border="2">
                                                <tr>
                                                   <th>Grades</th>
                                                   <th>Classes</th>
                                                </tr>

                                                @foreach($unique_year_ids as $grade)

                                                <tr>
                                                   <td> {{App\Year::where('id' , $grade)->value('name')}} </td>
                                                  <td>

                                               <?php
                                                $getClasses = App\Classe::where('year_id' ,$grade)->get();

                                                foreach($getClasses as $class) {

                                                   $getClassesTeacher = App\TeacherClass::where('class_id' , $class->id)->get();

                                                   foreach($getClassesTeacher as $class) {
                                                  $getclassname = App\Classe::where('id' , $class->class_id)->first();
                                                  echo   '<p>' .$getclassname->name. '</p>';

                                                   }


                                                }
                                                  echo '</td>';    

                                                ?>
                                                      
                                                </tr>
                                                @endforeach
                                             </table>
                                          </div>
                                       </div>

                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection
