<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class courses_trainers extends Model
{
    use SoftDeletes;
	
	protected $dates=['deleted_at'];
	
	protected $fillable=['course_id','trainer_id','training_id'];
	
	/* public $with = ['role','payrolls'];*/
    

}
