<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Boolean;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('code')->unique();
            $table->string('firstName')->nullable();
            $table->string('secondName')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('email')->nullable();
            $table->boolean('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}