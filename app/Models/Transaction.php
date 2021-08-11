<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'transactions';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'amount',
        'from',
        'type',
        'payment_method',
        'details',
        'status'
    ];

    /**
     * @return hasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return hasOne
     */
    public function from()
    {
        return $this->belongsTo(User::class, 'id', 'from');
    }
}
