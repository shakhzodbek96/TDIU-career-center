<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'faculty_id',
        'begin',
        'end',
        'students_count',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function studyYears():string
    {
        return ($this->begin ?? '').' / '.($this->end ?? '');
    }
}
