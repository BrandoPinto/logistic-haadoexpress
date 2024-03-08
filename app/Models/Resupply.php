<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Resupply
 * 
 * @property int $idResupply
 * @property Carbon $date
 * @property string $agency
 * @property string $document
 * @property string|null $comments
 * @property int $state
 * @property int $idUser
 * 
 * @property Collection|ResupplyDetail[] $resupply_details
 *
 * @package App\Models
 */
class Resupply extends Model
{
	protected $table = 'resupply';
	protected $primaryKey = 'idResupply';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'state' => 'int',
		'idUser' => 'int'
	];

	protected $fillable = [
		'date',
		'agency',
		'document',
		'comments',
		'state',
		'idUser'
	];

	public function resupply_details()
	{
		return $this->hasMany(ResupplyDetail::class, 'idResupply');
	}
}
