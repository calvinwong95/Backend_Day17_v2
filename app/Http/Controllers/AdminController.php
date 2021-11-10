<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use App\Models\User;
use App\Models\Department;

class AdminController extends Controller
{
    //

    // public function dashboardOp() {
    //     $data = DB::table('users')->count();

    //     return view('admin.dashboard',['countuser'=>$data]);
    // }

    public function usermanagement() {
        return view('admin.usermanagement');
    }



    public function getUsers() {
        $data = User::all();
        return view('admin.usermanagement',['users'=>$data]);
    }

    public function delete($id) {
        $data = User::find($id);

        $data->delete();
        return redirect('admin/usermanagement');
    }

    public function edit($id) {
        $data = User::find($id);
        return view('admin.edituser',['data'=>$data]);
    }

    public function update(Request $req) {
        $data = User::find($req->id);
        $data->name=$req->name;
        $data->email=$req->email;
        $data->password=$req->password;
        $data->save();
        return redirect('admin/usermanagement');
    }


    public function dashboard() {

        $jwt_token = session('jwt_token');

        $data = DB::table('users')->count();
        $datajob = DB::table('jobs')->count();
        $datadept = DB::table('departments')->count();

        return view('admin.dashboard',['countuser'=>$data,'countjob'=>$datajob,'countdepart'=>$datadept,'jwt_token'=>$jwt_token]);
    }




    public function index(Request $request) {
        if($request->isMethod('post')) {
            $credentials = $request->validate([
                'email'=>['required','email'],
                'password'=>['required'],
            ]);

            if (Auth::attempt($credentials)) {
            if(Auth::user()->role==1) {
                $request->session()->regenerate();
                $jwt_token = JWTAuth::attempt($credentials);
                session(['jwt_token'=>$jwt_token]);

                // return redirect('dashboard');
                return redirect()->route('dashboard');
            } else {
                return redirect('/');
            }


            }
            return back()->withErrors([
                'email'=>'The entered email or password do not match our records.',
            ]);

        }


        return view('admin.login');
    }
}

