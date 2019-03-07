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
                                <li class="breadcrumb-item active" aria-current="page"> {{ App\School::where('id',$school_id)->value('name')}} </li>
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
                        @if($levels)
                        @foreach ( $levels as $level  )
                        <div class = "col-md-4 col-sm-6 mb-2">
                            <div class="school">
                            <a href="{{ url('admin/teacher/years').'/'.$school_id.'/'.$level->id }}">
                                <h3 class="btn-warning text-center py-5"> {{ $level->name }}</h3>
                            </a>
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