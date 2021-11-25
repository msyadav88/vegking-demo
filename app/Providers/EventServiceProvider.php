<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Backend\StockUpdated' => [
            'App\Listeners\Backend\CheckMatchesForStockRun',
        ],
        'App\Events\Backend\BuyerCreated' => [
            'App\Listeners\Backend\BuyerCreatedNotification',
            'App\Listeners\Backend\CheckMatchesForBuyerRun',
        ],
        'App\Events\Backend\BuyerUpdated' => [
            'App\Listeners\Backend\CheckMatchesForBuyerRun',
        ],
        'App\Events\Backend\BuyerPrefCreated' => [
            'App\Listeners\Backend\CheckMatchesForBuyerRun',
        ],

        // 'App\Events\Backend\OrderMatched' => [
        //     'App\Listeners\Backend\NotifyOrderMatched',
        // ],

        'App\Events\Backend\EmailVerify' => [
            'App\Listeners\Backend\SendEmailVerify',
        ],
   

        'App\Events\Backend\BuyerSellerImported' => [
            'App\Listeners\Backend\SendBuyerSellerImportedEmail',
        ],

        // 'App\Events\Backend\CheckMatchesForBuyer' => [
        //     'App\Listeners\Backend\CheckMatchesForBuyerRun',
        // ],

        // 'App\Events\Backend\CheckMatchesForStock' => [
        //     'App\Listeners\Backend\CheckMatchesForStockRun',
        // ],

        'App\Events\Backend\SellerCreated' => [
            'App\Listeners\Backend\SellerCreatedNotification',
        ],
        'App\Events\Pushnotification' => [
            'App\Listeners\PushListener',
        ],
    ];

    /**
     * Class event subscribers.
     *
     * @var array
     */
    protected $subscribe = [
        // Frontend Subscribers

        // Auth Subscribers
        \App\Listeners\Frontend\Auth\UserEventListener::class,

        // Backend Subscribers

        // Auth Subscribers
        \App\Listeners\Backend\Auth\User\UserEventListener::class,
        \App\Listeners\Backend\Auth\Role\RoleEventListener::class,
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();

        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
