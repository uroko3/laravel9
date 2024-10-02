<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use Illuminate\Auth\Events\Logout;
use App\Listeners\TestListener;

use App\Events\TestEvent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Logout::class => [
            TestListener::class, // 指定したクラスのhandlerメソッドが呼ばれる
            [TestListener::class, 'handle2'], // メソッドを指定して実行する場合
        ],
        TestEvent::class => [
            [TestListener::class, 'handle3'], // 予めコントローラでTestEventをディスパッチする必要あり
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
