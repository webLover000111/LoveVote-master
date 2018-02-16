<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {
	/**
	 * The URIs that should be excluded from CSRF verification.
	 *
	 * @var array
	 */
	protected $except = [
		'/admin/login',
		'/memtor/store',
		'/memtor/*/update',
		'/memtor/*/delete',
		'/activity/update',
		'/comment/delete',
		'/webimage/bg',
		'/webimage/tt',
		'/webimage/pre',
	];
}
