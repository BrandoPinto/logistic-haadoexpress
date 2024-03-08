<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * 
 * @property int $idCity
 * @property string $city
 * @property int $type
 *
 * @package App\Models
 */
class City extends Model
{
	protected $table = 'city';
	protected $primaryKey = 'idCity';
	public $timestamps = false;

	protected $casts = [
		'type' => 'int'
	];

	protected $fillable = [
		'city',
		'type'
	];
}
