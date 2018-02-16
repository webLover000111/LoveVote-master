<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemtorStudentVotesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('memtor_student_votes', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('memtor_id')->unsigned()->index();
			$table->integer('student_id')->unsigned()->index();
			$table->foreign('memtor_id')->references('id')->on('memtors')->onDelete('cascade');
			$table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('memtor_student_votes');
	}
}
