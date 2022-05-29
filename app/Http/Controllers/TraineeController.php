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


class TraineeController extends Controller
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

       
        $role_id=DB::select('select role_id from users where id=?',[Auth::id()]);
        $role_id=$role_id[0]->role_id;
        //$courseName=DB::select('select courses.name_ar from courses');
        if ($role_id==3)
        {
            $user=auth()->user();
            $trainees=$user->trainees;
          
            return view('trainees.index',['trainees' => $trainees,'role_id'=>$role_id]);


        }elseif($role_id==2)
        {
            $user=auth()->user();

            $area_id=DB::select('select areas.id from areas,users where users.area_id=areas.id and users.id=?',[Auth::id()]);
            $area_id=$area_id[0]->id;
           //dd($area_id);
            
            $trainees=DB::select('select trainees.* from areas,trainees where trainees.area_id=areas.id and areas.id='.$area_id.' order by trainees.id desc ');
            
            return view('trainees.index',['trainees' => $trainees,'role_id'=>$role_id]);
    
        }else
        {
                return view('trainees.index',['trainees'=>Trainee::paginate(5),'role_id'=>$role_id]);
                //dd($trainings ."". $trainingsCount);
        }
        //return view('trainees.index', ['trainees'=>Trainee::paginate(5)]);
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
        return view('trainees.create');//->with('roles',$roles);
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
			'name' => 'required|max:190',
			//'dob' => 'required|email',
            'dob' => 'required',
			'identification_no' => 'required|max:9',
            'area_id'=>'required',
			'address' => 'required',
			'gender' => 'required',
			'phone_no' => 'required',
			//'major' => 'required|bool',
            'major' => 'required',
			'email' => 'required'
		]);
		
        $areas_id=DB::select('select id from areas where name =?', [$request->area_id]);
       
         //dd($courses_id[0]->id);
         $areass_id=$areas_id[0]->id;

		$trainees = Trainee::create([
			'name' => $request->name,
			'dob' => $request->dob,
			'identification_no' => $request->identification_no,
            'area_id'=> $areass_id,
			'address' => $request->address,
			'gender' => $request->gender,
			'phone_no' => $request->phone_no,
			'major' => $request->major,
			'email' => $request->email,
            'user_id' => Auth::id(),
		]);
		
		/* $payroll = new Payroll;
		$payroll->employee_id = $employee->id;
		$payroll->save(); */
		$trainees->save();
		
		
		$request->session()->flash('status', 'New Trainee created');
		return redirect()->route('trainees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Numberoftrainings=DB::select('select count(*) as cc from courses_trainees where trainee_id =?', [$id]);
        // $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
         //dd($Numberoftrainings[0]->cc);
         $Numberoftrainings=$Numberoftrainings[0]->cc;

         $TraineesCoursesinfo=DB::select("select courses.id,courses.name_ar,trainings.participants_no,trainings.course_begin_date,trainings.course_end_date,trainings.expiration_date,trainings.sponsored_by,trainings.beneficiary,trainings.location from trainings,courses_trainees,courses where courses.id=trainings.course_id and trainings.id=courses_trainees.training_id and courses_trainees.trainee_id=".$id);
        


        return view('trainees.show',['trainees'=>Trainee::findOrFail($id),'countTr'=>$Numberoftrainings,'TraineesCoursesinfo'=>$TraineesCoursesinfo]);
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('trainees.edit', ['trainees'=>Trainee::find($id)/* ,
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
        $trainees=Trainee::findOrFail($id);
		$this->validate($request,[
            'name' => 'required|max:190',
			'dob' => 'required',
			'identification_no' => 'required|max:9',
			'address' => 'required',
			'gender' => 'required',
			'phone_no' => 'required',
			'major' => 'required',
			'email' => 'required'
		]);
        $trainees->name = $request->name;
        $trainees->dob = $request->dob;
        $trainees->identification_no = $request->identification_no;
        $trainees->address = $request->address;
        $trainees->gender = $request->gender;
        $trainees->phone_no = $request->phone_no;
        $trainees->major = $request->major;
        $trainees->email = $request->email;
	
		$trainees->save();
		
		$request->session()->flash('status', 'Trainee records has been updated !');
		return redirect()->route('trainees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy(Request $request,$id)
    {
        $trainees=Trainee::findOrFail($id);
		$trainees->delete();
		$request->session()->flash('status', 'Trainee Deleted !!');
		//session()->flash('success','trainees deleted');
		return redirect()->route('trainees.index');
    }
	
	public function bin(){
		$trainees=Trainee::onlyTrashed()->get();
		return view('trainees.bin')->with('trainees', $trainees);
	}
	
	public function restore($id){
		$trainees=Trainee::withTrashed()->where('id', $id)->first();
		$trainees->restore();
		
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
