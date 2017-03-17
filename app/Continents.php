<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Continents
 *
 * @package App
 */
class Continents extends Model
{
    /**
     * Mass-assign fields for the database.
     *
     * @var array
     */
    protected $fillable = ['code', 'name'];
}
