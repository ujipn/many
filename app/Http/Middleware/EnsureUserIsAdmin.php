<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //リクエストを行ったユーザーがログインしていない、またはユーザーが管理者でない場合、次の行のコードを実行します。
        if (! $request->user() //ログインしていない場合
         || ! $request->user()->is_admin //ユーザーが管理者でない場合
         ) 
         { 
            abort(403);
        }

        return $next($request);
    }
}
