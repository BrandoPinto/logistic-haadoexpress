<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MethodPayment
 * 
 * @property int $idMethod
 * @property string $method
 * 
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class MethodPayment extends Model
{
	protected $table = 'method_payment';
	protected $primaryKey = 'idMethod';
	public $timestamps = false;

	protected $fillable = [
		'method'
	];

	public function orders()
	{
		return $this->hasMany(Order::class, 'idMethod');
	}
}
