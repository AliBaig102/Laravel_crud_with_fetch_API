<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class studentController extends Controller
{
    public function show_all()
    {
        $data= DB::table('students')->get();
        return view('welcome',['data'=>$data]);
    }
    public function show_single(Request $request)
    {
        $id=$request->id;
        $data= DB::table('students')->where('student_id','=',$id)->get();
        return response()->json($data);
    }
    public function insert(Request $request){
        $result= DB::table('students')->insert([
            'student_name'=>$request->name,
            'student_email'=>$request->email,
            'student_age'=>$request->age
        ]);
        if ($result) return redirect()->route('home');
    }
    public function delete(Request $request){
        $result= DB::table('students')->where('student_id','=',$request->id)->delete();
        if ($result) return redirect()->route('home');
    }
    public function update(Request $request,$id){
       $result= DB::table('students')->where('student_id','=',$id)->update([
           'student_name'=>$request->name,
           'student_email'=>$request->email,
           'student_age'=>$request->age
        ]);
       if ($result){
           return redirect()->route('home');
       }
    }
}
