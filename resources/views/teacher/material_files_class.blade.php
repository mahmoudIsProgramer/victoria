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
                      <!--material-->
                      <!--tabs-->
                      <h2 align="center">Upload Material</h2>
            <div class="material-tab">
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-file-tab" data-toggle="pill" href="#pills-file" role="tab" aria-controls="pills-file" aria-selected="true">Files</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-video-tab" data-toggle="pill" href="#pills-video" role="tab" aria-controls="pills-video" aria-selected="false">Videos</a>
                  </li>
              </ul>
            </div>
            <!--tabs content-->
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-file" role="tabpanel" aria-labelledby="pills-file-tab">
                  <div class="files-material ml-5">
                    <div class="row">
                          <div class="col-12">
                                  <div class="file-upload m-auto">
                                    <h5>@if(session('messageS') != null)
                                      {{session('messageS')}}
                                      @endif
                                    </h5>
                                    <h5>@if(session('messageV') != null)
                                      {{session('messageV')}}
                                      @endif
                                    </h5>

                                      <form action="{{url('/teacher/add/file')}}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="class_id" value="{{$class_id}}">
                                        <div class="custom-file">
                                          <input name="uploadfile" type="file" class="custom-file-input" id="customFile">
                                          <label class="custom-file-label" for="customFile"><i class="fa fa-folder-plus"></i>Upload Material File</label>
                                          <div class="form-group text-center">
                                            <button type="submit" name="submit" class="btn btn-warning ">ADD</button>
                                          </div>
                                        </div>
                                                 
                                      </form>
                                                
                                  </div>
                              </div>
              <!-- Files -->
              <?php

                  $getfiledetails = App\MaterialFile::where('class_id' , $class_id)->where('teacher_id' , $teacher_id)->where('type' , 'file')->get();

              ?>
              @foreach($getfiledetails as $file)
                        <div class="col-md-3 col-sm-6">
                            <div class="file">
                                <div class="text-right">

                                  <a href="{{url('/teacher/delete/materialfile/'.$file->id)}}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-minus mr-5"></i></a>

                                </div>
                                <a href="#">
                                    <img class="img-fluid" src="{{asset('images/'.$file->image)}}"/>
                                    <p class="text-center">{{$file->file_name}}</p>
                                </a>
                            </div>
                        </div>
              @endforeach          
                      
                      
                    </div>
                  </div>
              </div>
              <!--videos-->
              <div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
                 <div class="files-material ml-5">
                    <div class="row">
                          <div class="col-12">
                                  <div class="file-upload m-auto ">
                                    <form action="{{url('/teacher/add/video')}}" enctype="multipart/form-data" method="post">
                                      {{ csrf_field() }} 
                                        <input type="hidden" name="class_id" value="{{$class_id}}">                                           
                                                 <div class="custom-file">
                                                    <input name="url" type="text" class="form-control mt-5" placeholder="Upload Video URl">
                                                  </div>
                                                  <div class="form-group text-center">
                                                     <button type="submit" class="btn btn-warning my-5">ADD</button>
                                                  </div>
                                    </form>
                                                
                                  </div>
                          </div>

              <?php

                  $getvideodetails = App\MaterialFile::where('class_id' , $class_id)->where('teacher_id' , $teacher_id)->where('type' , 'video')->get();
              ?>
              @foreach($getvideodetails as $video)
                        <div class="col-md-3 col-sm-6">
                            <div class="file">
                                <div class="text-right">

                                  <a href="{{url('/teacher/delete/materialfile/'.$video->id)}}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-minus mr-5"></i></a>

                                </div>

                                <a href="{{$video->file_name}}">
                                    <p class="text-center">{{$video->file_name}}</p>
                                </a>
                            </div>
                        </div>
              @endforeach                      
                      
                    </div>
                  </div>
              </div>
            </div>
                                @if ($errors->any())

                                       <ul>
                                           @foreach ($errors->all() as $error)
                                               <li>{{ $error }}</li>
                                           @endforeach
                                       </ul>

                                @endif 

                      <!--/material-->
                     <!----------------------------------------------------------------------------------->
                    </div>
                </div>
            </div>
        </div>
      </div>
      </div>





@endsection
