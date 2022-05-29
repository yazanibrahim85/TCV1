<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


use Illuminate\Support\Facades\DB;


use App\Trainer;
use App\Trainee;
use App\Course;
use App\Training;
use App\courses_trainers;
use App\courses_trainees;

use Session;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    /* return view('dashboard',['trainings' => Training::take(4)->get(),
    'trainingsCount' => Training::count(),
    
    'coursesCount' =>Course::count(),
    'courses' =>Course::take(4)->get(),
    'trainees'=>Trainee::take(4)->get(),
    'traineesCount' => Trainee::count(),
    'trainers'=>Trainer::take(4)->get(),
    'trainersCount' => Trainer::count()]); */

    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $role_id=DB::select('select id from roles where description =?', [$data['role_desc']]);
       // $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
		//dd($courses_id[0]->id);
        $role_id=$role_id[0]->id;

        $area_id=DB::select('select id from areas where name =?', [$data['area_name']]);
       // $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
		//dd($courses_id[0]->id);
        $area_id=$area_id[0]->id;


        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $role_id,
            'area_id' => $area_id,
        ]);
    }
}
