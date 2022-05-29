<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


use App\Trainer;
use App\Trainee;
use App\Course;
use App\Training;
use App\courses_trainers;
use App\courses_trainees;

use Session;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses=Course::all();
        $trainers=Trainer::all();
        $trainees=Trainee::all();

        return view('reports',['trainers'=>$trainers]);
    }

    public function Trainerindex()
    {
        $courses=Course::all();
        $trainers=Trainer::all();
        $trainees=Trainee::all();

        return view('reports.trainerReport',['trainers'=>$trainers]);
    }

    public function Aggindex()
    {
        $courses=Course::all();
        $trainers=Trainer::all();
        $trainees=Trainee::all();

        return view('reports.AggReports',['trainers'=>$trainers,'trainees'=>$trainees,'courses'=>$courses]);
    }


    
    public function Traineeindex()
    {
        $courses=Course::all();
        $trainers=Trainer::all();
        $trainees=Trainee::all();

        return view('reports.traineeReport',['trainers'=>$trainers,'trainees'=>$trainees]);
    }

    

    public function AggReportindex()
    {
        return view('trainess.uploadnewTrainings.exportAggregation');
   
    }
    public function Trainingindex()
    {
        $courses=Course::all();
        $trainers=Trainer::all();
        $trainees=Trainee::all();
        $trainings=Training::all();

        
        $course_name=DB::select('select name_ar from courses');
		//dd($course_name);
        //$course_name=$trainer_id[0]->id;


        return view('reports.trainingReport',['courses'=>$courses,'trainers'=>$trainers,'trainees'=>$trainees,'trainings'=>$trainings]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function viewTrainers($id)
    {
        //dd($id);
        return view('reports.viewTrainers',['trainer'=>Trainer::find($id)]);
    }

    public function viewTrainees($id)
    {
        //dd($id);
        return view('reports.viewTrainees',['trainee'=>Trainee::find($id)]);
    }

    public function viewTrainings($id)
    {
        //dd($id);
        return view('reports.viewTrainings',['training'=>Training::find($id)]);
    }



    public function searchTrainer(Request $request)
    {


        $TN=$request->Trainername;
        $TA=$request->area_id;
        //dd($TN);

        if (!empty($TN) and !empty($TA) )
        {
        $trainer_id=DB::select("select * from trainers where name ='".$request->Trainername."' and area_id=".$request->area_id);
		//dd($trainer_id);
        if (!empty($trainer_id[0]->id))
        {
            //$trainer_id=$trainer_id[0]->id;
            $trainer1=$trainer_id[0]->id;
                }
                else 
                {
                    $trainer_id=0;  
                }
        }elseif(!empty($TN) and empty($TA))
        {
           
            $trainer_id=DB::select("select * from trainers where name ='".$request->Trainername."'");
           // $trainer_id=$trainer_id[0]->id;
            $trainer1=$trainer_id[0]->id;
        }elseif (empty($TN) and !empty($TA))
        {
            //dd($request->area_id);
            $trainer_id=DB::select("select * from trainers where area_id =".$request->area_id);
            //$train=$trainer_id;

            if (!empty($trainer_id[0]->id))
            {
            $trainer1=$trainer_id[0]->id;
            for($xx=0;$xx<count($trainer_id);$xx++)
            {
               $idd[$xx]=$trainer_id[$xx]->id;
            }
            
            }
           
            //$trainer_id=$trainer_id[1]->id;
            //dd($idd); 
        }else
        {
            $trainer_id=DB::select("select * from trainers ");
            //$train=$trainer_id;

            $trainer1=$trainer_id[0]->id;

            for($xx=0;$xx<count($trainer_id);$xx++)
            {
               $idd[$xx]= $trainer_id[$xx]->id;
            }

        }
        //dd($trainer_id);
        
            return view('/reports/viewTrainers',['trainers'=>$trainer_id]);

            //return redirect("/reports/{['id'=>$idd]}/viewTrainers");
            //return redirect('/reports/{'.$trainer1.'}/viewTrainers',['trid'=>$trainer_id]);
         
           
        
        //return redirect("/trainers/{$trainer_id}/edit");
        
    }

    public function searchTrainee(Request $request)
    {


       
        $TN=$request->Traineename;
        $TA=$request->area_id;
        $TAge=$request->age;
        $TG=$request->gender;
        //dd($TAge);

        // we can make 15 different options in these four different choices
        if (!empty($TN) and !empty($TA) and !empty($TG) and !empty($TAge))
        {
        $trainee_id=DB::select("SELECT * FROM trainees WHERE name='".$TN."' and area_id=".$TA." and gender='".$TG."' and dob".$TAge."" );
		//dd($trainee_id[0]->id);
        if (!empty($trainee_id[0]->id))
        {
           
                }
                else 
                {
                    $trainee_id=0;  
                }
        }elseif(!empty($TN) and empty($TA) and empty($TG) and empty($TAge))
        {
           
            $trainee_id=DB::select("select * from trainees where name ='".$TN."'");
         
        }elseif(empty($TN) and !empty($TA) and empty($TG) and empty($TAge))
        {
           
            $trainee_id=DB::select("select * from trainees where area_id =".$TA);
   
        }elseif(empty($TN) and empty($TA) and !empty($TG) and empty($TAge))
        {
           
            $trainee_id=DB::select("select * from trainees where gender ='".$TG."'");
        
        }elseif(empty($TN) and empty($TA) and empty($TG) and !empty($TAge))
        {
           
            $trainee_id=DB::select("select * from trainees where dob".$TAge."" );
           // First Five Condition Finished
           //"SELECT * FROM trainees WHERE name='".$TN."' and area_id=".$TA." and gender='".$TG."' and dob".$TAge."" 
        }elseif(!empty($TN) and !empty($TA) and empty($TG) and empty($TAge))
        {
           
            $trainee_id=DB::select("SELECT * FROM trainees WHERE name='".$TN."' and area_id=".$TA."" );
           
        }elseif(!empty($TN) and empty($TA) and !empty($TG) and empty($TAge))
        {
           
            $trainee_id=DB::select("SELECT * FROM trainees WHERE name='".$TN."' and gender='".$TG."'" );
           
        }elseif(!empty($TN) and empty($TA) and empty($TG) and !empty($TAge))
        {
           
            $trainee_id=DB::select("SELECT * FROM trainees WHERE name='".$TN."' and dob".$TAge."" );
           
        }elseif(empty($TN) and !empty($TA) and !empty($TG) and empty($TAge))
        {
           
            $trainee_id=DB::select("SELECT * FROM trainees WHERE area_id=".$TA." and gender='".$TG."'"  );
           
        }elseif(empty($TN) and !empty($TA) and empty($TG) and !empty($TAge))
        {
           
            $trainee_id=DB::select("SELECT * FROM trainees WHERE area_id=".$TA." and dob".$TAge.""  );
           
        }elseif(empty($TN) and empty($TA) and !empty($TG) and !empty($TAge))
        {
           
            $trainee_id=DB::select("SELECT * FROM trainees WHERE gender='".$TG."' and dob".$TAge.""  );
           //1+4+6 COniditions Finished for all for each one only for group of twos now next group of threes
        }elseif(!empty($TN) and !empty($TA) and !empty($TG) and empty($TAge))
        {
           
            $trainee_id=DB::select("SELECT * FROM trainees WHERE name='".$TN."' and area_id=".$TA." and gender='".$TG."'"  );
           
        }elseif(!empty($TN) and !empty($TA) and empty($TG) and !empty($TAge))
        {
           
            $trainee_id=DB::select("SELECT * FROM trainees WHERE name='".$TN."' and area_id=".$TA." and dob".$TAge.""  );
           
        }elseif(!empty($TN) and empty($TA) and !empty($TG) and !empty($TAge))
        {
           
            $trainee_id=DB::select("SELECT * FROM trainees WHERE name='".$TN."' and gender='".$TG."' and dob".$TAge.""  );
         
        }elseif(empty($TN) and !empty($TA) and !empty($TG) and !empty($TAge))
        {
           
            $trainee_id=DB::select("SELECT * FROM trainees WHERE area_id=".$TA." and gender='".$TG."' and dob".$TAge.""  );
             //1+4+6+4 COniditions Finished for all for each one , for group of twos and group of threes finished now next group of threes
    
        }else
        {
            //dd($request->area_id);
            $trainee_id=DB::select("select * from trainees ");
            //$train=$trainer_id;

            $trainer1=$trainee_id[0]->id;

            for($xx=0;$xx<count($trainee_id);$xx++)
            {
               $idd[$xx]= $trainee_id[$xx]->id;
            }
            //$trainer_id=$trainer_id[1]->id;
            //dd($idd); 
        }
        //dd($trainer_id);
        
            return view('/reports/viewTrainees',['trainees'=>$trainee_id]);

            //return redirect("/reports/{['id'=>$idd]}/viewTrainers");
            //return redirect('/reports/{'.$trainer1.'}/viewTrainers',['trid'=>$trainer_id]);
         
           
        
    }

    public function searchTraining(Request $request)
    {

        $CN=$request->courseName;
        $TA=$request->area_id;
        $TDate=$request->TDate;

           // $diff = abs(strtotime($row['']) - strtotime(date("Y-m-d")));
           // $years = floor($diff / (365*60*60*24));
            //$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            //$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        if ($TDate=='A')
        {
            $TDate=date("Y-m-d H:i:s",strtotime("-1 month"));
           // dd($TDate);
        }elseif ($TDate=='B'){
            $TDate=date("Y-m-d H:i:s",strtotime("-2 month"));
        }elseif ($TDate=='C'){
            $TDate=date("Y-m-d H:i:s",strtotime("-12 month"));
           // $CurYear=YEAR(CURDATE())
            //$TDate=date("Y");
            //dd($TDate);
        }
        $EDate=$request->EDate;
        //dd($TAge);
        if ($EDate=='A')
        {
            $EDate=date("Y-m-d H:i:s",strtotime("-1 month"));
            //dd($EDate);
        }elseif ($EDate=='B'){
            $EDate=date("Y-m-d H:i:s",strtotime("-2 month"));
        }elseif ($EDate=='C'){
            $EDate=date("Y-m-d H:i:s",strtotime("-12 month"));
        }
        // we can make 15 different options in these four different choices
        if (!empty($CN) and !empty($TA) and !empty($EDate) and !empty($TDate))
        {
            $training_id=DB::select("SELECT * FROM trainings WHERE course_id='".$CN."' and area_id=".$TA." and course_date>='".$TDate."' and course_date<='".date("Y-m-d")."' and expiration_date>='".$EDate."' and expiration_date<='".date("Y-m-d")."'" );
		//dd($trainee_id[0]->id);
      
      
        }elseif(!empty($CN) and empty($TA) and empty($EDate) and empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE course_id='".$CN."'" );
		
         
        }elseif(empty($CN) and !empty($TA) and empty($EDate) and empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE area_id=".$TA." " );
		
        }elseif(empty($CN) and empty($TA) and !empty($EDate) and empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE expiration_date>='".$EDate."' and expiration_date<='".date("Y-m-d")."'" );
		
        
        }elseif(empty($CN) and empty($TA) and empty($EDate) and !empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE course_date>='".$TDate."' and course_date<='".date("Y-m-d")."'");
		
           // First Five Condition Finished
           //"SELECT * FROM trainees WHERE name='".$TN."' and area_id=".$TA." and gender='".$TG."' and dob".$TAge."" 
        }elseif(!empty($CN) and !empty($TA) and empty($EDate) and empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE course_id='".$CN."' and area_id=".$TA."" );
		
           
        }elseif(!empty($CN) and empty($TA) and !empty($EDate) and empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE course_id='".$CN."' and expiration_date>='".$EDate."' and expiration_date<='".date("Y-m-d")."'" );
		
           
        }elseif(!empty($CN) and empty($TA) and empty($EDate) and !empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE course_id='".$CN."' and course_date>='".$TDate."' and course_date<='".date("Y-m-d")."'" );
		
           
        }elseif(empty($CN) and !empty($TA) and !empty($EDate) and empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE area_id=".$TA." and expiration_date>='".$EDate."' and expiration_date<='".date("Y-m-d")."'" );
		
           
        }elseif(empty($CN) and !empty($TA) and empty($EDate) and !empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE area_id=".$TA." and course_date>='".$TDate."' and course_date<='".date("Y-m-d")."'" );
		
           
        }elseif(empty($CN) and empty($TA) and !empty($EDate) and !empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE course_date>='".$TDate."' and course_date<='".date("Y-m-d")."' and expiration_date>='".$EDate."' and expiration_date<='".date("Y-m-d")."'" );
		
           //1+4+6 COniditions Finished for all for each one only for group of twos now next group of threes
        }elseif(!empty($CN) and !empty($TA) and !empty($EDate) and empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE course_id='".$CN."' and area_id=".$TA."  and expiration_date>='".$EDate."' and expiration_date<='".date("Y-m-d")."'" );
		
           
        }elseif(!empty($CN) and !empty($TA) and empty($EDate) and !empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE course_id='".$CN."' and area_id=".$TA." and course_date>='".$TDate."' and course_date<='".date("Y-m-d")."'" );
		
           
        }elseif(!empty($CN) and empty($TA) and !empty($EDate) and !empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE course_id='".$CN."' and course_date>='".$TDate."' and course_date<='".date("Y-m-d")."' and expiration_date>='".$EDate."' and expiration_date<='".date("Y-m-d")."'" );
		
         
        }elseif(empty($CN) and !empty($TA) and !empty($EDate) and !empty($TDate))
        {
           
            $training_id=DB::select("SELECT * FROM trainings WHERE area_id=".$TA." and course_date>='".$TDate."' and course_date<='".date("Y-m-d")."' and expiration_date>='".$EDate."' and expiration_date<='".date("Y-m-d")."'" );
		
             //1+4+6+4 COniditions Finished for all for each one , for group of twos and group of threes finished now next group of threes
     
        }else
        {
            //dd($request->area_id);
            $training_id=DB::select("select * from trainings");
       

            for($xx=0;$xx<count($training_id);$xx++)
            {
               $idd[$xx]= $training_id[$xx]->id;
            }
            //$trainer_id=$trainer_id[1]->id;
            //dd($idd); 
        }
        //dd($trainer_id);
        
            return view('/reports/viewTrainings',['trainings'=>$training_id]);

            //return redirect("/reports/{['id'=>$idd]}/viewTrainers");
            //return redirect('/reports/{'.$trainer1.'}/viewTrainers',['trid'=>$trainer_id]);
         
           
        
        
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
