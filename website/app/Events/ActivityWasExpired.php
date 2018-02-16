<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Activity;
use Illuminate\Queue\SerializesModels;

class ActivityWasExpired extends Event {
	use SerializesModels;

	public $activity;
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(Activity $activity) {
		$this->activity = $activity;
	}

	/**
	 * Get the channels the event should be broadcast on.
	 *
	 * @return array
	 */
	public function broadcastOn() {
		return [];
	}
}