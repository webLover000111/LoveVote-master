<?php

namespace App\Models;

use App\Models\Academy;
use App\Models\MSComment;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Memtor extends Model {
	protected $table = 'memtors';
	protected $fillable = [
		'academy_id', 'votes_num', 'name', 'gender', 'job_title',
		'photo_url', 'introduction', 'recommend', 'short_comment',
	];
	protected $hidden = [
		'academy_id', 'created_at', 'updated_at', 'academy',
	];
	// public function getPhotoUrlAttribute($value) {
	// 	return url($value);
	// }
	public function academy() {
		return $this->belongsTo(Academy::class, 'academy_id');
	}
	public function stuVotes() {
		return $this->belongsToMany(Student::class, 'memtor_student_votes');
	}
	public function stuComments() {
		return $this->belongsToMany(Student::class, 'memtor_student_comments')->withPivot('is_anonym', 'content')->withTimestamps();
	}
	public function comments() {
		return $this->hasMany(MSComment::class);
	}
}
