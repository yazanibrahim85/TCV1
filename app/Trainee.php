<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trainee extends Model
{
    use SoftDeletes;
	
	protected $dates=['deleted_at'];
	
	protected $fillable=['name','dob','identification_no','area_id','address','gender',
		'phone_no','major','email','user_id'];
	
	/* public $with = ['role','payrolls'];
	
	public function role(){
		return $this->belongsTo('App\Role');
	}
	
	public function payrolls(){
		return $this->hasMany('App\Payroll');
	} */
	
	public function User()
	{
		return $this->belongsto('App\User');
	}
	
}
