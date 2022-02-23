<?php

namespace App\Http\Controllers;

use App\Mail\SuccessMail;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        $details =[
            'title' => 'Mail From Student Management System',
            'body' => 'Welcome To Student Management System (SMS)'
        ];
        Mail::to("navamayoo@gmail.com")->send(new SuccessMail($details));
        return "Email Send";
    }
}