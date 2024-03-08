<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubAgency
 * 
 * @property int $idSubAgencies
 * @property string $subagencies
 * @property string $address
 * @property int|null $idAgency
 * 
 * @property Agency|null $agency
 *
 * @package App\Models
 */
class SubAgency extends Model
{
	protected $table = 'sub_agencies';
	protected $primaryKey = 'idSubAgencies';
	public $timestamps = false;

	protected $casts = [
		'idAgency' => 'int'
	];

	protected $fillable = [
		'subagencies',
		'address',
		'idAgency'
	];

	public function agency()
	{
		return $this->belongsTo(Agency::class, 'idAgency');
	}
}
