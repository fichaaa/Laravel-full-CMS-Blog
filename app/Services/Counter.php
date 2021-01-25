<?php

namespace App\Services;

use App\Contracts\CounterContract;
use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Session\Session;


class Counter implements CounterContract
{
    public $timeout;
    private $cache;
    private $session;
    private $supportTags;

    public function __construct(Cache $cache, Session $session, int $timeout)
    {
        $this->cache = $cache;
        $this->session = $session;
        $this->timeout = $timeout;
        $this->supportTags = method_exists($cache, 'tags');
    }

    public function increment(string $key, array $tags = null):int
    {
        $sessionId = $this->session->getId();
        $counterKey = "{$key}-counter";
        $usersKey = "{$key}-users";

        $cache = $this->supportTags && $tags !== null ? $this->cache->tags($tags) : $this->cache;

        //an array where the key would be the session ID and value would be the last visited time
        $users = $cache->get($usersKey,[]);
        $usersUpdate= [];
        $difference = 0;
        $now = now();

        foreach($users as $session => $lastVisit) {
            if($now->diffInMinutes($lastVisit) >= $this->timeout)
            {
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if(
            !array_key_exists($sessionId,$users)
            || $now->diffInMinutes($users[$sessionId]) >= $this->timeout
            ){
            $difference++;
        }   

        $usersUpdate[$sessionId]  = $now;

        $cache->forever($usersKey, $usersUpdate);
        if(!$cache->has($counterKey))
        {
            $cache->forever($counterKey, 1);
        } else {
            $cache->increment($counterKey, $difference);
        }

        $counter = $cache->get($counterKey);

        return $counter;
    }
}