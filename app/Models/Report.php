<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder as BuilderAlias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = ['user_id', 'reported_by'];
}
