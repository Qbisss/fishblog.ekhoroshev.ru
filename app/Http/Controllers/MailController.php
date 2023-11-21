<?php

namespace App\Http\Controllers;
use App\Mail\ResetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
   /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $mailData = [
            'title' => 'Mail from laraveia.com',
            'body' => 'This is for testing email using smtp.'
        ];
         
        Mail::to('your_email@gmail.com')->send(new ResetMail($mailData));
    }
}
