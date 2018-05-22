<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Datapoint
 * @package App
 */
class Datapoint extends Model
{
    /**
     * @var array
     */
    protected $guarded = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nextDatapoints()
    {
        return $this->hasMany(NextDatapoint::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function audio()
    {
        return $this->belongsToMany(Audio::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }
}
