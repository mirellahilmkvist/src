<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nextpoint extends Model
{
    protected $guarded = [

    ];

    public function nextDatapoints()
    {
        return $this->hasManyThrough(Datapoint::class, 'datapoint_nextpoint');
    }

    public function datapoint()
    {
        return $this->belongsTo(Datapoint::class);
    }
}
