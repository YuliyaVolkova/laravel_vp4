<?php

namespace App\Listeners;

use App\Events\OrderMailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Mail\OrderCreatedMail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class OrderMailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  OrderMailEvent  $event
     * @return void
     */
    public function handle(OrderMailEvent $event)
    {
        $admin = User::where('role', Config::get('constants.ADMIN_ROLE_FOR_SENDING_MAIL'))
            ->orderBy('id', 'desc')->first();

        Mail::to($admin)->send(new OrderCreatedMail($event->data));
    }
}
