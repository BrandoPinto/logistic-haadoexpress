<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $idOrders
 * @property string $code
 * @property string $name
 * @property string|null $cellphone
 * @property int|null $dni
 * @property string|null $email
 * @property string|null $address
 * @property string|null $reference
 * @property int|null $idDistrict
 * @property Carbon $date_order
 * @property Carbon|null $date_delivery
 * @property int|null $idMethod
 * @property float|null $amount
 * @property int $idUser
 * @property string|null $observation
 * @property Carbon|null $real_date
 * @property int $state
 * @property int $idOrdersType
 * @property int|null $idDelivery
 * @property int|null $notify_state
 * 
 * @property District|null $district
 * @property MethodPayment|null $method_payment
 * @property Collection|Article[] $articles
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';
	protected $primaryKey = 'idOrders';
	public $timestamps = false;

	protected $casts = [
		'dni' => 'int',
		'idDistrict' => 'int',
		'date_order' => 'datetime',
		'date_delivery' => 'datetime',
		'idMethod' => 'int',
		'amount' => 'float',
		'idUser' => 'int',
		'real_date' => 'datetime',
		'state' => 'int',
		'idOrdersType' => 'int',
		'idDelivery' => 'int',
		'notify_state' => 'int'
	];

	protected $fillable = [
		'code',
		'name',
		'cellphone',
		'dni',
		'email',
		'address',
		'reference',
		'idDistrict',
		'date_order',
		'date_delivery',
		'idMethod',
		'amount',
		'idUser',
		'observation',
		'real_date',
		'state',
		'idOrdersType',
		'idDelivery',
		'notify_state'
	];

	public function district()
	{
		return $this->belongsTo(District::class, 'idDistrict');
	}

	public function method_payment()
	{
		return $this->belongsTo(MethodPayment::class, 'idMethod');
	}

	public function articles()
	{
		return $this->belongsToMany(Article::class, 'orders_article', 'idOrders', 'idArticle')
					->withPivot('idOrderArticle', 'quantity');
	}
}
