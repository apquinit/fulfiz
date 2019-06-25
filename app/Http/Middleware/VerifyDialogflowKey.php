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
        $this->key = $this->keyRepository->getByNameAndStatus('dialogflow', 'ACTIVE')->token;
        
        if ($request->bearerToken() === $this->key) {
            return $next($request);
        } else {
            abort(403, 'Forbidden');
        }
    }
}
