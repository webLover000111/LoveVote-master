<?php

namespace App\Listeners;

use App\Models\Activity;

class ActivityEventListener {
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	public function onActivityExpired($event) {
		$activity = $event->activity;
		Activity::where('id', $activity->id)->update(['is_expired' => 1]);
	}
	/**
	 * 为订阅者注册监听器
	 *
	 * @param  Illuminate\Events\Dispatcher  $events
	 * @return array
	 */
	public function subscribe($events) {
		$events->listen(
			'App\Events\ActivityWasExpired',
			'App\Listeners\ActivityEventListener@onActivityExpired'
		);
	}

}
