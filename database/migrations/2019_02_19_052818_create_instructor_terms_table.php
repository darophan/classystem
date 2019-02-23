<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_term', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("term_id")->unsigned()->index();
            $table->integer("instructor_id")->unsigned()->index();
            $table->integer("schedule_id")->unsigned()->index();
            $table->integer("course_id")->unsigned()->index();
            $table->boolean("is_taken")->default(0);
            $table->integer("priority")->default(0);
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');
            // $table->unique(['instructor_id', 'schedule_id']);
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
        Schema::dropIfExists('instructor_terms');
    }
}
