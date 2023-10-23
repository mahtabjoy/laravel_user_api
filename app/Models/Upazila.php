<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use HasFactory;
    protected $table = 'upazilas';

    public function unions(){
        return $this->hasMany(Union::class,'upazillas','id')->where('status',1);
    }

    public function cc(){
        return $this->hasMany(Cc::class,'upazillas','id')->where('status',1);
    }

    public function sessions(){
        return $this->hasMany(Session_sites::class,'upazillas','id');
    }

    public function upazilaUnionSessionSiteCCInformation()
    {
        return Upazila::with(
            [

                'session_site_list' => function ($q) {
                    $q->select('id', 'name', 'name_bn', 'csg_no', 'ca', 'cc', 'unions', 'upazilla', 'lat', 'lng');
                    $q->with(
                        [
                            'cc' => function ($q2) {
                                $q2->select('id', 'name', 'name_bn', 'unions', 'upazilla', 'lat', 'lng', 'workstation');
                                $q2->with(
                                    [
                                        'union' => function ($q2) {
                                            $q2->select('id', 'name', 'name_bn');
                                        },
                                        'upazilla' => function ($q2) {
                                            $q2->select('id', 'name', 'name_bn');
                                        }
                                    ]
                                );

                            },

                            'union' => function ($q2) {
                                $q2->select('id', 'name', 'name_bn');
                            },
                            'upazilla' => function ($q2) {
                                $q2->select('id', 'name', 'name_bn');
                            },
                        ]
                    );
                    $q->orderBy('name', 'asc');
                },

            ]);
    }
}
