<?php

namespace App\Services;

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

}
