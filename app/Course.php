<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
	
	protected $dates=['deleted_at'];
	
	protected $fillable=['name_ar','name_en','hours','user_id'];
	
	/* public $with = ['role','payrolls'];
	
	public function role(){
		return $this->belongsTo('App\Role');
	}
	
	public function payrolls(){
		return $this->hasMany('App\Payroll');
	} */
	
}
