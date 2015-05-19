<?php namespace App\Repositories\Forum;

use App\Forum;
use App\Repositories\CRepository;

class EloquentForumRepository extends CRepository implements ForumRepository {

	// hämtar en eller alla forum.
	public function get($id = null)
	{
		if(is_null($id)){
			return Forum::all();
		}else{
			return Forum::find($id);
		}
	}

	// skapar och uppdaterar en forum.
	public function createOrUpdate($input, $id = null)
	{
		if(!is_numeric($id)) {
			$Forum = new Forum;
		} else {
			$Forum = Forum::find($id);
		}

		if(isset($input['title'])){
			$Forum->title = $this->stripTrim($input['title']);
		}

		if(isset($input['description'])){
			$Forum->description = $this->stripTrim($input['description']);
		}

		if($Forum->save()){
			return true;
		}else{
			$this->errors = $Forum::$errors;
			return false;
		}
	}

	// tar bort en forum.
	public function delete($id){
		$Forum = Forum::find($id);
		if($Forum == null){
			return false;
		}
		return $Forum->delete();
	}

}