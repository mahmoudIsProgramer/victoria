@extends('layouts.adminapp')
@section('content')

      <div id="main" class=main>
         <!--------------right panel---------------->
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-2"></div>
               <div class="col-lg-10">
                  <div class="right-panel">
                     <!--------------------------------------------------------------------------------------->
                     <!--bread crumb-->
                     <section class="all-schools my-5 py-5">
                        <div class="container">
                           <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                 <li class="breadcrumb-item" aria-current="page">
                                    {{ App\School::where('id',$school_id)->value('name')}}
                                 </li>
                                 <li class="breadcrumb-item " aria-current="page">
                                    {{ App\Level::where('id',$level_id)->value('name')}}
                                 </li>
                                 <li class="breadcrumb-item " aria-current="page">
                                    {{ App\Year::where('id',$year_id)->value('name')}}
                                 </li>
                                 <li class="breadcrumb-item active" aria-current="page">
                                    {{ App\Classe::where('id',$class_id)->value('name')}}
                                 </li>
                              </ol>
                           </nav>
                        </div>
                     </section>

                                @if ($errors->any())

                                       <ul>
                                           @foreach ($errors->all() as $error)
                                               <li>{{ $error }}</li>
                                           @endforeach
                                       </ul>

                                @endif 

                     <!--/bread crumb-->
                     <!---------------------------------------------------------------------------------->
                     <!--search attendance form-->
                     <section class="search-attendance ">
                        <div class="container">
                           <form action="{{url('/teacher/show/class/result')}}" method="get" class="form-row">
                              
                              <div class="col-6">
                                 <input type="hidden" name="school_id" value="{{$school_id}}">
                                 <input type="hidden" name="year_id" value="{{$year_id}}">
                                 <input type="hidden" name="level_id" value="{{$level_id}}">
                                 <input type="hidden" name="class_id" value="{{$class_id}}">
                                 <div class="form-group">
                                    <label for="exampleFormControlSelect1">Year</label>

                                    <select name="chooseyear" class="form-control">
                                       <option value="2019" <?php if(isset($chooseyear)){  if ($chooseyear == '2019') { echo "selected"; }  } ?> >2019</option>
                                       <option value="2020" <?php if(isset($chooseyear)){  if ($chooseyear == '2020') { echo "selected"; }  } ?> >2020</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group">
                                    <label for="exampleFormControlSelect1">Term</label>
                                    <select name="chooseterm" class="form-control" >
                                       <option value="">....</option>
                                       <option value="1" <?php if(isset($chooseterm)){  if ($chooseterm == '1') { echo "selected"; }  } ?>>1st Term</option>
                                       <option  value="2" <?php if(isset($chooseterm)){  if ($chooseterm == '2') { echo "selected"; }  } ?> >2nd Term</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="form-group text-center mt-4">
                                    <button type="submit" class="btn btn-warning">Show Class Result</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </section>
                     <!--/search attendance form-->
                     <!----------------------------------------------------------------------------------->
                     <!--attendance table-->
                  @if(isset($chooseterm))
                     <section class="all-attendance-show ">
                        <div class="container-fluid">


                           <table class="table table-bordered table-hover">
                              <thead>
                                 <tr>
                                    <th scope="col">ID</th>
                                    <th>Student Name</th>
                                    <th>Sitting Number</th>
                                    <th> {{App\Material::where('id' , $material_id)->value('name')}}</th>
                                 </tr>
                              </thead>
                              <tbody>

                                 <?php
                                    $allStudents = App\Student::where('class_id' , $class_id)->get();

                                 
                                 foreach($allStudents as $key => $student) {
                                 ?>
                                    <tr>
                                       <th scope="row">{{$key + 1}}</th>
                                       <td>{{$student->name}}</td>
                                       <td>{{$student->student_id_in_school}}</td>

                                       <?php
                                          $checkstudentdegree = App\Result::where('student_id' , $student->id)->where('term' ,$chooseterm)->where('year' , $chooseyear)->first();

                                       ?>
                                       @if($checkstudentdegree == null)
                                       <td>
                                          <form id="adddegree" action="{{url('/teacher/add/degree')}}" method="post" class="form-row">
                                             {{ csrf_field() }}
                                             <input type="hidden" name="material_id" value="{{$material_id}}">
                                             <input type="hidden" name="class_id" value="{{$class_id}}">
                                             <input type="hidden" name="student_id" value="{{$student->id}}">
                                             <input type="hidden" name="chooseterm" value="{{$chooseterm}}">
                                             <input type="hidden" name="chooseyear" value="{{$chooseyear}}">
                                             <div class="col-sm-3">
                                                <input name="result" type="text" placeholder="degree"class="form-control"/>
                                             </div>
                                             <span>/</span>
                                             <div class="col-sm-3">
                                                <input name="resultfrom" type="text" value="50"class="form-control"/>
                                             </div>
                                             <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                             </div>
                                          </form>
                                       </td>
                                       @else
                                       <td>
                                          <form id="editdegree" action="{{url('/teacher/edit/degree')}}" method="post" class="form-row">
                                             {{ csrf_field() }}
                                             <input type="hidden" name="material_id" value="{{$material_id}}">
                                             <input type="hidden" name="class_id" value="{{$class_id}}">
                                             <input type="hidden" name="student_id" value="{{$student->id}}">
                                             <input type="hidden" name="chooseterm" value="{{$chooseterm}}">
                                             <input type="hidden" name="chooseyear" value="{{$chooseyear}}">
                                             <div class="col-sm-3">
                                                <input name="result" type="text" placeholder="degree"class="form-control" value="{{$checkstudentdegree->result}}" />
                                             </div>
                                             <span>/</span>
                                             <div class="col-sm-3">
                                                <input name="resultfrom" type="text" value="50"class="form-control"/>
                                             </div>
                                             <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                             </div>
                                          </form>
                                       </td>

                                       @endif
                                    </tr>

                             <?php } ?>

                                   


                              </tbody>
                           </table>


                        </div>
                     </section>
               @endif      
                     <!--/attendance table-->
                     <!----------------------------------------------------------------------------------->
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection
