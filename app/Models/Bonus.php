<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bonus extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'bonuses';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'plan_id',
        'commission'
    ];

    /**
     * A bonus belongs to a plan.
     *
     * @return mixed
     */
    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }
}
