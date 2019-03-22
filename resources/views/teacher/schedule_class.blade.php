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
                                    $getdays = App\Schedule::where('class_id' , $class_id)->distinct()->select('day')->get();

                                                                     
                                 foreach($getdays as $day) {
                                 ?>
                                 <tr>
                                    <th>
                                       {{$day->day}}
                                    </th>
                                    
                                 <?php  
                                    $getmaterialteacher = App\Schedule::where('class_id' , $class_id)->where('day' , $day->day)->select('teacher_id' , 'material_id')->get();

                                 
                                 foreach($getmaterialteacher as $getdata) {

                                    echo '<td>';
                                    $getmaterialname = App\Material::where('id' , $getdata->material_id)->select('name')->first();
                                    echo '<p>' . $getmaterialname->name . '</p>';
                                    $getteachername = App\Teacher::where('id' , $getdata->teacher_id)->select('name')->first();
                                    echo '<p>' . $getteachername->name . '</p>';
                                    echo '</td>';
                                 }
                                 ?>
                                    

                                    
                                 </tr>
                           <?php } ?>
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
