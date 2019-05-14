<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-13 17:44
 */

namespace App\Http\Middleware;


use App\Log;
use App\Models\Option;
use App\Units\Tools\Ip;
use Closure;

class VisitIpLimit
{
    /**
     * Handle an incoming request.
     * Get data from database to check a user can not visit.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $denyVisitIps = json_decode(Option::getOption('deny_visit_ips'), true);
        $allowVisitIps = json_decode(Option::getOption('allow_visit_ips'), true);

        Log::debug('deny visit ip limit count: {}', count($denyVisitIps));
        Log::debug('allow visit ip limit count: {}', count($allowVisitIps));


        if (count($denyVisitIps) && Ip::isIpInSubnets($request->ip(), $denyVisitIps)) {
            Log::warning('someone try to visit from: {}.', $request->ips());
            return abort(403, 'Your ip not allow visit');
        }

        if (count($allowVisitIps) && (! Ip::isIpInSubnets($request->ip(), $allowVisitIps))) {
            Log::warning('someone try to visit from: {}.', $request->ips());
            return abort(403, 'Your ip not allow visit');
        }

        return $next($request);
    }
}