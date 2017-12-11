<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\SioriFriends\Models\Api\ApiToken;
use App\SioriFriends\Models\User\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class OnceAuth
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
        try{
            $apiToken = ApiToken::where("token",$request->input("token"))->firstOrFail();
            Auth::login(User::where(["id" => $apiToken->user_id])->firstOrFail());
            return $next($request);
        } catch(ModelNotFoundException $e) {
            return response()->json(["error" => "Forbidden"],403);
        }

    }
}
