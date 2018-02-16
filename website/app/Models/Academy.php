<?php

namespace App\Models;

use App\Models\Memtor;
use Illuminate\Database\Eloquent\Model;

class Academy extends Model {
	protected $table = 'academies';

	protected $fillable = ['name', 'votes_num'];

	protected $hidden = [
		'created_at', 'updated_at',
	];

	public function memtors() {
		return $this->hasMany(Memtor::class, 'academy_id');
	}
}
