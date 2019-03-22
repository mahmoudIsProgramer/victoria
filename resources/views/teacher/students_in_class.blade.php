@extends('layouts.adminapp')
@section('content')
      <!-------------------------------------------------------------------------------------------------------->
      <!--start side bar-->
      <div id="mySidebar" class="sidebar ">
         <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" >×</a>
         <a href="#">test </a>
         <a href="#"></a>
      </div>
      <div id="main" class=main>
         <div class="header container-fluid fixed-top shadow">
            <div class=row>
               <div class=" col-sm-6 fl-small">
                  <button class="openbtn" onclick="openNav();">☰ </button>  
                  <img src="imgs/logo-sm.png"/>
               </div>
               <div class=" col-sm-3"> </div>
               <div class=" col-sm-3">
                  <div class="pt-2 fr-small">
                     <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle btn-login" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        admin name
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           <a class="dropdown-item" href="#">Logout</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--------------right panel---------------->
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
                                 <li class="breadcrumb-item" aria-current="page"> {{ App\School::where('id',$school_id)->value('name')}}</li>
                                  <li class="breadcrumb-item " aria-current="page">{{ App\Level::where('id',$level_id)->value('name')}}</li>
                                  <li class="breadcrumb-item active" aria-current="page">{{ App\Year::where('id',$year_id)->value('name')}}</li>
                                  <li class="breadcrumb-item active" aria-current="page">{{ App\Classe::where('id',$class_id)->value('name')}}</li>

                              </ol>
                           </nav>
                        </div>
                     </section>
                     <!--/bread crumb-->
                     <!--------------------------------------------------------------------------------------->
                     <!--schools-->
                     <section class="schools">
                        <div class="container">
                            <div class="row">

                        @if($getallteachers)
                          @foreach($getallteachers as $getteacher)

                           
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="school">
                                     <input type="checkbox" name="choose">
                                     <h3 class="btn-warning text-center py-5">{{ $teacher_name = App\Teacher::where('id' , $getteacher->teacher_id)->value('username')}}</h3>
                                    </div>
                                </div>
                          @endforeach 
                          @endif     
                            </div>
                        </div>
                     </section>
                     <!--/schools-->
                     <!--------------------------------------------------------------------------------------->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--end side bar-->
@endsection
