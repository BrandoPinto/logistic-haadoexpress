<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Email
 * 
 * @property int $idEmail
 * @property string $email
 * @property string $password
 * @property int $type_email
 * @property int $idUser
 *
 * @package App\Models
 */
class Email extends Model
{
	protected $table = 'emails';
	protected $primaryKey = 'idEmail';
	public $timestamps = false;

	protected $casts = [
		'type_email' => 'int',
		'idUser' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'email',
		'password',
		'type_email',
		'idUser'
	];
}
