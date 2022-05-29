<?php




namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Trainer;
use App\Trainee;
use App\Course;
use App\Training;

use Session;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$courses = App\Course::all();
        //$courses=Course::all();

    

        return view('courses.index', ['courses'=>Course::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       /*  $roles=Role::all();
		if($roles->count()==0){
			Session::flash('Success', 'you must have at least 1 role created before attempting to create an employee');
			return redirect()->back();
		} */
        return view('courses.create');//->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
			'name_ar' => 'required|max:190',
			//'dob' => 'required|email',
            'name_ar' => 'required|max:190',
		
		]);
		
		$courses = Course::create([
			'name_ar' => $request->name_ar,
			'name_en' => $request->name_en,
            'hours' => $request->hours,
            'user_id' => Auth::id(),
		]);
		
		/* $payroll = new Payroll;
		$payroll->employee_id = $employee->id;
		$payroll->save(); */
		$courses->save();
		
		
		$request->session()->flash('status', 'New Course created');
		return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        $Numberoftrainings=DB::select('select count(*) as cc from trainings where course_id =?', [$id]);
        // $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
         //dd($Numberoftrainings[0]->cc);
         $Numberoftrainings=$Numberoftrainings[0]->cc;

         $Coursesinfo=DB::select("select courses.name_ar,trainings.participants_no,trainings.expiration_date,trainings.location,trainings.course_begin_date from trainings,courses where courses.id=trainings.course_id and trainings.course_id=".$id);
        


        return view('courses.show',['courses'=>Course::findOrFail($id),'countTr'=>$Numberoftrainings,'Coursesinfo'=>$Coursesinfo]);
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('courses.edit', ['courses'=>Course::find($id)/* ,
											'roles'=>Role::all() */]);
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
        $courses=Course::findOrFail($id);
		$this->validate($request,[
            'name_ar' => 'required|max:190',
			'name_en' => 'required|max:190',
            'hours' => 'required|max:10'
		]);
        $courses->name_ar = $request->name_ar;
        $courses->name_en = $request->name_en;
        $courses->hours = $request->hours;
   
	
		$courses->save();
		
		$request->session()->flash('status', 'Course records have been updated !');
		return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy(Request $request,$id)
    {
        $courses=Course::findOrFail($id);
		$courses->delete();
		$request->session()->flash('status', 'Course Deleted !!');
		//session()->flash('success','trainees deleted');
		return redirect()->route('courses.index');
    }
	
	public function bin(){
		$courses=Course::onlyTrashed()->get();
		return view('courses.bin')->with('courses', $courses);
	}
	
	public function restore($id){
		$courses=Course::withTrashed()->where('id', $id)->first();
		$courses->restore();
		
		Session::flash('success', 'The Trainee user account is restored.');
		return redirect()->route('trainees.index');
	}
	
	public function kill($id){
		$trainees=Trainee::withTrashed()->where('id', $id)->first();
	/* 	foreach($employee->payrolls as $payroll):
			$payroll->delete();
		endforeach; */
		
		$trainees->forceDelete();
		
		Session::flash('success', 'The Trainee account has been permanently destroyed.');
		return redirect()->route('Trainee.index');
	}
}
