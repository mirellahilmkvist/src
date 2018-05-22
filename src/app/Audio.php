<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $guarded = [

    ];

    public function datapoints()
    {
        return $this->belongsToMany(Datapoint::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
