<?php

namespace App\Listeners;

use Illuminate\Cache\Events\CacheHit;
use Illuminate\Cache\Events\CacheMissed;
use Illuminate\Support\Facades\Log;

class CacheSubscriber
{
    public function handleCacheMiss(CacheMissed $event)
    {
        Log::info("{$event->key} is missed.");
    }

    public function handleCacheHit(CacheHit $event)
    {
        Log::info("{$event->key} is hit");
    }

    public function subscribe($event)
    {
        $event->listen(
            CacheHit::class,
            [CacheSubscriber::class, 'handleCacheHit'],
        );

        $event->listen(
            CacheMissed::class,
            [CacheSubscriber::class, 'handleCacheMiss'],
        );
    }
}
