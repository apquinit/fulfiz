<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\KeyRepository;

class VerifyDialogflowKey
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
        $this->key = $this->keyRepository->getByName('dialogflow');

        if ($this->key->token != $request->bearerToken()) {
            abort(403, 'Forbidden');
        }

        if ($this->key->status === 'ENABLED') {
            return $next($request);
        } elseif ($this->key->status === 'DISABLED') {
            abort(401, 'Unauthorized');
        } else {
            abort(500, 'Internal Server Error');
        }
    }
}
