<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'replies';

	protected $fillable = array('reply', 'topic_id', 'user_id');

	protected $guarded = array('id');

	public static $rules = array(
		'reply'  => 'required|min:3',
		'topic_id' => 'required|integer',
		'user_id' => 'required|integer',
	);

	public function user(){
		return $this->belongsTo( 'App\User', 'user_id' );
	}
}
