<?php

namespace App\Http\ViewComposers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;



class ActivityComposer
{
    public function compose(View $view)
    {
        
        $mostCommented = Cache::tags(['post'])->remember('post-most-commented', now()->addSeconds(60), function() {
            return Post::mostCommented()->take(5)->get();
        });

        $mostActiveUsers = Cache::tags(['post'])->remember('users-most-active', now()->addSeconds(60), function() {
            return User::mostActiveUsers()->take(5)->get();
        });

        $mostActiveUsersLastMonth = Cache::tags(['post'])->remember('users-most-active-last-month', now()->addSeconds(60), function() 
        {
            return User::mostActiveUsersLastMonth()->take(5)->get();
        });

        $view->with('mostCommented', $mostCommented);
        $view->with('mostActiveUsers', $mostActiveUsers);
        $view->with('mostActiveUsersLastMonth', $mostActiveUsersLastMonth);

    }
}

