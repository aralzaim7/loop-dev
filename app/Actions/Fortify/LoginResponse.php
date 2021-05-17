<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @inheritDoc
     */
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(
                $request->user()->is_admin
                    ? config('fortify.admin_home')
                    : config('fortify.guest_home'));
               // config('fortify.home')); // This is the line you want to modify so the application behaves the way you want.
    }
}
