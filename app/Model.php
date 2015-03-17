<?php namespace App;

use Illuminate\Support\Facades\Validator;

class Model extends \Illuminate\Database\Eloquent\Model {

	public static $errors;

	public static function boot()
	{
		parent::boot();
		// körs på alla modell object som sparas.
		static::saving(function($object){
			return $object::isValid($object);
		});
	}

	// validerings metoden som kör rule variablen från alla modeller när det modell objektet sparas.
	public static function isValid($data)
	{
		$id = null;
		if(is_object($data)){
			$data = $data->toArray();
			if(isset($data['id'])){
				$id = $data['id'];
			}
		}

		if(is_numeric($id)){
			// found on: http://forumsarchive.laravel.io/viewtopic.php?pid=46571
			array_walk(static::$rules, function(&$item) use ($id)
			{
				if(stripos($item, ':id:') !== false){
					$item = str_ireplace(':id:', $id, $item);
				}
			});
		}

		$v = Validator::make($data, static::$rules);
		if ($v->passes()) {
			return true;
		}else{
			static::$errors = $v->messages();
			return false;
		}
	}
}