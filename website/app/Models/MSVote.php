<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MSVote extends Model {
	protected $table = 'memtor_student_votes';
	protected $fillable = [
		'memtor_id', 'student_id',
	];
	protected $hidden = [
		'created_at', 'updated_at',
	];
}
