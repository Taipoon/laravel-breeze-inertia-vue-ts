<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $guard = $this->getGuard();

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user($guard),
                'guard' => $guard,
            ],
            'ziggy' => fn() => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }

    /**
     * 現在のリクエストが認証されている場合、ガードを取得します。
     *
     * @return int|string|null
     */
    private function getGuard(): int|string|null
    {
        $currentGuard = null;

        foreach (config('auth.guards') as $guard => $details) {
            if (auth()->guard($guard)->check()) {
                $currentGuard = $guard;
                break;
            }
        }

        return $currentGuard;
    }
}
