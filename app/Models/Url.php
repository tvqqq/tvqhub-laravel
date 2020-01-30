<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $guarded = ['id'];

    public function url_details() {
        return $this->hasMany(UrlDetail::class);
    }
}
