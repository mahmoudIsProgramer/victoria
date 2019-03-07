<?php

namespace App\Http\Controllers\Admin;

use App\Year;
use App\Level;
use App\Classe;
use App\School;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    //
    // get school years belong to admin (shcools page)
    public function schools(Request $request )
    {
        $school_id = request('school_id') ;
        $school = School::where('id', $school_id )->first(); 
        // $school = School::where('school_id',auth()->user()->school_id)->first(); 
        return view('admin.student.schools',compact([ 'school' , 'school_id' ]));
    } // end func
    
    // get school years belong to admin (shcools page)
    public function levels(Request $request )
    {
        $school_id = request('school_id') ;
        $levels = Level::where('school_id', $school_id )->get(); 
        return view('admin.student.levels',compact([ 'levels' , 'school_id' ]));
    } // end func

    // get school years belong to admin (shcools page)
    public function years(Request $request )
    {
        $school_id = request('school_id') ;
        $level_id  = request('level_id') ;
        $years = Year::where([
            'school_id'=> $school_id ,
            'level_id' => $level_id
        ])->get(); 
        // $school = School::where('school_id',auth()->user()->school_id)->first(); 
        return view('admin.student.years',compact(['years','school_id','level_id']));
    } // end func
    
    // get get classes of one year 
    public function classes(Request $request )
    {
    
        $school_id  = request('school_id') ;
        $level_id   = request('level_id') ;
        $year_id    = request('year_id') ;
        $classes = Classe::where([
            'school_id' => $school_id ,
            'level_id'  => $level_id , 
            'year_id'   => $year_id  
            ])->get(); 

        return view('admin.student.classes',compact(['classes','school_id','level_id','year_id']));
    } // end func

    // get all students in one  classes  
    public function students_on_class(Request $request )
    {
    
        $school_id = request('school_id') ;
        $level_id   = request('level_id') ;
        $year_id = request('year_id') ;
        $classe_id = request('classe_id') ;
        $students = Student::where('class_id', $classe_id )->get(); 
        
        return view('admin.student.students_on_class',compact(['students','school_id','level_id','year_id' , 'classe_id' ]));
    } // end func
}
