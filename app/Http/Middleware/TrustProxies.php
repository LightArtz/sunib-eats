<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    protected $proxies = '*'; // Trust ALL proxies (Heroku requirement)

    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
