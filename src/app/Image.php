<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $guarded = [

    ];

    public function datapoints()
    {
        return $this->belongsToMany(Datapoint::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}