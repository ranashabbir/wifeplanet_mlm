<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Junaidnasir\Larainvite\Models\LaraInviteModel;

class Invitation extends LaraInviteModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_invitations';
    
    /**
     * Referral User
     */
    public function user()
    {
        return $this->belongsTo(config('larainvite.UserModel'));
    }
}
