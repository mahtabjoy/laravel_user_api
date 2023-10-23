<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session_sites extends Model
{
    use HasFactory;
    protected $table = 'session_sites';

    public function cc(){
        return $this->belongsTo(Cc::class, 'cc','id')->where('status',1);
    }

    public function union(){
        return $this->belongsTo(Union::class, 'unions','id')->where('status',1);
    }

    public function upazila(){
        return $this->belongsTo(Upazila::class, 'upazillas','id')->where('status',1);
    }
}
