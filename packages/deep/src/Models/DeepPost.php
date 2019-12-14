<?php

namespace Deep\Models;

use Illuminate\Database\Eloquent\Model;

class DeepPost extends Model
{
    protected $table = 'deep_posts';

    protected $guarded = ['id'];
}
