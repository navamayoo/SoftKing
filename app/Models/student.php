<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $guarded=[];
    

    

    public function course()
    {
        return $this->belongsToMany(Course::class,'student_courses','student_code','course_code');
    }
}