<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Mail\SendMailreset;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\User;

class PasswordResetRequestController extends Controller
{
    //This is most important function to send mail and inside of that there are anoter
    public function sendEmail(Request  $request){
        // This is validate to fail send mail or true
        if(!$this->validateEmail($request->email)){
            return $this->failedResponse();
        }
        // This is a function to send mail
        $this->send($request->email);
            return $this->successResponse();
    }

     // This is a function to send mail
    public  function send($email){
        $token = $this->createToken($email);
        Mail::to($email)->send(new SendMailreset($token, $email)); // token is important is sendmail
    }

     // This is a function to get your request email that there are or not send mail
    public function createToken($email){
        $oldToken = DB::table('password_resets')->where('email',$email)->first();
        if($oldToken){
            return $oldToken->token;
        }
        $token = Str::random(40);
        $this->saveToken($token,$email);
        return $token;
    }

     // This is a function save new password
    public function saveToken($token, $email){
        DB::table('password_resets')->insert([
            'email'=>$email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);
    }

     // This is a function to get your email from databasephp artisan make:mail SendMailreset --markdown=Email.passwordReset
    public function validateEmail($email){
        return !!User::where('email',$email)->first();
    }
    public function failedResponse(){
        return response()->json([
            'error'=> 'Email does \'t found on our database'
        ], Response::HTTP_NOT_FOUND);
    }
    public function successResponse(){
        return response()->json([
            'success'=> 'Reset Email is send successfully, please check your inbox'
        ], 200);
    }

}
