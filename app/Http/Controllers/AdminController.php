<?php

namespace App\Http\Controllers;

use App\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function getResetAdminPassword()
    {
        return view('ResetPasswod.reset_password');
    }

    public function postResetAdminPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
      

        if (!$validator->fails()) {

            $email = request()->input('email');
            // dd($email);
            $user = DB::table('user_master')->where('email', $email)->first();
            //dd($user);

            if ($user) {
                $token = "23asdadas7safsaafa23772gywgfywgef";
                $user_name = $user->name;
                
                $data=['actionUrl' => $token,'email' => $email, "user_name" => $user_name];

                $mail = Mail::send('ResetPasswod.emails.SendReserPasswordLink', $data, function ($message) use ($user) {
                    $message->subject(config('app.name') . ' Password Reset Link');
                    $message->to($user->email);
                });

                // Admin::where('email', $email)->update([
                //     "password_reset_token" => $token,
                // ]);
                
                return back()->with('success', 'Mail sent successfully.');
            } else {
                return back()->with('error', 'User not Found for this Email Address.');
            }
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function resetPassword(Request $request, $email, $verificationLink)
    {
        $user = DB::table('user_master')->where('email', $email)->get();
        //dd($user);
        $userid = $user[0]->id;
        $data["userid"] = $userid;
        dd($data);
        return view('ResetPasswod.new_password', $data);
    }

    public function newPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        if (!$validator->fails()) {
            $param = $request->all();
            $userid = $param['userid'];
            $new_password = $param['new_password'];
            // $data["password"] = bcrypt($new_password);
            // dd(encrypt($data['password'])); 
            $updated_status =DB::table('user_master')->where("id", $userid)->update(['password' => $new_password]);

            if ($updated_status) {

                return redirect('login')->with("success", 'Password Reset successfully.');
            }
        } else {

            return redirect()->back()->withInput()->withErrors($validator);
        }
    }
}
