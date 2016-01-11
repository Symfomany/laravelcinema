<?php

namespace App\Handlers\Events;

use App\Http\Models\Administrators;
use Illuminate\Support\Facades\Request;

/**
 * Class AuthLoginEventHandler.
 */
class AuthLoginEventHandler
{
    /**
     * Create the event handler.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param Events $event
     */
    public function handle(Administrators $user)
    {
        $user->authentificated_at = new \DateTime();
        $user->ip = Request::getClientIp();
        $user->save();
    }
}
