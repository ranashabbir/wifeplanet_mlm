<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'location',
        'gender',
        'age',
        'height',
        'weight',
        'relationship',
        'hair',
        'occupation',
        'body_type',
        'interests',
        'children',
        'sports',
        'personality',
        'nationality',
        'religion',
        'smoking',
        'city_id',
        'state_id',
        'country_id',
        'avatar',
        'verify_photo',
    ];

    /**
     * A profile belongs to a user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
