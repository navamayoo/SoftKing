<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $guarded=[];

  public function student()
    {
        return $this->belongsToMany(Student::class,'student_courses','course_code','student_code');
    }
}