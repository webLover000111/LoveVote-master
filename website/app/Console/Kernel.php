<?php

namespace App\Console;

use App\Events\ActivityWasExpired;
use App\Models\Activity;
use Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		\App\Console\Commands\Inspire::class,
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule) {
		$schedule->command('inspire')->hourly();
		//定时检查投票活动是否过期
		$schedule->call(function () {
			echo "hello world";
			$activity = Activity::first();
			$end_at = $activity->end_at;
			if (date('Y-m-d') > $end_at) {
				Event::fire(new ActivityWasExpired($activity));
			}
		})->dailyAt('00:01');
	}
}
