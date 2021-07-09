<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Plan
 * @package App\Models
 * @version July 9, 2021, 10:52 am UTC
 *
 * @property string $title
 * @property string $description
 * @property integer $price
 * @property string $type
 * @property string $image
 */
class Plan extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'plans';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'description',
        'price',
        'type',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'price' => 'integer',
        'type' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:25',
        'price' => 'required',
        'type' => 'required'
    ];

    
}
