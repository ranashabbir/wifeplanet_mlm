<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class State
 * @package App\Models
 * @version July 15, 2021, 11:40 am UTC
 *
 * @property string $name
 * @property string $short_code
 * @property integer $country_id
 */
class State extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'states';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'short_code',
        'country_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'short_code' => 'string',
        'country_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:120|unique:states,id',
        'short_code' => 'max:16',
        'country_id' => 'required'
    ];

    /**
     * A State belongs to a country.
     *
     * @return mixed
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
