<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Support
 *
 * @package App
 */
class Support extends Model
{
    /**
     * Mass-assign fields for the database.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'title', 'post'];

    /**
     * Get the status for the support question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function status()
    {
        return $this->belongsToMany(ThreadStatus::class)
            ->withTimestamps();
    }

    /**
     * Get the user for the support question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the tags for the support question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Categories::class)
            ->withTimestamps();
    }
}
