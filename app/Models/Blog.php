<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Blog
 * 
 * @property int $idBlog
 * @property string $image
 * @property int $state
 *
 * @package App\Models
 */
class Blog extends Model
{
	protected $table = 'blog';
	protected $primaryKey = 'idBlog';
	public $timestamps = false;

	protected $casts = [
		'state' => 'int'
	];

	protected $fillable = [
		'image',
		'state'
	];
}
