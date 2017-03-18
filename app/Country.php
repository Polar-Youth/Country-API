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
     * Mass assign fields for the database.
     * @var array
     */
    protected $fillable = [
        'continent_id', 'code', 'name', 'flag', 'fips_code', 'iso_code',
        'north_num', 'south_num', 'east_num', 'west_num',
        'capital', 'iso_alpha_2', 'iso_alpha_3', 'geoname_id'
    ];

    /**
     * Get the continent information.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function continent()
    {
        return $this->belongsTo(Continents::class, 'continent_id');
    }

    /**
     * Get the regions (divisions) for this country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function divisions()
    {
        return $this->belongsToMany(Division::class)->withTimestamps();
    }

    /**
     * Get the borders information for the country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function borders()
    {
        return $this->belongsToMany(Country::class, 'country_border')->withTimestamps();
    }
}
