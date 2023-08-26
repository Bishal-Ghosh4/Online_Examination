<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{

  // approve user
  public function update(Request $request)
  {
    // dd($request->email);
    $user = DB::table('candidate')->where('email', $request->email)->update(['status' => 'A']);

    return redirect('viewCandidate');
  }
 
}
