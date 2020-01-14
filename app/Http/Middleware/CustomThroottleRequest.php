<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ApiResponser;
use Illuminate\Routing\Middleware\ThrottleRequests;

class CustomThroottleRequest extends ThrottleRequests
{
    use ApiResponser;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function buildResponse($key, $maxAttempts)
    {
        $response = new errorResponse('To many attempts...', 409);
        $retryAfter = $this->limiter->availableIn($key);
        return $this->addHeaders(
            $response, $maxAttempts,
            $this->calculateRemainingAttempts($key, $maxAttempts), $retryAfter
        );
    }
}
