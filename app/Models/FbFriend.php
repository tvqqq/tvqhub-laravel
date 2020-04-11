<?php

namespace App\Models;

use App\Traits\FullTextSearch;
use Illuminate\Database\Eloquent\Model;

class FbFriend extends Model
{
    use FullTextSearch;

    protected $guarded = ['id'];
}
