<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

use Illuminate\Auth\Events\Logout;
use App\Events\TestEvent;


class TestListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        //dd('call TestListener', $event);
    }
    
    public function handle2(Logout $event)
    {
        dd('call TestListener handle2', $event);
    }
    
    public function handle3(TestEvent $event)
    {
        Log::info('call TestListener handle3');
        Log::info($event->name); // TestEventのメンバ変数nameにアクセスできる
    }
}
