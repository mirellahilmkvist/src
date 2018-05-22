<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Round
 * @package App
 */
class Round extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'finished' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function datapoints()
    {
        return $this->hasMany(Datapoint::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * @return bool
     */

    public function markAsPublished()
    {
        return $this->update([
            'published' => true
        ]);
    }

    public function markAsFinished()
    {
        return $this->update([
            'finished' => true
        ]);
    }
}