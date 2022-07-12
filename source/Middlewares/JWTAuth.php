<?php

namespace Source\Middlewares;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class JWTAuth implements IMiddleware
{
    public function handle(Request $request): void
    {
        try {
            $auth  = new Auth();
            $token = $auth->authorization();
            if ($token == false) {
                $request->setRewriteUrl('/accountholder');
            }
        } catch (\Throwable $th) {
            $request->setRewriteUrl('/accountholder');
        }
    }
}
