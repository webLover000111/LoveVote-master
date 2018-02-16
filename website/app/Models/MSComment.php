<?php

namespace App\Models;

use App\Models\Memtor;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class MSComment extends Model {
	protected $table = 'memtor_student_comments';
	protected $fillable = [
		'memtor_id', 'student_id', 'is_anonym', 'content',
	];
	protected $hidden = [
		'memtor_id', 'student_id', 'updated_at', 'student', 'memtor',
	];
	public function memtor() {
		return $this->belongsTo(Memtor::class);
	}
	public function student() {
		return $this->belongsTo(Student::class);
	}
}
