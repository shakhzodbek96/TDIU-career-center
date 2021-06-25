<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'birth_date',
        'phone',
        'group_id',
        'faculty_id',
        'status_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
