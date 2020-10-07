<?php

namespace App\Services;

use App\Http\Requests\User\UpdateUserRequest;
use App\User;
use Illuminate\Support\Collection;

class UserService extends AbstractAccessService
{

    /**
     * @return Collection
     */
   public function getUserInstitutions() : Collection
   {
       return User::query()
           ->select('institution')
           ->distinct()
           ->pluck('institution');
   }

    /**
     * @param UpdateUserRequest $request
     * @param User $updateUser
     */
   public function updateData(UpdateUserRequest $request, User $updateUser) : void
   {
       // Logout user if change status no active
       if ($request->input('user_status') !== User::USER_STATUS_ACTIVE) {
           $updateUser->force_logout = true;
           $updateUser->save();

       // If set new status allow login
       } else if ($request->input('user_status') === User::USER_STATUS_ACTIVE
           && $updateUser->user_status !== User::USER_STATUS_ACTIVE) {
           $updateUser->force_logout = false;
           $updateUser->save();
       }

       $updateUser->update($request->validated());
   }

    /**
     * @param User $user
     * @param $request
     */
   public function handleRelationships(User $user, $request)
   {
       $user->roles()->sync($request->input('roles', []));
   }

}
