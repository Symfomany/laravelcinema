<?php

namespace App\Handlers\Events;

use App\Http\Models\Administrators;
use Illuminate\Support\Facades\Request;

/**
 * Class AuthLoginEventHandler
 * @package App\Handlers\Events
 */
class AuthLoginEventHandler
{

    /**
     * Create the event handler.
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(Administrators $user)
    {
        $user->authentificated_at = new \DateTime;
        $user->ip = Request::getClientIp();
        $user->save();
    }
}
