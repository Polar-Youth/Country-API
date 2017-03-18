<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
	/**
	 * Mass-assign fields for the database field.
	 *
	 * @var array
	 */
    protected $fillable = ['ISO_3166_2', 'name'];
}
