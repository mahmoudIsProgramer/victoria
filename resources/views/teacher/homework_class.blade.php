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
                     <section class="all-schools my-5 pt-5">
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
                     <!--home work-->
                     <div class="files-material ml-5">
                        <div class="row">
                           <div class="col-12">
                              <div class="file-upload m-auto">
                                    <h5>@if(session('messageHomework') != null)
                                      {{session('messageHomework')}}
                                      @endif
                                    </h5>
                                 <form action="{{url('/teacher/add/homework')}}" method="post" enctype="multipart/form-data">


                                        <input type="hidden" name="class_id" value="{{$class_id}}">                     {{ csrf_field() }}                     
                                    <div class="custom-file">
                                       <input name="homework" type="file" class="custom-file-input" id="customFile">
                                       <label class="custom-file-label" for="customFile"><i class="fa fa-folder-plus"></i>Add Home Work</label>
                                       <div class="form-group text-center">
                                          <button type="submit" class="btn btn-warning ">ADD</button>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
              <?php

                  $gethomeworkdetails = App\HomeWork::where('class_id' , $class_id)->where('teacher_id' , $teacher_id)->get();

              ?> 

              @foreach($gethomeworkdetails as $homework)
                           <div class="col-md-3 col-sm-6">
                              <div class="file">
                                 <div class="text-right">
                                    <span class="float-left pl-5">{{$homework->file_name}}</span>

                                     
                                       <a href="{{url('/teacher/delete/homework/'.$homework->id)}}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-minus mr-5"></i></a>

                                 </div>
                                 <a href="{{asset('images/'.$homework->image)}}">
                                    <img class="img-fluid" src="{{asset('images/'.$homework->image)}}"/>
                                    <div class="text-center">
                                 <a href="hw-answer.html" > <button class="btn btn-primary">Student answers</button></a>
                                 </div>
                                 </a>
                              </div>
                           </div>

              @endforeach          

                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
      <!--end side bar-->
@endsection

<!-- @section('script')
<script>
   
   $(document).ready(function() {

     $(document).on('click' , '.fa-minus' ,function() {


     });

   });


</script>

@endsection -->
