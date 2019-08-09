<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\KeyRepository;

class VerifyPushbulletKey
{
    private $keyRepository;
    private $key;

    /**
     * VerifyServiceKey constructor.
     *
     * @param KeyRepository $key
     */
    public function __construct(KeyRepository $keyRepository)
    {
        $this->keyRepository = $keyRepository;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get key from repository.
        $this->key = $this->keyRepository->getByName('pushbullet');

        if ($this->key->token != $request->bearerToken()) {
            abort(401, 'Unauthorized.');
        }
        
        if ($this->key->status === 'ENABLED') {
            return $next($request);
        } elseif ($this->key->status === 'DISABLED') {
            abort(401, 'Unauthorized.');
        } else {
            abort(500, 'Internal server error.');
        }
    }
}
