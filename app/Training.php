<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use SoftDeletes;
	
	protected $dates=['deleted_at'];
	
	protected $fillable=['course_id','participants_no','training_hours','course_begin_date','course_end_date','expiration_date','sponsored_by','beneficiary','area_id','location','user_id'];
	
	public function User()
	{
		return $this->belongsto('App\User');
	}

	public function area()
    {
        return $this->hasOne('App\Area');
    }



}
?>