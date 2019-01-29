<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CourseTerm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_term', function (Blueprint $table) {
            $table->primary(['course_id', 'schedule_id']);
            $table->integer("term_id")->unsigned()->index();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->integer("course_id")->unsigned()->index();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->integer("schedule_id")->unsigned()->index();
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->integer("instructor_id")->unsigned()->index();
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');
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
        Schema::dropIfExists('course_term');
    }
}
