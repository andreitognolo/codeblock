<?php namespace App\Repositories\Role;

use App\Role;
use App\Repositories\CRepository;

class EloquentRoleRepository extends CRepository implements RoleRepository {

	// hämtar alla roller.
	public function get($id = null)
	{
		return Role::orderBy('grade')->get();
	}

	// skapar en roll.
	public function createOrUpdate($input, $id = null)
	{
		$Role = new Role;

		if(isset($input['name'])){
			$Role->name = $this->stripTrim($input['name']);
		}
		$Role->grade = count(Role::all()) + 1;

		if($Role->save()){
			return true;
		}else{
			$this->errors = Role::$errors;
			return false;
		}
	}

	// uppdaterar en roll.
	public function update($input){
		$roles = Role::orderBy('grade')->get();
		$grade = $this->stripTrim($input['grade']);
		$i = 0;

		if(count($roles) == count(array_unique($grade))){
			foreach ($roles as $role) {
				$role->grade = $grade[$i];
				$role->name = $this->stripTrim($input['name'][$i]);
				if(!$role->save()){
					return false;
				}
				$i++;
			}
			return true;
		}else{
			return false;
		}
	}

	// tar bort en roll
	public function delete($id){
		$Role = Role::find($id);
		if($Role == null){
			return false;
		}
		$Role->permissions()->detach();
		return $Role->delete();
	}

	// hämtar rollerna och kopplar samman dessa med tillhörande rättigheter.
	public function editRolePermission($permissions)
	{

		$roles = $this->get();
		$permissions = $permissions->toArray();
		usort($permissions, function($a, $b) { return strcmp($a['name'],$b['name']); });

		$roles_array = array();
		foreach ($roles as $role) {

			$role_permissions = array();
			foreach ($role->permissions as $permission) {
				$role_permissions[] = $permission->permission;
			}

			$roles_array[$role->name] = array();
			foreach ($permissions as $permission ) {
				$roles_array[$role->name][$permission['permission']] = false;
				if(in_array($permission['permission'], $role_permissions)){
					$roles_array[$role->name][$permission['permission']] = true;
				}
			}

		}

		return $roles_array;
	}

	// uppdaterar kopplingen mellan en roll och rättighet.
	public function updateRolePermission($input)
	{
		foreach ($this->get() as $role) {
			$roleName = str_replace(' ', '', $role->name);
			if(array_key_exists($roleName, $input)){
				$permission_array = $this->stripTrim($input[$roleName]);
				if(!is_array($permission_array)){
					$permission_array = array();
				}
				if(!$role->permissions()->sync($permission_array)){
					return false;
				}
			}
		}
		return true;
	}



}