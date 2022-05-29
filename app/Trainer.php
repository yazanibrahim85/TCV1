<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trainer extends Model
{
    use SoftDeletes;
	
	protected $dates=['deleted_at'];
	
	protected $fillable=['name','area_id','address','phone_no','major','email','user_id'];
	
	public function User()
	{
		return $this->belongsto('App\User');
	}

}
?>