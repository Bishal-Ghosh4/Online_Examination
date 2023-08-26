<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    // schedule page ajax function
    public function getcandi(Request $request)
    {
        $input = $request->all();
        //  dd($input);
        $names = DB::table('candidate')->where('techid', $input['techid'])->get();
        // dd($names);
        return response()->json($names);
    }

    public function save(Request $request)
    {
        if ($request->btn == "Add") {
        //    dd($request->all());

            DB::insert('insert into schedule (candidate_id,date,StartRangetime,EndRangetime,no_of_question,duration) values (?,?,?,?,?,?)',
             [$request->candid, $request->date, $request->starttime, $request->endtime,$request->noofquestion,$request->duration]);
            
            $name=DB::select("SELECT * FROM candidate WHERE candidate.candidate_id='$request->candid' ");

            $can=$name[0]->name;
            return redirect('sehedule')->with('msg', "successfully schedule exam for $can  ");

            // return view('class')->with('msg',"successfully added class");
        }
        if ($request->btn == "Update") {
            DB::update('update subjectdetails set classid =?,semname =?,subname =? where slno= ? ', [$request->clname, $request->sename, $request->subname, $request->id]);
            return redirect('subject')->with('msg', "updated successfully ");
        }
    }


    public function edit(Request $request)
    {
        // dd($request->all());
        return redirect('subject')->with(['slno' => $request->id, 'clname' => $request->clname, 'sename' => $request->sename, 'subname' => $request->subname]);
    }
    public function delete(Request $request)
    {

        DB::delete('delete from schedule where slno = ?', [$request->slno]);
        return redirect('sehedule')->with('msg', "deleted successfully ");
    }
}
