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
                      <h1 align="center"> MY SCHEDULES </h1>
                     </section>
                     <!--/bread crumb-->
                     <!----------------------------------------------------------------------------------->
                     <!--schedule table-->
                     <section class="all-attendance-show">
                        <div class="container-fluid">
                           <table class="table table-bordered table-hover">
                              <thead>
                                 <tr>
                                    <th scope="col">Day</th>
                                    <th>session1</th>
                                    <th>session2</th>
                                    <th>session3</th>
                                    <th>session4</th>
                                    <th>session5</th>
                                    <th>session6</th>
                                 </tr>
                              </thead>
                              <tbody>

                                <?php

                                  $teacher = auth()->guard('teacher')->user()->id;

                                  $getdays = App\Schedule::where('teacher_id' ,$teacher )->select('day')->distinct()->get();

                                  foreach($getdays as $day) {

                                    echo '<tr>';
                                      echo '<th>'. $day->day .'</th>';


                                      
                                    $getperiodsofday = App\Schedule::where('teacher_id' ,$teacher)->where('day' , $day->day)->select('period')->get();

                                    $arrayofperiodsofday = [];

                                    foreach($getperiodsofday as $period) {

                                      $arrayofperiodsofday[] = intval( $period->period);
                                      
                                      
                                    }

                                    

                                        ?>

                                        <td>
                                          <?php
                                          if(in_array(1, $arrayofperiodsofday)) {
                                            $getmaterialandteacher = App\Schedule::where('day' , $day->day)->where('period' , '1')->where('teacher_id' , $teacher)->select('teacher_id' , 'material_id','class_id')->first();

                                            $getteachername = App\Teacher::where('id' , $getmaterialandteacher->teacher_id)->select('username')->first();

                                            echo '<p>Teacher Name: '. $getteachername->username .'</p>';

                                            
                                            $getmaterialname =App\Material::where('id' ,$getmaterialandteacher->material_id)->select('name')->first();
                                            echo '<p>Matrial Name :' .$getmaterialname->name.'</p>';
                                            $getclassname = App\Classe::where('id' , $getmaterialandteacher->class_id)->select('name')->first();
                                            echo '<p>Class Name : ' .$getclassname->name.'</p>';
                                          }

                                          ?>
                                        </td>

                                        <td>
                                          <?php
                                          if(in_array(2, $arrayofperiodsofday)) {
                                            $getmaterialandteacher = App\Schedule::where('day' , $day->day)->where('period' , '2')->where('teacher_id' , $teacher)->select('teacher_id' , 'material_id','class_id')->first();

                                            $getteachername = App\Teacher::where('id' , $getmaterialandteacher->teacher_id)->select('username')->first();

                                            echo '<p>Teacher Name: '. $getteachername->username .'</p>';

                                            
                                            $getmaterialname =App\Material::where('id' ,$getmaterialandteacher->material_id)->select('name')->first();
                                            echo '<p>Matrial Name :' .$getmaterialname->name.'</p>';
                                            $getclassname = App\Classe::where('id' , $getmaterialandteacher->class_id)->select('name')->first();
                                            echo '<p>Class Name : ' .$getclassname->name.'</p>';
                                          }

                                          ?>
                                        </td>


                                        <td>
                                          <?php
                                          if(in_array(3, $arrayofperiodsofday)) {
                                            $getmaterialandteacher = App\Schedule::where('day' , $day->day)->where('period' , '3')->where('teacher_id' , $teacher)->select('teacher_id' , 'material_id','class_id')->first();

                                            $getteachername = App\Teacher::where('id' , $getmaterialandteacher->teacher_id)->select('username')->first();

                                            echo '<p>Teacher Name: '. $getteachername->username .'</p>';

                                            
                                            $getmaterialname =App\Material::where('id' ,$getmaterialandteacher->material_id)->select('name')->first();
                                            echo '<p>Matrial Name :' .$getmaterialname->name.'</p>';
                                            $getclassname = App\Classe::where('id' , $getmaterialandteacher->class_id)->select('name')->first();
                                            echo '<p>Class Name : ' .$getclassname->name.'</p>';
                                          }

                                          ?>
                                        </td>

                                        <td>
                                          <?php
                                          if(in_array(4, $arrayofperiodsofday)) {
                                            $getmaterialandteacher = App\Schedule::where('day' , $day->day)->where('period' , '4')->where('teacher_id' , $teacher)->select('teacher_id' , 'material_id','class_id')->first();

                                            $getteachername = App\Teacher::where('id' , $getmaterialandteacher->teacher_id)->select('username')->first();

                                            echo '<p>Teacher Name: '. $getteachername->username .'</p>';

                                            
                                            $getmaterialname =App\Material::where('id' ,$getmaterialandteacher->material_id)->select('name')->first();
                                            echo '<p>Matrial Name :' .$getmaterialname->name.'</p>';
                                            $getclassname = App\Classe::where('id' , $getmaterialandteacher->class_id)->select('name')->first();
                                            echo '<p>Class Name : ' .$getclassname->name.'</p>';
                                          }

                                          ?>
                                        </td>

                                        <td>
                                          <?php
                                          if(in_array(5, $arrayofperiodsofday)) {
                                            $getmaterialandteacher = App\Schedule::where('day' , $day->day)->where('period' , '5')->where('teacher_id' , $teacher)->select('teacher_id' , 'material_id','class_id')->first();

                                            $getteachername = App\Teacher::where('id' , $getmaterialandteacher->teacher_id)->select('username')->first();

                                            echo '<p>Teacher Name: '. $getteachername->username .'</p>';

                                            
                                            $getmaterialname =App\Material::where('id' ,$getmaterialandteacher->material_id)->select('name')->first();
                                            echo '<p>Matrial Name :' .$getmaterialname->name.'</p>';
                                            $getclassname = App\Classe::where('id' , $getmaterialandteacher->class_id)->select('name')->first();
                                            echo '<p>Class Name : ' .$getclassname->name.'</p>';
                                          }

                                          ?>
                                        </td>

                                        <td>
                                          <?php
                                          if(in_array(6, $arrayofperiodsofday)) {
                                            $getmaterialandteacher = App\Schedule::where('day' , $day->day)->where('period' , '6')->where('teacher_id' , $teacher)->select('teacher_id' , 'material_id','class_id')->first();

                                            $getteachername = App\Teacher::where('id' , $getmaterialandteacher->teacher_id)->select('username')->first();

                                            echo '<p>Teacher Name: '. $getteachername->username .'</p>';

                                            
                                            $getmaterialname =App\Material::where('id' ,$getmaterialandteacher->material_id)->select('name')->first();
                                            echo '<p>Matrial Name :' .$getmaterialname->name.'</p>';
                                            $getclassname = App\Classe::where('id' , $getmaterialandteacher->class_id)->select('name')->first();
                                            echo '<p>Class Name : ' .$getclassname->name.'</p>';
                                          }

                                          ?>
                                        </td>
                                                                                                                                                            
                                     </tr>

                                <?php

                                  }

                                ?>

                              </tbody>
                           </table>
                           
                        </div>
                     </section>
                     <!--/schedule table-->
                     <!----------------------------------------------------------------------------------->
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>

@endsection 


