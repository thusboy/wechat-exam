<?php

namespace App\Http\Middleware;

use Closure;

use EasyWeChat;

use Redirect;

class WechatSubscribe
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
        $wechatuser_s = session('wechat.oauth_user');
        $wechatUser = EasyWeChat::user()->get($wechatuser_s["id"]);
        if($wechatUser->subscribe){
            return $next($request);
         }
        else{
            return Redirect::action('HomeController@subscribe');
        }

    }
}
