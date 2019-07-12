<?php


namespace App\Containers\Authorization\Traits;


use Illuminate\Support\Facades\Auth;

trait AuthorizationTrait
{

    /**
     * @return \App\Containers\User\Models\User|\Illuminate\Contracts\Auth\Authenticatable
     */
    public function getUser() {
        return Auth::user();
    }

    /**
     * @return mixed
     */
    public function hasAdminRole() {
        return $this->hasRole('admin');
    }
}