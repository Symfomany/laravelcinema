<?php

namespace App\Policies;

use App\Http\Models\Administrators;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class SuperAdminPolicy.
 */
class SuperAdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given post can be updated by the user.
     *
     * @return bool
     */
    public function isSuperAdmin(Administrators $administrator)
    {
        if ($administrator->super_admin === true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine if the given post can be updated by the user.
     *
     * @return bool
     */
    public function isExpired(Administrators $administrator)
    {

        // si j'ai expiration au niveau des date d'expiratio n
        if ($administrator->expiration_date > date('Y-m-d')) {
            return true;
        } else {
            return false;
        }
    }
}
