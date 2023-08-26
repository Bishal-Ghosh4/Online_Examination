<?php

use App\Http\Controllers\AllFunctionality;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ExamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Forget password routes
Route::get('admin/password/email', [AdminController::class, 'getResetAdminPassword'])->name('password.reset');
Route::post('admin/password/email', [AdminController::class, 'postResetAdminPassword'])->name('password.reset');

Route::get('admin/resetPassword/{email}/{verificationLink}', [AdminController::class, 'resetPassword']);
Route::post('admin/resetPassword', [AdminController::class, 'newPassword']);


Route::get('/', function () {
    return view('home');
});

Route::get('/admin_home', function () {
    return view('admin/admin_home');
});
Route::get('/admin_login', function () {
    return view('admin/admin_login');
});

Route::get('/user_home', function () {
    $user = DB::table('candidate')->get();
    return view('user/user_home', ['user', $user]);
});



Route::get('/user_login', function () {
    return view('user/user_login');
});

Route::get('/register', function () {
    $tech = DB::table('technology')->get();
    return view('user/register', ['tech' => $tech]);
});

// exam conducting
Route::get('/exam', [ExamController::class, 'exam']);
Route::get('question',[ExamController::class,'question']);

// Route::post('/savequestion', [ExamController::class, 'save']);
Route::post('/submitexam', [ExamController::class, 'save']);



// Route::get('/generate-pdf', function(){
//     return view('user/CertificatePDF');
// });
Route::post('/generate_pdf', [ExamController::class,'generatePDF'])->name('generate.pdf');



// ----------------------------------------------------------------


Route::get('/logout', [AllFunctionality::class, 'logout'])->name('logout');

Route::post('/register-submit', [AllFunctionality::class, 'customSignup']);
Route::post('/admin_login-submit', [AllFunctionality::class, 'Signinadmin']);
Route::post('/user_login-submit', [AllFunctionality::class, 'Signinuser']);


// View results
Route::get('/result', function () {
  
    $rans = DB::select("SELECT candidate.name,COUNT(examresult.resultstatus) as resultans FROM examresult,candidate WHERE candidate.candidate_id=examresult.userid and examresult.resultstatus=1 GROUP by examresult.userid");
    $gans = DB::select("SELECT candidate.name,technology.techname,schedule.no_of_question,COUNT(examresult.givenans) as givenans FROM examresult,candidate,technology,schedule WHERE candidate.candidate_id=examresult.userid and schedule.candidate_id=examresult.userid AND technology.techid=candidate.techid GROUP by examresult.userid ");
    //dd($rans);
    return view('Result_Detail', ['givenans' => $gans, 'resultans' => $rans]);
});


//--------------------------------------------------------------


// Sehedule Exam
Route::get('/sehedule', function () {
    $cl = DB::select("SELECT * FROM technology ");
    $dets = DB::select("SELECT schedule.*,candidate.name FROM schedule,candidate WHERE schedule.candidate_id=candidate.candidate_id;");

    return view('Schedule_Detail', ['tech' => $cl, 'dets' => $dets]);
});

Route::post('/getcandi', [ScheduleController::class, 'getcandi']);


Route::post('/sehedule', [ScheduleController::class, 'save']);

Route::get('/deletesub', [ScheduleController::class, 'delete']);
// Route::get('/editsub', [SubjectController::class, 'edit']);


//----------------------------------------------------------------


// viewCandidate
Route::get('/viewCandidate', function () {
    $cl = DB::select("SELECT * FROM candidate,technology WHERE candidate.techid=technology.techid");
    return view('Candidate_Detail', ['candi' => $cl]);
});

Route::get('/viewCandidate/{email}', [CandidateController::class, 'update']);


//-----------------------------------------------------------------

// technology
Route::get('/technology', function () {
    return view('Technology_Detail');
});
Route::get('/technology/question', function () {
    $tech = DB::table('technology')->get();
    return view('AddQuestion', ['tech' => $tech]);
});

Route::post('/technology', [TechnologyController::class, 'savetech']);
Route::post('/technology/question', [TechnologyController::class, 'saveque']);
