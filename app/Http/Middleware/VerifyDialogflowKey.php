<?php

namespace App\Http\Middleware;

use Closure;
use App\Interfaces\KeyRepositoryInterface;

class VerifyDialogflowKey
{
    private $keyRepository;
    private $key;

    /**
     * VerifyServiceKey constructor.
     *
     * @param KeyRepositoryInterface $key
     */
    public function __construct(KeyRepositoryInterface $keyRepository)
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
