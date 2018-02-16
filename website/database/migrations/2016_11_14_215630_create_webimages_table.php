<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWebimagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('webimages', function (Blueprint $table) {
			$table->increments('id');
			$table->string('image_url');
			$table->integer('tt_order')->unsigned()->unique();
			$table->enum('image_type', ['bg', 'tt'])->index();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('webimages');
	}
}
