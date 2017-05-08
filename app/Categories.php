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

    /**
     * Get the news items for a specific tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function newsItems()
    {
        return $this->belongsToMany(Article::class)->withTimestamps();
    }

    /**
     * Get the support items for a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function supportItems()
    {
        return $this->belongsToMany(Support::class)->withTimestamps();
    }
}
