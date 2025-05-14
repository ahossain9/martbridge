<?php

namespace App\Http\Middleware;

use Closure;

class HtmlMinifier
{
    public function handle($request, Closure $next)
    {

        $response = $next($request);

        $contentType = $response->headers->get('Content-Type');
        if (str_contains($contentType, 'text/html')) {
            $response->setContent($this->minify($response->getContent()));
        }

        return $response;

    }

    public function minify($input)
    {
        $search = [
            '/\>\s+/s',
            '/\s+</s',
        ];

        $replace = [
            '> ',
            ' <',
        ];

        return preg_replace($search, $replace, $input);
    }
}
