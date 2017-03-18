<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * Mass-assign projects fields. 
     *
     * @var array
     */
    protected $fillable = ['name'];
}
