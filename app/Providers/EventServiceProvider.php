<?php

namespace App\Providers;

use App\Listeners\QueryExecutedListerner;
use Illuminate\Database\Events\QueryExecuted;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ExampleEvent::class => [
            \App\Listeners\ExampleListener::class,
        ],
        QueryExecuted::class => [
          QueryExecutedListerner::class
        ],
    ];
}
