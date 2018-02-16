<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivitiesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('activities', function (Blueprint $table) {
			$table->increments('id');
			$table->boolean('is_expired')->default(0)->index();
			$table->string('title');
			$table->date('begin_at');
			$table->date('end_at');
			$table->string('video_url');
			$table->text('video_explain')->nullable()->default(NULL);
			$table->text('introduction');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('activities');
	}
}
