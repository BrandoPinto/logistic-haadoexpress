<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdersType
 * 
 * @property int $idOrdersType
 * @property string $type
 *
 * @package App\Models
 */
class OrdersType extends Model
{
	protected $table = 'orders_type';
	protected $primaryKey = 'idOrdersType';
	public $timestamps = false;

	protected $fillable = [
		'type'
	];
}
