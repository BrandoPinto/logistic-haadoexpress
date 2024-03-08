<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ResupplyDetail
 * 
 * @property int $idResupplyDetail
 * @property int $height
 * @property int $width
 * @property int $depth
 * @property int $quantity_box
 * @property int $idArticle
 * @property int $quantity_article
 * @property int $fulfillment_state
 * @property int $idResupply
 * 
 * @property Article $article
 * @property Resupply $resupply
 *
 * @package App\Models
 */
class ResupplyDetail extends Model
{
	protected $table = 'resupply_detail';
	protected $primaryKey = 'idResupplyDetail';
	public $timestamps = false;

	protected $casts = [
		'height' => 'int',
		'width' => 'int',
		'depth' => 'int',
		'quantity_box' => 'int',
		'idArticle' => 'int',
		'quantity_article' => 'int',
		'fulfillment_state' => 'int',
		'idResupply' => 'int'
	];

	protected $fillable = [
		'height',
		'width',
		'depth',
		'quantity_box',
		'idArticle',
		'quantity_article',
		'fulfillment_state',
		'idResupply'
	];

	public function article()
	{
		return $this->belongsTo(Article::class, 'idArticle');
	}

	public function resupply()
	{
		return $this->belongsTo(Resupply::class, 'idResupply');
	}
}
