<?php

namespace App\Http\Middleware;

use App\Models\RouteAccessCount;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class TrackRouteAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName();

        if ($routeName) {
            // Find or create a record for the current route
            $pageCounts = RouteAccessCount::firstOrCreate(
                ['route_name' => $routeName],
                ['access_count' => 0, 'daily_access_count' => 0, 'last_access_date' => Carbon::today()]
            );

            // Increment the total access count
            $pageCounts->access_count += 1;

            // Check if today’s date is the same as the last access date
            if ($pageCounts->last_access_date->isToday()) {
                // Increment the daily access count
                $pageCounts->daily_access_count += 1;
            } else {
                // Reset the daily access count for a new day
                $pageCounts->daily_access_count = 1;
                $pageCounts->last_access_date = Carbon::today();
            }

            // Save the updated counts
            $pageCounts->save();

            // Share the access count with the view
            View::share('pageCounts', $pageCounts);
        }

        return $next($request);
    }
}
