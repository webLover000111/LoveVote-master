<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webimage extends Model {
	protected $table = 'webimages';
	protected $fillable = [
		'image_url', 'image_type',
	];
	protected $hidden = [
		'image_type', 'created_at', 'updated_at',
	];
}
