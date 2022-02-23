<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('code')->unique();
             $table->bigInteger('student_code')->nullable();
              $table->bigInteger('course_code')->nullable();
            $table->timestamps();

            
            $table->
            foreign("student_code")->
            references("code")->
            on("students")->
            onDelete("cascade");
            
            $table->
            foreign("course_code")->
            references("code")->
            on("courses")->
            onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_courses');
    }
}