<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            # TODO: 新しく追加した認証ユーザーモデルを指定してください。
            'email' => 'required|string|email|max:255|unique:' . Admin::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        # TODO: 新しく追加した認証ユーザーモデルを指定してください。
        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        # TODO: 新しく追加したガードを明示的に指定してください。
        Auth::guard('admin')->login($user);

        # TODO: ガードに応じて認証済みリクエストのリダイレクト先を指定してください。
        return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
    }

    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Auth/Register');
    }
}
