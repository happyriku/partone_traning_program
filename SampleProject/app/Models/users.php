<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
	use HasFactory;

	/**
	 * table name
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * Whether the primary key is auto-incrementing
	 *
	 * @var bool
	 */
	public $incrementing = true;

	/**
	 *Primary key type
	 *
	 * @var string
	 */
	protected $keyType = 'int';

	/**
	 * managing timestamps
	 *
	 * @var bool
	 */
	public $timestamps = true;

	/**
	 * attributes that can be registered
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'birthday',
		'sex',
		'address',
		'email',
		'password',
		'status',
		'code_id',
	];

	/**
	 * cast type
	 *
	 * @var array
	 */
	protected $casts = [
		'birthday'=> 'datetime',
		'sex'=> 'boolean',
		'status'=> 'boolean',
	];

	/**
	 * setting default values
	 *
	 * @var array
	 */
	protected $attributes = [
		'status'=> true,
	];

	/**
	 * automatic password hashing
	 *
	 * @param string $value
	 * @return void
	 */
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}
}
