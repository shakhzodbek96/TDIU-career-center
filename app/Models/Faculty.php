<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name'];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
