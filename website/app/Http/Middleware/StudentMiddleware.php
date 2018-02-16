<?php

namespace App\Http\Middleware;

use App\Models\Activity;
use Closure;

class StudentMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$activity = Activity::select('is_expired')->first();
		if ($activity->is_expired) {
			return redirect('/scut/result');
		}
		if (!$request->session()->has('student_auth')) {
			return redirect('/student/login');
		}
		return $next($request);
	}
}
