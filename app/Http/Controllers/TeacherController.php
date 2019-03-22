<?php

namespace App\Http\Controllers;

use App\Year;
use App\Level;
use App\Classe;
use App\School;
use App\Teacher;
use App\Material;
use App\Student;
use App\Attendance;
use App\MaterialFile;
use App\HomeWork;
use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function home() {

      return view('teacher.teacherhome');
    }

    public function schools(Request $request )
    {
        $school_id = request('school_id') ;
        $unknown = request('unknown');        
        $school = School::where('id', $school_id )->first(); 
        // $school = School::where('school_id',auth()->user()->school_id)->first(); 
        return view('teacher.schools',compact([ 'school' , 'school_id' , 'unknown' ]));
    }

    public function levels(Request $request )
    {
        $getauthid = auth()->guard('teacher')->user()->id;
        $getauthuser = auth()->guard('teacher')->user()->type;

        if($getauthuser == '1') { // Private Teacher
            $school_id = request('school_id') ;
            $levels = Level::where('school_id', $school_id )->get(); 
            $unknown = request('unknown');                
            return view('teacher.levels',compact([ 'levels' , 'school_id' , 'unknown' ]));

        } else { // Normal Teacher
            $school_id = request('school_id') ;
// get  classes which teacher In
            $getclass_id = DB::table('teacher_class')->where('teacher_id' , $getauthid)->select('class_id')->get();


            foreach($getclass_id as $classid) {

                $level_id = Classe::where('id', $classid->class_id)->select('level_id')->first(); 
            }

            $levels = Level::where('id' , $level_id->level_id)->get();


            $unknown = request('unknown'); 

            return view('teacher.levels',compact([ 'levels' , 'school_id' , 'unknown' ]));
        }


    }

    public function years(Request $request )
    {

        $getauthid = auth()->guard('teacher')->user()->id;
        $getauthuser = auth()->guard('teacher')->user()->type;

        if($getauthuser == '1') { // Private Teacher

            $school_id = request('school_id') ;
            $level_id  = request('level_id') ;
            $years = Year::where([
                'school_id' => $school_id ,
                'level_id'  => $level_id
            ])->get(); 
            $unknown = request('unknown');                

            // $school = School::where('school_id',auth()->user()->school_id)->first(); 
            return view('teacher.years',compact(['years','school_id','level_id' , 'unknown']));
        } else {

            $school_id = request('school_id') ;
            $level_id  = request('level_id') ;


            $getclass_id = DB::table('teacher_class')->where('teacher_id' , $getauthid)->select('class_id')->get();


            $level_ids = [];
            foreach($getclass_id as $classid) {

                $level_idz = Classe::where('id', $classid->class_id)->select('year_id')->first();

                $level_ids[] = $level_idz->year_id;
            }
            $years = Year::whereIn('id' , $level_ids)->get(); 

            $unknown = request('unknown');                


            return view('teacher.years',compact(['years','school_id','level_id' , 'unknown']));


        }
    }

    public function classes(Request $request) 
    {

        $getauthid = auth()->guard('teacher')->user()->id;
        $getauthuser = auth()->guard('teacher')->user()->type;

        if($getauthuser == '1') { // Private Teacher

            $school_id = request('school_id') ;
            $level_id  = request('level_id') ;
            $year_id    = request('year_id');

            $classes = Classe::where([
                'school_id' => $school_id ,
                'level_id'  => $level_id ,
                'year_id'   => $year_id

            ])->get();
            $unknown = request('unknown');                

            return view('teacher.classes',compact(['years','school_id','level_id','year_id' , 'classes' , 'unknown']));
        } else {

            $school_id = request('school_id') ;
            $level_id  = request('level_id') ;
            $year_id    = request('year_id'); 
            $unknown = request('unknown');                

            $getclass_id = DB::table('teacher_class')->where('teacher_id' , $getauthid)->select('class_id')->get();


            $classes_ids = [];

            foreach($getclass_id as $classid) {

                $classes_ids[] = $classid->class_id;
            }

            $classes = Classe::where('school_id' , $school_id)->where('level_id' , $level_id)->where('year_id' , $year_id)->whereIn('id' , $classes_ids)->get();


            return view('teacher.classes',compact(['years','school_id','level_id','year_id' , 'classes' , 'unknown']));
       

        }

    }

    public function allevents(Request $request) {

        $school_id = request('school_id') ;
        $level_id  = request('level_id') ;
        $year_id    = request('year_id');
        $class_id    = request('class_id');
        $unknown = request('unknown');                

        if($unknown == 'StudentsInClass') {
            //not yet
            $getallteachers = DB::table('teacher_class')->where('class_id' , $class_id)->get();

            return view('teacher.students_in_class',compact(['years','school_id','level_id','year_id', 'class_id' , 'getallteachers']));

        } elseif($unknown == 'AddAttendance') {


            $getallstudents = Student::where('class_id' , $class_id)->get();


            return view('teacher.attendance_details',compact(['years','school_id','level_id','year_id', 'class_id' , 'getallstudents']));
            
        } elseif($unknown == 'ViewAttendance')  {


            return view('teacher.all_attendance',compact(['school_id','level_id','year_id', 'class_id' ]));
            
        } elseif ($unknown == 'scheduleclasse') {
            
            return view('teacher.schedule_class',compact(['school_id','level_id','year_id', 'class_id' ]));
        } elseif ($unknown == 'materialfiles') {

            $teacher_id = auth()->guard('teacher')->user()->id; 
            

            return view('teacher.material_files_class',compact(['school_id','level_id','year_id', 'class_id' , 'teacher_id' ]));


        } elseif ($unknown == 'homework') {

            $teacher_id = auth()->guard('teacher')->user()->id; 
            

            return view('teacher.homework_class',compact(['school_id','level_id','year_id', 'class_id' , 'teacher_id' ]));


        } elseif ($unknown == 'Result') {

            $teacher_id = auth()->guard('teacher')->user()->id; 

            $year_id = Classe::where('id', request('class_id') )->value('year_id');
            $materials_in_year =  Material::where('year_id',$year_id)->pluck('id')->toArray();


            $materials_for_teacher = DB::table('teacher_material')->where('teacher_id',auth()->guard('teacher')->user()->id)->pluck('material_id')->toArray();


            foreach($materials_for_teacher as $value) {

                if(in_array($value,$materials_in_year)) {

                    $material_id =  $value;
                }
            }
            return view('teacher.result_teacher_class',compact(['school_id','level_id','year_id', 'class_id' , 'teacher_id','material_id']));


        } else {

            return 'error';
        }

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


            return redirect('/teacher/home');


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



              return view('teacher.all_attendance' , compact(['getallattendance' , 'class_id' , 'school_id' , 'level_id' , 'year_id' , 'class_id']));                 
    }

    public function teacherprofile() {

        $allschools = School::all();
        $teacher_id = auth()->guard('teacher')->user()->id; 

        $teacherClasses = DB::table('teacher_class')->where('teacher_id' , $teacher_id)->get(['class_id']);

        $year_ids = [];
        foreach($teacherClasses as $classes) {

           $getGrades = Classe::where('id' , $classes->class_id)->first();
           $year_ids[] =  $getGrades->year_id;
        }

       $unique_year_ids =  array_unique($year_ids);

        return view('teacher.teacher_profile' , compact(['allschools' , 'teacherClasses' , 'unique_year_ids']));
    }



    public function materials(Request $request ) // commented
    {
    
        $school_id  = request('school_id') ;
        $level_id   = request('level_id') ;
        $year_id    = request('year_id') ;
        $materials = Material::where([
            'school_id' => $school_id ,
            'level_id'  => $level_id , 
            'year_id'   => $year_id  
            ])->get(); 

        return view('teacher.materials',compact(['materials','school_id','level_id','year_id']));
    }


    public function teachers_on_material(Request $request ) //commented
    {
    

        $school_id = request('school_id') ;
        $level_id   = request('level_id') ;
        $year_id = request('year_id') ;
        $material_id = request('material_id') ;
        // $teachers = Teacher::where('material_id', $material_id )->get(); 

        $teachers_ids = DB::table('teacher_material')->where('material_id',$material_id)->pluck('teacher_id') ; 
        $teachers = Teacher::whereIn('id',$teachers_ids)->get() ; 
        return view('teacher.teachers_on_material',compact(['teachers','school_id','level_id','year_id' , 'material_id' ]));

    }
    
    public function myschedules() {


        return view('teacher.schedule_teacher');

    }


    public function addfile(Request $request) {

           $validator = \Validator::make($request->all() , [

               'uploadfile' => 'image|mimes:jpeg,jpg,png,gif|required|max:30000'
           ]);

           if($validator->fails()) {

               return back()->withErrors($validator);
           }

           // class_id , teacher_id
           $year_id = Classe::where('id', request('class_id') )->value('year_id');
           $materials_in_year =  Material::where('year_id',$year_id)->pluck('id')->toArray();


           $materials_for_teacher = DB::table('teacher_material')->where('teacher_id',auth()->guard('teacher')->user()->id)->pluck('material_id')->toArray();

            foreach($materials_for_teacher as $value) {

                if(in_array($value,$materials_in_year)) {

                    $material_id =  $value;
                }
            }

               $teacherfile =  $request->uploadfile;

               $Image = '102030405060'.$teacherfile->getClientOriginalName();

                $filename =explode('.', $teacherfile->getClientOriginalName());

               $destinationPath = public_path('/images');

               $teacherfile->move( $destinationPath ,$Image );

                       $addfile = new MaterialFile;

                       $addfile->file_name = $filename[0];
                       $addfile->type = 'file';
                       $addfile->image = $Image;
                       $addfile->material_id    = $material_id;
                       $addfile->teacher_id    = auth()->guard('teacher')->user()->id;
                       $addfile->class_id    = $request->class_id;
                       $addfile->save();



               return back()->with(['messageS' => 'File Has Been Uploaded']);



       }



       public function addvideo(Request $request) {



           $validator = \Validator::make($request->all() , [

           'url' => 'url'

            ]);

           if($validator->fails()) {

               return back()->withErrors($validator);
           }



           $year_id = Classe::where('id', request('class_id') )->value('year_id');
           $materials_in_year =  Material::where('year_id',$year_id)->pluck('id')->toArray();


           $materials_for_teacher = DB::table('teacher_material')->where('teacher_id',auth()->guard('teacher')->user()->id)->pluck('material_id')->toArray();


            foreach($materials_for_teacher as $value) {

                if(in_array($value,$materials_in_year)) {

                    $material_id =  $value;
                }
            }


          
                       $addvideo = new MaterialFile;

                       $addvideo->file_name = $request->url;
                       $addvideo->type = 'video';
                       $addvideo->image = 'NULL';
                       $addvideo->material_id    = $material_id;
                       $addvideo->teacher_id    = auth()->guard('teacher')->user()->id;
                       $addvideo->class_id    = $request->class_id;
                       $addvideo->save();


                       return back()->with(['messageV' => 'Video Url Has Been Uploaded']);


       }


       public function addhomework(Request $request) {

           $validator = \Validator::make($request->all() , [

           'homework' => 'mimes:jpeg,jpg,png,gif|required|max:30000'

            ]);

           if($validator->fails()) {

               return back()->withErrors($validator);
           }

           $year_id = Classe::where('id', request('class_id') )->value('year_id');
           $materials_in_year =  Material::where('year_id',$year_id)->pluck('id')->toArray();

           $materials_for_teacher = DB::table('teacher_material')->where('teacher_id',auth()->guard('teacher')->user()->id)->pluck('material_id')->toArray();

            foreach($materials_for_teacher as $value) {

                if(in_array($value,$materials_in_year)) {

                    $material_id =  $value;
                }
            }

            $teacherfile =  $request->homework;

               $Image = '102030405060'.$teacherfile->getClientOriginalName();

                $filename =explode('.', $teacherfile->getClientOriginalName());

               $destinationPath = public_path('/images');

               $teacherfile->move( $destinationPath ,$Image );

           
                       $addhomework = new HomeWork;

                       $addhomework->image = $Image;
                       $addhomework->file_name = $filename[0];
                       $addhomework->material_id    = $material_id;
                       $addhomework->teacher_id    = auth()->guard('teacher')->user()->id;
                       $addhomework->class_id    = $request->class_id;
                       $addhomework->save();


                       return back()->with(['messageHomework' => 'HomeWork Has Been Uploaded']);

       }


       public function deletehomework(Request $request) {


            $gethomeworkid = request('id');
            $teacher_id = auth()->guard('teacher')->user()->id;

            $delete = HomeWork::where('id',$gethomeworkid)->where('teacher_id' , $teacher_id)->first();

            if($delete != null) {

                $delete->delete();
                return back();

            } else {

                return back();

            }

       }

       public function deletematerialfile(Request $request) {

            $getmaterialfileid = request('id');
            $teacher_id = auth()->guard('teacher')->user()->id;

            $delete = MaterialFile::where('id',$getmaterialfileid)->where('teacher_id' , $teacher_id)->first();

            if($delete != null) {

                $delete->delete();
                return back();

            } else {

                return back();

            }           

       }


       public function showclassresult(Request $request) { //get

           $validator = \Validator::make($request->all() , [

              'chooseterm' => 'required|in:1,2',
              'chooseyear' => 'required|in:2019,2020'

            ]);

           if($validator->fails()) {

               return back()->withErrors($validator);
           }

            $chooseterm = request('chooseterm');
            $chooseyear = request('chooseyear');
            $school_id = request('school_id');
            $level_id = request('level_id');
            $year_id = request('year_id');
            $class_id = request('class_id');


            $teacher_id = auth()->guard('teacher')->user()->id; 

            $year_id = Classe::where('id', request('class_id') )->value('year_id');
            $materials_in_year =  Material::where('year_id',$year_id)->pluck('id')->toArray();


            $materials_for_teacher = DB::table('teacher_material')->where('teacher_id',auth()->guard('teacher')->user()->id)->pluck('material_id')->toArray();


            foreach($materials_for_teacher as $value) {

                if(in_array($value,$materials_in_year)) {

                    $material_id =  $value;
                }
            }



                return view('teacher.result_teacher_class' , compact(['chooseterm','chooseyear','school_id' ,'level_id' ,'year_id' , 'class_id' , 'teacher_id' , 'material_id']));


       }

       public function adddegree(Request $request) {


          $resultfrom = request('resultfrom');

           $validator = \Validator::make($request->all() , [

              'result' => [function ($attribute, $value, $fail) use ($resultfrom) {
                  if ($value > $resultfrom) {
                    $fail(':Error Cant Add More Than '.$resultfrom .' Degree');
                  }
              }]
            ]);

           if($validator->fails()) {

               return back()->withErrors($validator);
           }

          $teacher_id = auth()->guard('teacher')->user()->id; // 6
          $material_id = request('material_id'); // 7
          $class_id = request('class_id'); // 4
          $student_id = request('student_id'); // 5

          $classDetails = Classe::where('id' , $class_id)->first();
          $school_id = $classDetails->school_id; // 1
          $level_id = $classDetails->level_id; // 2
          $year_id = $classDetails->year_id; // 3

          $term = request('chooseterm');

          $year = request('chooseyear');
          $result = request('result');
          $resultfrom = request('resultfrom');


          $adddegreetostudent = new Result;

          $adddegreetostudent->school_id = $school_id;
          $adddegreetostudent->level_id = $level_id;
          $adddegreetostudent->year_id = $year_id;
          $adddegreetostudent->class_id = $class_id;
          $adddegreetostudent->student_id = $student_id;
          $adddegreetostudent->teacher_id = $teacher_id;
          $adddegreetostudent->material_id = $material_id;
          $adddegreetostudent->term = $term;
          $adddegreetostudent->year = $year;
          $adddegreetostudent->result = $result;
          $adddegreetostudent->resultfrom = $resultfrom;

          $adddegreetostudent->save();


          return back();
          // return view('teacher.result_teacher_class' , compact(['chooseterm','chooseyear','school_id' ,'level_id' ,'year_id' , 'class_id' , 'teacher_id' , 'material_id']));

         
       }

       public function editdegree(Request $request) {


          $resultfrom = request('resultfrom');

           $validator = \Validator::make($request->all() , [

              'result' => [function ($attribute, $value, $fail) use ($resultfrom) {
                  if ($value > $resultfrom) {
                    $fail(':Error Cant Add More Than '.$resultfrom .' Degree');
                  }
              }]
            ]);

           if($validator->fails()) {

               return back()->withErrors($validator);
           }

          $teacher_id = auth()->guard('teacher')->user()->id; // 6
          $material_id = request('material_id'); // 7
          $class_id = request('class_id'); // 4
          $student_id = request('student_id'); // 5

          $classDetails = Classe::where('id' , $class_id)->first();
          $school_id = $classDetails->school_id; // 1
          $level_id = $classDetails->level_id; // 2
          $year_id = $classDetails->year_id; // 3

          $term = request('chooseterm');

          $year = request('chooseyear');
          $result = request('result');
          $resultfrom = request('resultfrom');


          $editstudentdegree = Result::where('student_id',$student_id)->where('term' , $term)->where('year' , $year)->update([  'school_id'    => $school_id ,
                'level_id'    => $level_id ,
                'year_id'     => $year_id ,
                'class_id'    => $class_id ,
                'teacher_id'  => $teacher_id ,
                'material_id' => $material_id ,
                'term'        => $term ,
                'year'        => $year ,
                'result'      => $result ,
                'resultfrom'  => $resultfrom

          ]);
          
          return back();

          // return view('teacher.result_teacher_class' , compact(['chooseterm','chooseyear','school_id' ,'level_id' ,'year_id' , 'class_id' , 'teacher_id' , 'material_id']));




       }

}
