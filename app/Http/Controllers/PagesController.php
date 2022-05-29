<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function trainee() {
       /*  $title="Just to test this thing trasferring data maybe";
         return view('pages.trainee',['title'=>$title]); */
         return view('trainees.index');
    }
    public function trainer() {
        return view('pages.trainer');
    }

   public function courses() {
    return view('pages.courses');
    }
    
    public function show($id)
    {
        return 'user id is '. $id;
        //return view('user.profile', ['user' => User::findOrFail($id)]);
    }

}
