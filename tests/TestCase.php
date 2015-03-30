<?php

use Illuminate\Support\Facades\Mail;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication() {
		$app = require __DIR__ . '/../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}

	public function setUpDb($seed = true) {
		Artisan::call('migrate');
		Mail::pretend(true);
		if($seed) {
			$this->seed();
		}
	}
}
