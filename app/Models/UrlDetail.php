<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlDetail extends Model
{
    protected $guarded = ['id'];

    protected $touches = ['url'];

    protected $casts = [
        'params' => 'array'
    ];

    public function url() {
        return $this->belongsTo(Url::class);
    }
}
