<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;
    protected $table = 'unions';

    public function cc(){
        return $this->hasMany(Cc::class,'unions','id')->where('status',1);
    }

    public function sessions(){
        return $this->hasMany(Session_sites::class,'unions','id');
    }

    public function upazila(){
        return $this->belongsTo(Upazila::class)->where('status',1);
    }

}
