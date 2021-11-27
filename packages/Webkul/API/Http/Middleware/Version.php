<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 9/28/2021
 * Time: 0:17
 */

namespace Webkul\API\Http\Middleware;

use Closure;
class Version
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if( $version = $request->header('Version')){
            $version = explode('.',$version);
            $app_version = explode('.',config('app.version'));
            if($version[0]<$app_version[0])
                return response()->json(['message' => 'Please update app to latest version', 'status'=>false],406);
        }
        else{
            return response()->json(['message' => 'Please update app to latest version', 'status'=>false],406);
        }
        return $next($request);
    }
}