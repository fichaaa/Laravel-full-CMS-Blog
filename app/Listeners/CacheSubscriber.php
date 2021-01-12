<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Cache\Events\CacheHit;
use Illuminate\Cache\Events\CacheMissed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CacheSubscriber
{
    public function handleCacheHit(CacheHit $event){
        Log::info("{$event->key} cache hit");
    }

    public function handleCacheMissed(CacheMissed $event){
        Log::info("{$event->key} cache miss");
    }
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            CacheHit::class,
            [CacheSubscriber::class, 'handleCacheHit']
        );

        $events->listen(
            CacheMissed::class,
            [CacheSubscriber::class, 'handleCacheMissed']
        );
    }
}
