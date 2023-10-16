<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $request->user()->hasVerifiedEmail()
            # TODO: ガードに応じて認証済みリクエストのリダイレクト先URLを定義・指定してください。
            ? redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD)
            : Inertia::render('Admin/Auth/VerifyEmail', ['status' => session('status')]);
    }
}
