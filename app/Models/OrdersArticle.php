<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdersArticle
 * 
 * @property int $idOrderArticle
 * @property int $idArticle
 * @property int $quantity
 * @property int $idOrders
 * 
 * @property Article $article
 * @property Order $order
 *
 * @package App\Models
 */
class OrdersArticle extends Model
{
	protected $table = 'orders_article';
	protected $primaryKey = 'idOrderArticle';
	public $timestamps = false;

	protected $casts = [
		'idArticle' => 'int',
		'quantity' => 'int',
		'idOrders' => 'int'
	];

	protected $fillable = [
		'idArticle',
		'quantity',
		'idOrders'
	];

	public function article()
	{
		return $this->belongsTo(Article::class, 'idArticle');
	}

	public function order()
	{
		return $this->belongsTo(Order::class, 'idOrders');
	}
}
