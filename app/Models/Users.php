<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
  protected $table = 'users';
    protected $fillable = ['name', 'email', 'phone_no', 'address'];

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id_fk');
    }
  public function designations() {
        return $this->belongsToMany(Designation::class);
    }
}
