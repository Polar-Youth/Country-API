<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class LanguageMiddleware
{
    /**
     * The supported language codes.
     *
     * @var array
     */
    protected $supportedLanguages = ['nl', 'en', 'fr']; 

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language = (Input::get('lang')) ?: Session::get('lang'); 
        $this->setSupportedLanguage($language);

        return $next($request); 
    }

    /**
     * Check if the language is supported. 
     * 
     * @param  string $lang The language key. 
     * @return bool
     */
    private function isLanguageSupported($lang)
    {
        return in_array($lang, self::$supportedLanguages);
    }

    /**
     * Set the supported to the session 
     * 
     * @param  string $lang The language key. 
     * @return boid
     */
    private function setSupportedLanguage($lang) 
    {
        if ($this->isLanguageSupported($lang)) { // The language is supported. 
            App::setLocale($lang); 
            Session::put('lang', $lang);
        }
    }
}
