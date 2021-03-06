<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;
	
	protected $dates=['deleted_at'];
	
	protected $fillable=['name'];

    public function training()
    {
        return $this->hasOne('App\Training');
    }

}
