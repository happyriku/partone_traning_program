<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthCode extends Model
{
    use HasFactory;

    /**
     * table name
     *
     * @var string
     */
    protected $table = 'auth_codes';

    /**
     * Whether the code_id is auto-incrementing
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * code_id key type
     *
     * @var string
     */
    protected $KeyType = 'int';

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
	    'user_id',
	    'code',
	    'email',
	    'expires_at',
	    'status',
    ];

    /**
     * default value
     *
     * @var array
     */
    protected $attributes = [
        'status' => false,
    ];
}
