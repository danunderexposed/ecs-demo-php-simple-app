<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $redirect = Fortify::redirects('login');
        if($request->input('frontend')) {
            $redirect = '/profile';
        }

        $user = auth()->user();
        if ($user->abilities()->contains('access_admin')){
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('frontend.profile.index', ['edit' => 'true']);
        }
       // dd(auth()->user());

        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended($redirect);
    }
}
