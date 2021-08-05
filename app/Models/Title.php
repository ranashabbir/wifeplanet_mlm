<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder as BuilderAlias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Title extends Model
{
    protected $table = 'titles';

    protected $fillable = ['name', 'description', 'total_invites', 'type'];
}
