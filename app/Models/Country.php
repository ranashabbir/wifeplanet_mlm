<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Country
 * @package App\Models
 * @version July 15, 2021, 11:35 am UTC
 *
 * @property string $name
 * @property string $code
 * @property string $short_code
 * @property string $time_zone
 */
class Country extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'countries';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'code',
        'short_code',
        // 'time_zone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'code' => 'string',
        'short_code' => 'string',
        // 'time_zone' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:120|unique:countries',
        'code' => 'max:60',
        'short_code' => 'max:30',
        // 'time_zone' => 'max:30'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states()
    {
        return $this->hasMany(State::class);
    }

    /**
     * Get the state's country.
     */
    public function stateCity()
    {
        return $this->hasOneThrough(City::class, State::class);
    }
}
