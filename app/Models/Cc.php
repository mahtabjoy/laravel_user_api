<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cc extends Model
{
    use HasFactory;
    protected $table = 'ccs';

    public function upazila(){
        return $this->belongsTo(Upazila::class, 'upazillas','id')->where('status',1);
    }

    public function union(){
        return $this->belongsTo(Union::class, 'unions','id')->where('status',1);
    }

    public function sessions(){
        return $this->hasMany(Session_sites::class,'cc','id');
    }
}
