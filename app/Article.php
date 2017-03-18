<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the categories for the dnews article 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Categories::class)->withTimestamps();
    }

    /**
     * Get the comments for a news post.
     *
     * @return \Illuminate\Database\ELoquent\Relations\BelongsToMany
     */
    public function comments() 
    {
        return $this->belongsToMany(Comment::class)->withTimestamps();
    }
}
