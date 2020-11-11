<?php

namespace App\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

class QueryExecutedListerner
{
    public function handle(QueryExecuted $query)
    {
        Log::debug(__METHOD__, ['SQL' => $query->sql]);
        Log::debug(__METHOD__, ['bindings' => $query->bindings]);
        Log::debug(__METHOD__, ['time' => $query->time]);
    }
}
