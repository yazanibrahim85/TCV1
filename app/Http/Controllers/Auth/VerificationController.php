<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

use App\Trainer;
use App\Trainee;
use App\Course;
use App\Training;
use App\courses_trainers;
use App\courses_trainees;

use Session;


use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    
   /*  $courses=Course::all();
    $trainers=Trainer::all();
    $trainees=Trainee::all();
 */
    protected $redirectTo = '/home'/* ,['courses' => $courses,'trainers' => $trainers,'trainees' => $trainees] */;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
