<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {
	protected $table = 'activities';
	protected $fillable = [
		'begin_at', 'end_at', 'video_url',
		'video_explain', 'introduction',
	];
	protected $hidden = [
		'created_at', 'updated_at',
	];
	// public function getVideoUrlAttribute($value) {
	// 	return url($value);
	// }
}
