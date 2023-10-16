<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            # TODO: ガードに応じて認証済みリクエストのリダイレクト先を指定してください。
            return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        # TODO: ガードに応じて認証済みリクエストのリダイレクト先を指定してください。
        return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD . '?verified=1');
    }
}
