<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseInstructorTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_instructor_term', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("term_id")->unsigned()->index();
            $table->integer("course_id")->unsigned()->index();
            $table->integer("instructor_id")->unsigned()->index();
            $table->integer("schedule_id")->unsigned()->index();
            $table->integer("course_term_id")->unsigned()->index();
            $table->integer("instructor_term_id")->unsigned()->index();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');
            $table->unique(['instructor_id', 'schedule_id']);
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
        Schema::dropIfExists('course_instructor_terms');
    }
}
