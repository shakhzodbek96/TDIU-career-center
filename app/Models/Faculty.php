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

    public function groupsList():string
    {
        $list = "";
        foreach ($this->groups as $group) {
            $list .= "$group->name, ";
        }
        return $list;
    }
}
