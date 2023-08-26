<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Size;
// use Barryvdh\DomPDF\Facade\Pdf;
use PDF;

class ExamController extends Controller
{
    public function exam(Request $request)
    {
        return view('examPage');
    }
    public function generatePDF(Request $request)
    {
        // this query for fetching final results
        $rans = DB::select("SELECT COUNT(examresult.resultstatus) as resultans FROM examresult
            WHERE examresult.resultstatus=1 and examresult.userid='$request->id'
            GROUP by examresult.userid");

        //  this query for fetching given answers
        $gans = DB::select("SELECT technology.techname,schedule.no_of_question,COUNT(examresult.givenans) as givenans FROM examresult,schedule,technology,candidate
            WHERE schedule.candidate_id=examresult.userid and examresult.userid='$request->id'and technology.techid=candidate.techid
            GROUP by examresult.userid ");

        // dd($gans[0]->givenans, $rans[0]->resultans);
        $resultans = count($rans) != 0 ? $rans[0]->resultans : 0;
        $per = ($resultans / $gans[0]->no_of_question) * 100;

        // dd($per);
        $data = [
            'name' => $request->username,
            'mark' => $per,
            'technology' => $gans[0]->techname
        ]; // Pass any data you want to the PDF view

        $pdf = PDF::loadView('user/CertificatePDF', $data); // Replace 'pdf.template' with your view

        return $pdf->download('certificate.pdf');
    }
    public function question(Request $request)
    {
        $data = DB::select("select * from examresult where userid='$request->userid' ");
        $time = DB::select("select duration,StartRangetime,EndRangetime from schedule where candidate_id='$request->userid' ");

        //  dd(var_dump($time[0]->duration));

        //validate for giving the exam
        if (count($data) > 0) {
            return view('QuestionPage', ['res' => 'You have already given the exam', 'time' => 0]);
        } else {
            $ques = DB::select("select * from question where techid='$request->techid' ");
            return view('QuestionPage', ['ques' => $ques, 'userid' => $request->userid, 'time' => $time[0]->duration]);
        }
    }

    public function save(Request $request)
    {
        //dd($request->all());
        $time = DB::select("select duration,no_of_question from schedule where candidate_id='$request->userid' ");

        $ques = DB::select("select * from question where techid='$request->techid' ");
        
        //inserting result into table
        for ($i = 0; $i < $time[0]->no_of_question; $i++) {

            DB::table('examresult')->insert([
                'userid' => $request->userid,
                'qid' => $ques[$i]->qid,
                'givenans' => $request['question_' . $i + 1],
                'actualans' => $ques[$i]->ans,
                'resultstatus' => ($request['question_' . $i + 1] == $ques[$i]->ans) ? 1 : 0
            ]);
        }


        // this query for fetching final results
        $rans = DB::select("SELECT COUNT(examresult.resultstatus) as resultans FROM examresult
        WHERE examresult.resultstatus=1 and examresult.userid='$request->userid'
        GROUP by examresult.userid");

        // this query for fetching given answers
        $gans = DB::select("SELECT schedule.no_of_question,COUNT(examresult.givenans) as givenans FROM examresult,schedule
        WHERE schedule.candidate_id=examresult.userid and examresult.userid='$request->userid'
        GROUP by examresult.userid ");

        $resultans = count($rans) != 0 ? $rans[0]->resultans : 0;

        // dd($resultans);
        $per = ($resultans / $gans[0]->no_of_question) * 100;
        // dd($per);

        if ($per >= 60) {
            $msg = "!!!! Congratulations You have successfully Passed !!!!";
            $mark = $per;
        } else {
            $msg = "Sorry You have not Passed !!!!";
            $mark = $per;
        }


        return view('QuestionPage',['time' =>0,'msg' => $msg, 'mark' => $mark]);
    }
}
