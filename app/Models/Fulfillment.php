<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fulfillment
 * 
 * @property int $idFulfillment
 * @property string $fulfillment
 * @property float $amount
 * 
 * @property Collection|Article[] $articles
 *
 * @package App\Models
 */
class Fulfillment extends Model
{
	protected $table = 'fulfillment';
	protected $primaryKey = 'idFulfillment';
	public $timestamps = false;

	protected $casts = [
		'amount' => 'float'
	];

	protected $fillable = [
		'fulfillment',
		'amount'
	];

	public function articles()
	{
		return $this->hasMany(Article::class, 'idFulfillment');
	}
}
