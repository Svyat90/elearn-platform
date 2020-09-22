<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

class LocaleMiddleware
{
    /**
     * @var string
     */
    public static string $mainLanguage = 'ro';

    /**
     * @var array|string[]
     */
    public static array $languages = [
        'ro', 'ru', 'en'
    ];

    /**
     * @return mixed|string|null
     */
    public static function getLocale()
    {
        $uri = Request::path();
        $segments_uri = explode('/', $uri);
        $locale = $segments_uri[0];

        if (!empty($locale) && in_array($locale, self::$languages)) {
            if ($locale != self::$mainLanguage)
                return $locale;
        }

        return null;
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
        $locale = self::getLocale();

        if ($locale) {
            App::setLocale($locale);
        } else {
            App::setLocale(self::$mainLanguage);
        }

        return $next($request);
    }
}
