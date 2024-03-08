<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Agency
 * 
 * @property int $idAgency
 * @property string $agency
 * @property string|null $more_information
 * 
 * @property Collection|SubAgency[] $sub_agencies
 *
 * @package App\Models
 */
class Agency extends Model
{
	protected $table = 'agencies';
	protected $primaryKey = 'idAgency';
	public $timestamps = false;

	protected $fillable = [
		'agency',
		'more_information'
	];

	public function sub_agencies()
	{
		return $this->hasMany(SubAgency::class, 'idAgency');
	}
}
