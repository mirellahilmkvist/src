<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NextDatapoint
 * @package App
 */
class NextDatapoint extends Model
{
    /**
     * @var array
     */
    protected $guarded = [

    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function datapoint()
    {
        return $this->belongsTo(Datapoint::class);
    }
}
