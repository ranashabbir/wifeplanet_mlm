<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class City
 * @package App\Models
 * @version July 15, 2021, 11:44 am UTC
 *
 * @property string $name
 * @property integer $state_id
 * @property integer $country_id
 */
class City extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'cities';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'state_id',
        'country_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'state_id' => 'integer',
        'country_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:120',
        'country_id' => 'required'
    ];

    /**
     * A City belongs to a state.
     *
     * @return mixed
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
