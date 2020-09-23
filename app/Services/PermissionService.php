<?php

namespace App\Services;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;

class PermissionService
{
    public const ROLE_ADMIN_ID = 1;

    /**
     * @return bool
     */
    public function loginUserHasAccessToAdminPanel() : bool
    {
        /** @var User $user */
        $user = Auth::user();
        if ( ! $user){
            return false;
        }

        $adminPermissions = [
            'user_management_access', 'content_management_access'
        ];

        /** @var Role $role */
        foreach ($user->roles as $role) {
            $userPermissions = $role->permissions->pluck('title')->toArray();
            foreach ($userPermissions as $permission) {
                if (in_array($permission, $adminPermissions)) {
                    return true;
                }
            }
        }

        return false;
    }

}
