<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NonAdminSubmissionOnly
{
    /**
     * Allow normal (non-admin) users to access only the submission page and logout.
     *
     * @param  \\Closure(\\Illuminate\\Http\\Request): (\\Symfony\\Component\\HttpFoundation\\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && !$user->is_admin) {
            $allowedRouteNames = [
                'submissions.create',
                'submissions.store',
                'logout',
            ];

            if (!in_array($request->route()?->getName(), $allowedRouteNames, true)) {
                return redirect()->route('submissions.create');
            }
        }

        return $next($request);
    }
}

