<?php

namespace App\Http\Controllers\Admin;

use App\Classe;
use App\Teacher;
use App\Material;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    //
    public function scheduleView() {
        
        $class_id  = request('class_id'); 
        $year_id =  Classe::where('id' , $class_id)->value('year_id'); 
        $materials =  Material::where('year_id' , $year_id)->get(); 
        return view('admin.schedule' , compact(['materials' ,'class_id' ])) ; 

    }
    public function set_schedule( Request $request ) {

        $i = 0 ; 
        $days = request('days') ; 
        $periods = request('periods') ; 
        $teachers = request('teachers') ; 
        $materials = request('materials') ; 

        foreach ( $materials  as $material ){
            if($material == null ){
                $i++ ; 
                continue ; 
            }
            Schedule::create([
                'day'=> $days[$i] ,
                'period'=> $periods[$i],
                'teacher_id'=>$teachers[$i],
                'material_id'=> $materials[$i],
                'class_id'=> request('class_id'),
            ]); 
            $i++ ; 
        }
        return redirect()->back(); 
    }
    
    public function teachers_on_material( Request $request) {
                
        $options = '' ; 
        $teacher_ids = DB::table('teacher_material')->where('material_id',request('material_id'))->pluck('teacher_id')->toArray(); 
        $teachers  = Teacher::whereIn('id',$teacher_ids)->get()   ;  
        foreach ( $teachers as $teacher ){
            $options.= "<option value='$teacher->id' >" . $teacher->name .  '</option>';
        }
        return response()->json(['options'=>$options]);
        
    }
}
