<?php

namespace App\Models;

use App\Models\Memtor;
use App\Models\MSComment;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {
	protected $table = 'students';
	protected $fillable = [
		'student_num', 'password', 'name', 'has_voted',
	];
	protected $hidden = [
		'password', 'created_at', 'updated_at',
	];
	public function memVotes() {
		return $this->belongsToMany(Memtor::class, 'memtor_student_votes');
	}
	public function memComments() {
		return $this->belongsToMany(Memtor::class, 'memtor_student_comments')->withPivot('is_anonym', 'content');
	}
	public function comments() {
		return $this->hasMany(MSComment::class);
	}
}
