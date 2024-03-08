<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * 
 * @property int $idArticle
 * @property string $description
 * @property int $stock
 * @property int $idUser
 * @property int $fulfillment_state
 * @property int|null $idFulfillment
 * 
 * @property Fulfillment|null $fulfillment
 * @property Collection|Order[] $orders
 * @property Collection|ResupplyDetail[] $resupply_details
 *
 * @package App\Models
 */
class Article extends Model
{
	protected $table = 'articles';
	protected $primaryKey = 'idArticle';
	public $timestamps = false;

	protected $casts = [
		'stock' => 'int',
		'idUser' => 'int',
		'fulfillment_state' => 'int',
		'idFulfillment' => 'int'
	];

	protected $fillable = [
		'description',
		'stock',
		'idUser',
		'fulfillment_state',
		'idFulfillment'
	];

	public function fulfillment()
	{
		return $this->belongsTo(Fulfillment::class, 'idFulfillment');
	}

	public function orders()
	{
		return $this->belongsToMany(Order::class, 'orders_article', 'idArticle', 'idOrders')
					->withPivot('idOrderArticle', 'quantity');
	}

	public function resupply_details()
	{
		return $this->hasMany(ResupplyDetail::class, 'idArticle');
	}
}
