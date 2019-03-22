@extends('layouts.adminapp')
@section('content')
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
                            <li class="breadcrumb-item" aria-current="page">American</li>
                            <li class="breadcrumb-item " aria-current="page">Grades</li>
                            <li class="breadcrumb-item " aria-current="page">Grade 1</li>
                            <li class="breadcrumb-item active" aria-current="page">Class A</li>
                        </ol>
                    </nav>
                    </div>
                </section>
                <!--/bread crumb-->
                <!----------------------------------------------------------------------------------->
                <!--schedule table-->
                
                @php 
                    $sessions = [1,2,3,4,5,6];
                    $days = ['Saturday', 'Sunday', 'Monday' , 'Tuesday' ,'Wednesday' , 'Thursday' ] ;  
                @endphp 

                <form action="{{url('admin/set_schedule')}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="class_id" value="{{$class_id}}">
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
                                <!-- start  row-->
                                @foreach ($days  as $day )
                                <tr>
                                    <th scope="row">{{ $day }}</th>
                                    @foreach ( $sessions as $session )
                                    <td>
                                        
                                        @if( $session_exists = \App\Schedule::where(['class_id'=> $class_id,'period'  => $session ,'day' => $day ])->first() ) 
                                            
                                            <p>
                                                {{ 
                                                    $material_name = App\Material::where(
                                                    'id', $session_exists->material_id
                                                    )->value('name')
                                                }}
                                            </p>

                                            <p>
                                                {{ 
                                                $teacher_name = App\Teacher::where(
                                                    'id',$session_exists->teacher_id
                                                    )->value('name')
                                                }}
                                            </p>
                                            
                                        @else
                                                
                                            <select class="form-control materials" name = 'materials[]'   >
                                                <option value = ''>Material</option>
                                                @foreach ( $materials   as $material  )
                                                    <option value ='{{ $material->id }}' >{{ $material->name }}</option>
                                                @endforeach
                                            </select>

                                        
                                            <select class="form-control asd" name = 'teachers[]'   >
                                                <option value = '' >Teacher</option>
                                            </select>

                                            <input type="hidden" name="days[]"    value   = "{{ $day }}" >
                                            <input type="hidden" name="periods[]" value = "{{ $session }}">
                                        
                                        @endif
                                        

                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                                <!--/ end row-->

                            </tbody>
                        </table>
                        <div class="save-changes my-5 text-center">
                            <button type="submit" class="btn btn-warning px-5">Save</button>
                        </div>
                        </div>
                    </section>

                    
                </form>
                
                <!--/schedule table-->
                <!----------------------------------------------------------------------------------->
            </div>
        </div>
    </div>
</div>
@endsection 