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

            foreach( $selectBoxNames as $material_id ) {
                DB::table('teacher_material')->insert([
                    'teacher_id'=>$teacher->id,
                    'material_id' => request($material_id) ,
                    ]); 
                }
        }
        // end  attach materials to teacher 
        return redirect()->back()->with(['success_insert'=>'Success Added Teacher']);
    }
    // get years  in this level  by level_id 
    public function get_years( Request $request)
    {
        $years = Year::where('level_id',request('level_id'))->get(); 
        
        return response()->json([ 'years'=>$years  ]);
    }


    // get classes and  materials in this year by  ( year_id )
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
    
}
