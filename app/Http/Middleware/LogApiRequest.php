<?php

namespace App\Http\Middleware;

use Closure;

class LogApiRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $text = file_get_contents('/home/yipl/log') or '';

        $text .= PHP_EOL . PHP_EOL . PHP_EOL . $request->url();

        file_put_contents('/home/yipl/log', $text);

        return $next($request);
    }
}
