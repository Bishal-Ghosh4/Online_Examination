<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 

class TechnologyController extends Controller
{
    public function savetech(Request $request){
        // dd($request->all());
        if($request->btn=="Add"){
            $validate = Validator::make($request->all(), [
                'techname' => 'required|unique:candidate'
            ]);
            DB::insert('insert into technology (techname) values (?)', [$request->techname]);
            return redirect('technology')->with('msg',"successfully add technology");

        }
        // if($request->btn=="Update"){
        //     DB::update('update classmaster set classname =? where classname= ? ', [$request->clname, $request->prevname]);
        //     return redirect('branch')->with('msg',"updated successfully ");
        // } 
    }
    public function saveque(Request $request){
     // dd($request->all());

        if($request->btn=="Add"){
            DB::insert('insert into question (techid,question,opt1,opt2,opt3,opt4,ans) values (?,?,?,?,?,?,?)',
             [$request->techid,$request->question,$request->opt1,$request->opt2,$request->opt3,$request->opt4,$request->ans]);
            
             return redirect('technology/question')->with('msg',"successfully add question");

        }
        
    }
    
    // public function edit(Request $request){
    //    // dd($request->all());
    //     return redirect('branch')->with('name',$request->name);
    // }
    // public function delete(Request $request){

    //     DB::delete('delete from classmaster where classname = ?', [$request->name]);

    //     // return redirect('class')->with('msg',"deleted inserted");
    //     return redirect('branch')->with('msg',"deleted successfully ");
    // }
}
