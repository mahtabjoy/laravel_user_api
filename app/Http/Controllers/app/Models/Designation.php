<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $table = 'designation_table';
    protected $fillable = ['name'];

    public function users() {
        return $this->hasMany(Users::class, 'designation_id_fk');
    }
}
