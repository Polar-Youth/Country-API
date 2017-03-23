<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categories
 *
 * @package App
 */
class Categories extends Model
{
    /**
     * Mass-assign projects fields. 
     *
     * @var array
     */
    protected $fillable = ['name', 'module', 'description'];
}
