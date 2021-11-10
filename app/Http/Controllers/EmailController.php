<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\QueueJob;

class EmailController extends Controller
{
    public function sendEmail(){
        dispatch(new QueueJob());

        dd("Email has been delivered");
    }
}
