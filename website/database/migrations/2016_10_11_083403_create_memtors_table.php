<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemtorsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('memtors', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('academy_id')->unsigned()->index();
			$table->integer('votes_num')->unsigned()->default(0);
			$table->string('name', 32);
			$table->enum('gender', ['男', '女']);
			$table->string('job_title');
			$table->string('photo_url');
			$table->text('introduction');
			$table->text('recommend');
			$table->string('short_comment');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('memtors');
	}
}
