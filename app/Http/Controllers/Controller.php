<?php namespace App\Http\Controllers;

use App\NotificationType;
use App\Repositories\Notification\NotificationRepository;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Log;
use App\Services\PermissionAnnotation;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	protected function mentioned($text, $object, NotificationRepository $notification){
		$users = array();
		preg_match_all('/(^|\s)@(\w+)/', $text, $users);
		foreach($users as $username) {
			if(count($username) >= 1) {
				$username = $username[0];
				if(!$notification->send($username, NotificationType::MENTION, $object)){
					$errors = array(
						'username' => $username,
						'type' => NotificationType::MENTION,
						'errors' => $notification->errors
					);
					Log::error(json_encode($errors));
				}
			}
		}
	}

	protected function getPermission($method){
		$method = explode('::', $method);
		$permissionAnnotation = New PermissionAnnotation($method[0], $method[1]);
		return $permissionAnnotation->getPermission();
	}

}
