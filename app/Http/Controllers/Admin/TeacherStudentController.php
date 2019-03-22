<?php

namespace App\Http\Controllers\Admin;

use App\Year;
use App\Level;
use App\Classe;
use App\School;
use App\Student;
use App\Teacher;
use App\Material;
use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TeacherStudentController extends Controller
{
    public function schools(Request $request )
    {
        $school_id = request('school_id') ;
        $unknown   = request('unknown');        
        $school = School::where('id', $school_id )->first(); 

        return view('admin.teacher_student.schools' , compact([ 'school' , 'school_id' , 'unknown' ]));

    }

    public function levels(Request $request )
    {

            $school_id = request('school_id') ;
            $levels = Level::where('school_id', $school_id )->get(); 
            $unknown = request('unknown');                
            return view('admin.teacher_student.levels',compact([ 'levels' , 'school_id' , 'unknown' ]));
	}


    public function years(Request $request )
    {
            $school_id = request('school_id') ;
            $level_id  = request('level_id') ;
            $unknown = request('unknown');   
        
            $years = Year::where([
                'school_id' => $school_id ,
                'level_id'  => $level_id
            ])->get(); 

            return view('admin.teacher_student.years',compact(['years','school_id','level_id' , 'unknown']));

    }

    public function classes(Request $request) 
    {

            $school_id = request('school_id') ;
            $level_id  = request('level_id') ;
            $year_id    = request('year_id');

            $unknown = request('unknown');                


            $classes = Classe::where([
                'school_id' => $school_id ,
                'level_id'  => $level_id ,
                'year_id'   => $year_id

            ])->get();

            // if($unknown ==  'materialfiles' ) {
            //     return view('admin.material_files_class',compact(['school_id','level_id','year_id']));
            // }else{
            //     return view('admin.teacher_student.materials',compact(['materials','school_id','level_id','year_id','unknown']));
            // }


            return view('admin.teacher_student.classes',compact(['years','school_id','level_id','year_id' , 'classes' , 'unknown']));

	}


    public function allevents(Request $request) 
    {

        $school_id = request('school_id');
        $level_id  = request('level_id');
        $year_id    = request('year_id');
        $class_id    = request('class_id');

        $unknown = request('unknown');                

        if( $unknown == 'AllStudents' ) {

            $classe_id = request('class_id') ;
            $students = Student::where('class_id', $classe_id )->get(); 

            return view('admin.teacher_student.students_on_class',compact(['students','school_id','level_id','year_id' , 'classe_id' ]));

        } elseif($unknown == 'AddAttendance') {
            $getallstudents = Student::where('class_id' , $class_id)->get();

            return view('admin.teacher_student.attendance_details',compact([
                'years','school_id','level_id','year_id', 'class_id' , 'getallstudents'
                ]));

		} elseif($unknown == 'ViewAttendance')  {
            return view('admin.teacher_student.all_attendance',compact(['school_id','level_id','year_id', 'class_id' ]));
        } elseif($unknown == 'AllTeachers')  {
            return view('admin.teacher_student.teacher_on_material',compact(['school_id','level_id','year_id', 'class_id' ]));
        }elseif( $unknown =="schedule"){

            $year_id =  Classe::where('id' , $class_id)->value('year_id'); 
            $materials =  Material::where('year_id' , $year_id)->get(); 
            return view('admin.schedule' , compact(['materials' ,'class_id' ])) ;

        }elseif ($unknown == 'materialfiles') {

            return view('admin.material_files_class',compact(['school_id','level_id','year_id', 'class_id' ]));
            
        } 
        else {
            return 'error';
        }
	}

    public function allattendance(Request $request) { //action get



            $validator = \Validator::make($request->all() , [

                'years'  => 'required',
                'months'  => 'required',

            ]);

            if($validator->fails()) {

                return back()->withErrors($validator);
            }

            $class_id = request('class_id');

            $years =  $request->years;

            $months =  $request->months;

            $school_id = request('school_id') ;
            $level_id  = request('level_id') ;
            $year_id    = request('year_id');
            $class_id    = request('class_id');


              $getallattendance = Attendance::where('class_id' , $class_id)->where(['years' => $years , 'months' => $months])->select('student_id','absent','days')->get();



              return view('admin.teacher_student.all_attendance' , compact(['getallattendance' , 'class_id' , 'school_id' , 'level_id' , 'year_id' , 'class_id']));                 
    }


    public function addattendance(Request $request) { // POST

            $validator = \Validator::make($request->all() , [

                'students'  => 'nullable|array'

            ]);

            if($validator->fails()) {

                return back()->withErrors($validator);
            }
 
            $class_id = request('class_id');
            $allstudents =  Student::where('class_id' , $class_id)->select('id')->get();
            $students_id = request('students'); // array of student absent = 1  

            foreach($allstudents as $student) {

                if(in_array($student->id, $students_id)) {

                    $addattend = new Attendance;

                    $addattend->absent = '1';
                    $addattend->student_id = $student->id;
                    $addattend->class_id    = $request->class_id;
                    $addattend->years    = date("Y");
                    $addattend->months    =  date('m');
                    $addattend->days    = date('d');                    
                    $addattend->save();                    
                } else {

                    $addattend = new Attendance;

                    $addattend->absent = '0';
                    $addattend->student_id = $student->id;
                    $addattend->class_id    = $request->class_id;
                    $addattend->years    = date("Y");
                    $addattend->months    =  date('m');
                    $addattend->days    = date('d');                      
                    $addattend->save();                      
                }
            } // end foreach


            return redirect('admin/ViewAttendance/schools/1');


    }

    public function materials_for_materialfiles(Request $request )
    {
    
        $school_id  = request('school_id') ;
        $level_id   = request('level_id') ;
        $year_id    = request('year_id') ;
        $class_id    = request('class_id') ;

        $unknown = request('unknown');   

        $materials = Material::where([
            'school_id' => $school_id ,
            'level_id'  => $level_id , 
            'year_id'   => $year_id  
            ])->get(); 

            return view('admin.teacher_student.materials',compact(['materials','school_id','level_id','year_id','class_id','unknown' ]));
    }
    public function materials(Request $request )
    {

        $school_id  = request('school_id') ;
        $level_id   = request('level_id') ;
        $year_id    = request('year_id') ;
        $materials = Material::where([
            'school_id' => $school_id ,
            'level_id'  => $level_id ,
            'year_id'   => $year_id
            ])->get();

        return view('admin.teacher_student.materials',compact(['materials','school_id','level_id','year_id']));
    }

    public function teachers_on_material(Request $request )
    {
    

        $school_id = request('school_id') ;
        $level_id   = request('level_id') ;
        $year_id = request('year_id') ;
        $material_id = request('material_id') ;
        // $teachers = Teacher::where('material_id', $material_id )->get(); 

        $teachers_ids = DB::table('teacher_material')->where('material_id',$material_id)->pluck('teacher_id') ; 
        $teachers = Teacher::whereIn('id',$teachers_ids)->get() ; 
        return view('admin.teacher_student.teachers_on_material',compact(['teachers','school_id','level_id','year_id' , 'material_id' ]));

    } // end func



}
