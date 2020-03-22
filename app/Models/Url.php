<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $guarded = ['id'];

    public function url_details() {
        return $this->hasMany(UrlDetail::class);
    }
}
