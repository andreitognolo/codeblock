<?php namespace integration;

use Illuminate\Support\Facades\Auth;

class TopicControllerTest extends \IntegrationCase {

	public function setUp() {
		parent::setUp();
		$this->setUpDb();
		Auth::loginUsingId(1);
	}

	public function create_topic(){
		$this->create('App\Forum');

		$this->visit('forum/1')
			->submitForm('Create', ['title' => 'test', 'reply' => 'test'])
			->see('Your topic has been saved.');
		return $this;
	}

	public function test_creat_topic(){
		$this->create_topic()->onPage('forum/1');
	}

	public function test_edit_topic(){
		$this->create_topic();

		$this->visit('forum/topic/1')
			->fill('hej', 'title')
			->press('Update topic title')
			->see('hej')
			->see('Your topic has been saved.');
	}

	public function test_delete_topic(){
		$this->create_topic();

		$this->visit('topics/delete/1')
			->see('Your topic has been deleted.');
	}
}