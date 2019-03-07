<?php

namespace App\Http\Controllers\Admin;

use App\Year;
use App\Level;
use App\Classe;
use App\School;
use App\Teacher;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    //
    public function add_teacher(){
        $levels = Level::where('school_id',1)->get();  
        $materials  =  Material::all(); 
        return view('admin.add_teacher',compact(['materials','levels'])); 
    }
    public function add_teacher_post( Request $request){
        // dd(explode(',',request("materials_selectbox_names"))); 
        $this->validate(request(), [
            
            'name' => 'required',
            'username' => 'required|unique:teachers',
            'email' => 'nullable|email|unique:teachers',
            'password' => 'required',
            'confirmpassword' => 'required|same:password',
            'phone' => 'nullable|numeric|regex:/(01)[0-9]{9}/',
            'school_id' => 'required',
            'materials_selectbox_names' =>'required',
            "classes"    => "required|array|min:1",
            "classes.*"  => "distinct",
            
        ]);
        
        // dd(request('classes')); 
        if(request()->image){

            $image = $request->image;         
            $imageName = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName); 
            $request->merge(['image' => $imageName ]);

        }
        
        $teacher = Teacher::create([
            'name'=>request('name'),
            'username'=>request('username'),
            'email'=>request('email'),
            'password'=>request('password'),
            'phone'=>request('phone'),
            'school_id'=>request('school_id'),
            'address'=>request('address'),
            ]
        ); 
        
        // start  attach classes to teacher 
        if( request('classes') ) {

            foreach(request('classes') as $class_id) {
                DB::table('teacher_class')->insert([
                    'teacher_id'=>$teacher->id,
                    'class_id' => $class_id ,
                    ]); 
                }
        }
        // end  attach classes to teacher 

        // start  attach materials to teacher 
        if( request('materials_selectbox_names') ) {
            $selectBoxNames = explode(',',request("materials_selectbox_names"));

            foreach($selectBoxNames as $material_id) {
                DB::table('teacher_material')->insert([
                    'teacher_id'=>$teacher->id,
                    'material_id' => request($material_id) ,
                    ]); 
                }
        }
        // end  attach materials to teacher 



        return redirect()->back()->with(['success_insert'=>'Success Added Teacher']);

    }
    
    public function get_years( Request $request){
        $years = Year::where('level_id',request('level_id'))->get(); 
        
        return response()->json([ 'years'=>$years  ]);
    }

    public function get_classes(Request $request )
    {
        $year  = Year::find(request('year_id')); 
        $classes = Classe::where('year_id',request('year_id'))->get(); 
        $materials = Material::where('year_id',request('year_id'))->get(); 
        return response()->json([
                'classes' => $classes , 
                'materials'=>  $materials , 
                'year' => $year  ,
                ]);
    }

    // start all teacher functions 

    // get school years belong to admin (shcools page)
    public function schools(Request $request )
    {
        $school_id = request('school_id') ;
        $school = School::where('id', $school_id )->first(); 
        // $school = School::where('school_id',auth()->user()->school_id)->first(); 
        return view('admin.teacher.schools',compact([ 'school' , 'school_id' ]));
    } // end func
    
    // get school years belong to admin (shcools page)
    public function levels(Request $request )
    {
        $school_id = request('school_id') ;
        $levels = Level::where('school_id', $school_id )->get(); 
        return view('admin.teacher.levels',compact([ 'levels' , 'school_id' ]));
    } // end func

    // get school years belong to admin (shcools page)
    public function years(Request $request )
    {
        $school_id = request('school_id') ;
        $level_id  = request('level_id') ;
        $years = Year::where([
            'school_id' => $school_id ,
            'level_id'  => $level_id
        ])->get(); 
        // $school = School::where('school_id',auth()->user()->school_id)->first(); 
        return view('admin.teacher.years',compact(['years','school_id','level_id']));
    } // end func
    
    // get get classes of one year 
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

        return view('admin.teacher.materials',compact(['materials','school_id','level_id','year_id']));
    } // end func

    // get all students in one  classes  
    public function teachers_on_material(Request $request )
    {
    

        $school_id = request('school_id') ;
        $level_id   = request('level_id') ;
        $year_id = request('year_id') ;
        $material_id = request('material_id') ;
        // $teachers = Teacher::where('material_id', $material_id )->get(); 

        $teachers_ids = DB::table('teacher_material')->where('material_id',$material_id)->pluck('teacher_id') ; 
        $teachers = Teacher::whereIn('id',$teachers_ids)->get() ; 
        return view('admin.teacher.teachers_on_material',compact(['teachers','school_id','level_id','year_id' , 'material_id' ]));

    } // end func
    // end all teacher functions 




}
