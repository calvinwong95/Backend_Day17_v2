<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    //
    public function jobmanagement() {
        return view('admin.jobmanagement');
    }

    public function getJobs() {
        $data = Job::all();
        return view('admin.jobmanagement',['jobs'=>$data]);
    }

    public function delete($id) {
        $data = Job::find($id);

        $data->delete();
        return redirect('admin/jobmanagement');
    }

    public function edit($id) {
        $data = Job::find($id);
        return view('admin.editjob',['data'=>$data]);
    }

    public function update(Request $req) {
        $data = Job::find($req->id);
        $data->title = $req->title;
        $data->description = $req->description;
        $data->min_salary = $req->min_salary;
        $data->mas_salary = $req->mas_salary;
        $data->save();
        return redirect('admin/jobmanagement');
    }
}
