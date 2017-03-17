<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 *
 * @package App
 */
class Country extends Model
{
    /**
     * Mass-assign fields.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function continent()
    {
        return $this->belongsTo(Continents::class);
    }
}
