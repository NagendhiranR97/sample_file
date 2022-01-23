<?php

namespace App\Http\Controllers;

use App\Mail\UserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendSignupEmail($fname, $email){
        $data = [
            'fname' => $fname,
        ];
        Mail::to($email)->send(new UserMail($data));
    }
}