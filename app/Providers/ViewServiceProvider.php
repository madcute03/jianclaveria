<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Share unread notification count to all views
        View::composer('*', function ($view) {
            $unreadCount = Auth::check() ? Auth::user()->unreadNotifications->count() : 0;
            $view->with('unreadCount', $unreadCount);
        });
    }
}
