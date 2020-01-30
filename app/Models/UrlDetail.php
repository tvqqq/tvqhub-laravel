<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlDetail extends Model
{
    protected $guarded = ['id'];

    public function url() {
        return $this->hasOne(Url::class);
    }
}
