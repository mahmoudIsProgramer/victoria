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
                                 <li class="breadcrumb-item" aria-current="page">{{ App\School::where('id',$school_id)->value('name')}}</li>
                                  <li class="breadcrumb-item " aria-current="page">
                                    {{ App\Level::where('id',$level_id)->value('name')}}
                                  </li>
                                  <li class="breadcrumb-item " aria-current="page">
                                    {{ App\Year::where('id',$year_id)->value('name')}}
                                  </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ App\Classe::where('id',$class_id)->value('name')}}</li>
                              </ol>
                           </nav>
                        </div>
                     </section>
                     <!--/bread crumb-->
                     
                        <!---------------------------------------------------------------------------------->
                        <!--search attendance form-->
                        <section class="search-attendance ">
                            <div class="container">
                              
                                <form id="theform" class="form-row" action="{{url('/teacher/all/attendance')}}" method="get">
                                  <input type="hidden" name="school_id" value="{{$school_id}}">
                                  <input type="hidden" name="level_id" value="{{$level_id}}">
                                  <input type="hidden" name="year_id" value="{{$year_id}}">
                                  <input type="hidden" name="class_id" value="{{$class_id}}">
                                  <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Year</label>
                                        <select name="years" class="form-control">
                                          <option>2019</option>
                                          <option>2020</option>
                                        </select>
                                      </div>
                                  </div>
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Month</label>
                                        <select name="months" class="form-control" >
                                          <option value="">...</option>
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                          <option>6</option>
                                          <option>7</option>
                                          <option>8</option>
                                          <option>9</option>
                                          <option>10</option>
                                          <option>11</option>
                                          <option>12</option>
                                        </select>
                                      </div>
                                  </div>
                                    <div class="col-12">
                                        <div class="form-group text-center mt-4">
                                            <button type="submit" class="btn btn-warning">Show Attendance</button>
                                        </div>
                                    </div>
                                </form>
                                @if ($errors->any())

                                       <ul>
                                           @foreach ($errors->all() as $error)
                                               <li>{{ $error }}</li>
                                           @endforeach
                                       </ul>

                                @endif 

                            </div>
                        </section>
                        <!--/search attendance form-->
                        <!----------------------------------------------------------------------------------->
                        <!--attendance table-->
                        <section class="all-attendance-show ">
                            <div class="container-fluid">
                    <table class="table table-bordered table-hover">
                        <thead>
                          <tr>

                            

                          <?php 

                              if(isset($getallattendance)) {

                                if(count($getallattendance) > 0) {

                                echo  '<th>Student Name</th>' ;

                                  
                                $daysfromDB = [];
                                foreach($getallattendance as $days) {

                                  $daysfromDB[] = $days->days;
                                }


                                  $unique_days = array_unique($daysfromDB);

                                  $new_key_unique_days = array_values($unique_days);


                                  
                                } else {

                                  echo 'No Results Found';
                                }

                              } 

                              if(isset($unique_days)) {
                                 for ($i=0; $i < count($new_key_unique_days) ; $i++) { 
                                  echo "<th> day ".$new_key_unique_days[$i]."</th>";

                                }                               
                              }

                          ?> 

                          </tr>
                        </thead>
                        

                        
                        <tbody>
            
                        
                          <?php
                              if(isset($unique_days)) {

                                 for ($ii=0; $ii < count($new_key_unique_days) ; $ii++) { 
                                   $getstudent = App\Attendance::where('class_id' , $class_id)->where('days' ,$new_key_unique_days[$ii])->get(); 
                                   $students = [];



                                     foreach($getstudent as $student) {
                                                                  
                                       $students[] = $student->student_id;                                   
                                     }
                                  }
                                  $unique_students = array_unique($students);

                                  $new_key_unique_students = array_values($unique_students);

                                  for ($i=0; $i < count($new_key_unique_students) ; $i++) { 
                                    echo '<tr>';

                                    $getstudentsname = App\Student::where('id' ,$new_key_unique_students[$i])->select('username')->first();


                                    echo "<td>".$getstudentsname->username."</td>"; 

                                    for ($iii=0; $iii < count($new_key_unique_days) ; $iii++) { 

                                   $getabsents = App\Attendance::where('student_id' ,$new_key_unique_students[$i])->where('days' , $new_key_unique_days[$iii])->select('absent')->first();

                                    if($getabsents->absent == '1') {

                                     echo "<td><i class='fas fa-check-square'></i></td>"; 

                                    } else {

                                     echo "<td> <i class='fas fa-window-close'></i> </td>"; 

                                    }

                                      
                                    }
                                     


                                    echo '</tr>';

                                  }


                                   

                              } // End if isset

                          ?>    
                            
                            <!-- <td>absent days 1</td> -->
                            
                        


                 
                        </tbody>
                       
                      </table>
                            </div>
                        </section>
                        <!--/attendance table-->
                        <!----------------------------------------------------------------------------------->
                    </div>
                </div>
            </div>
        </div>
      </div>
      </div>
      <!--end side bar-->
@endsection



