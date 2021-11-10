<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DeptController extends Controller
{
    //
    public function deptmanagement() {
        return view('admin.deptmanagement');
    }

    public function getDept() {
        $data = Department::all();
        return view('admin.deptmanagement',['depts'=>$data]);
    }

    public function delete($id) {
        $data = Department::find($id);

        $data->delete();
        return redirect('admin/deptmanagement');
    }

    public function edit($id) {
        $data = Department::find($id);
        return view('admin.editdept',['data'=>$data]);
    }

    public function update(Request $req) {
        $data = Department::find($req->id);
        $data->name = $req->name;
        $data->save();
        return redirect('admin/deptmanagement');
    }
}
