<?php

namespace App\Listeners;

use App\Events\CountryDelete;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CountryDeleteListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CountryDelete  $event
     * @return void
     */
    public function handle(CountryDelete $event)
    {
        dd('Delete eloquent listener');
    }
}
