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
                                <li class="breadcrumb-item active" aria-current="page">
                                            {{ App\Year::where('id',$year_id)->value('name')}}  
                                </li> 

                            {{--  <li class="breadcrumb-item active" aria-current="page">{{ App\Year::where('id',$year_id)->value('name')}}    {{$year_id}}</li>
                            <li class="breadcrumb-item active" aria-current="page">Grade 1</li>   --}}
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
                        @if($classes)
                        @foreach ( $classes as $classe  )
                        <div class="col-md-4 col-sm-6 mb-2">
                            <div class="school">
                                @if( $unknown == "materialfiles" )

                                <a href="{{url('/admin/'.$unknown.'/materials').'/'.$school_id.'/'.$level_id.'/'.$year_id.'/'.$classe->id}}">
                                    <h3 class="btn-warning text-center py-5">{{   $classe->name }}</h3>
                                </a> 
                                
                                @else

                                <a href="{{url('/admin/'.$unknown.'/action/in/class').'/'.$school_id.'/'.$level_id.'/'.$year_id.'/'.$classe->id}}">
                                    <h3 class="btn-warning text-center py-5">{{ $classe->name }}</h3>
                                </a>

                                @endif 
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
@endsection