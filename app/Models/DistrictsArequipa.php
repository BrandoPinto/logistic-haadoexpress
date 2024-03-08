<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DistrictsArequipa
 * 
 * @property int $idDistricArequipa
 * @property string $district
 * @property float $tariff
 * 
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class DistrictsArequipa extends Model
{
	protected $table = 'districts_arequipa';
	protected $primaryKey = 'idDistricArequipa';
	public $timestamps = false;

	protected $casts = [
		'tariff' => 'float'
	];

	protected $fillable = [
		'district',
		'tariff'
	];

	public function orders()
	{
		return $this->hasMany(Order::class, 'idDistrict');
	}
}
