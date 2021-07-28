<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'subscriptions';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'plan_id',
        'price',
        'status'
    ];

    /**
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Plan Bonus Relationships.
     *
     * @var array
     */
    public function plan()
    {
        return $this->hasOne(Plan::class, 'id', 'plan_id');
    }
}
