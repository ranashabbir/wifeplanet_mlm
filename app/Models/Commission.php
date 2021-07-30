<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'commissions';
    
    /**
     * @return hasOne
     */
    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
    public function receiver()
    {
        return $this->hasMany(User::class, 'id', 'receiver_id');
    }
}
