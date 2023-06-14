<?php

namespace App\Http\Middleware;

use App\Models\Comments;
use App\Models\Words;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PemilikWords
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $id_author = Words::findOrFail($request->id);
        $user = Auth::user();

        if ($id_author->author != $user->id) {
            return response()->json('kamu bukan pemilik postingan');
        };

        return $next($request);
    }
}
