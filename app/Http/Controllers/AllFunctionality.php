<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AllFunctionality extends Controller
{
    //user register
    public function customSignup(Request $request)
    {
       // dd($request->all());

        // $request->validate([
        //     'name' => 'required',
        //      'email' => 'required|email|unique:candidate', 
        //      'password' => 'required|min:6',], 
        //      'number' => 'required|max:10',], 
        //      ['name.required' => 'name should not blank!'
        // ]);

        DB::insert('insert into candidate (techid, name, address,phone_no,email,userid,password,photo,status) values (?,?,?,?,?,?,?,?,?)', 
        [$request->techid, $request->name, $request->address, $request->number,  $request->email, $request->userid, $request->password,$request->photo,'N']);     

        return redirect("user_login")->with('msg','successfully registered');
    }

    //admin login
    public function Signinadmin(Request $request)
    {
        $credentials = $request->only('id', 'password');
        // dd($credentials);
        $admin=DB::table('admin')->where('adminid', $credentials['id'])->where('password', $credentials['password'])->first();
        // dd($admin);
       
        if($admin != null){
            Session::put('name', 'Admin');
            return redirect('admin_home')->with("Login successfully");
        }
        else{
            return redirect("admin_login")->with('msg','!!!! Wrong credential  !!!!');
        }
    }

    //user login
    public function Signinuser(Request $request)
    {
        $credentials = $request->only('id', 'password');
        // dd($credentials);
        $admin=DB::table('candidate')->where('userid', $credentials['id'])->where('password', $credentials['password'])->first();
        
        // dd($admin);
        if($admin != null){
            if($admin->status == 'A'){

                    Session::put('name', $admin->name);
                    Session::put('id', $admin->candidate_id);
                    Session::put('techid', $admin->techid);

                    $user=DB::table('candidate')->get();

                    return redirect('user_home')->with(['user',$user]);
            }
            else {
                $message = "plz contact to admin";
                return redirect('user_login')->with(['msg' => $message]);
            }

        }
        else{
            return redirect("user_login")->with('msg','!!!! Wrong credential  !!!!');
        }
            
    }
       
    

    //logout
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }
}
