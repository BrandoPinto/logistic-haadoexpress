<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class District
 * 
 * @property int $idDistrict
 * @property string $district
 * @property float $tariff
 * @property int $type
 * @property int|null $idCity
 * 
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class District extends Model
{
	protected $table = 'districts';
	protected $primaryKey = 'idDistrict';
	public $timestamps = false;

	protected $casts = [
		'tariff' => 'float',
		'type' => 'int',
		'idCity' => 'int'
	];

	protected $fillable = [
		'district',
		'tariff',
		'type',
		'idCity'
	];

	public function orders()
	{
		return $this->hasMany(Order::class, 'idDistrict');
	}
}
