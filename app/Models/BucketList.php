<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BucketList extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['last_updated'];

    public function getLastUpdatedAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }
}
