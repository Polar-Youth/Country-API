<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['frontend']);
    }

    /**
     * Get the front-end index. 
     *
     * @see:unit-test   \Tests\Feature\HomeRouteTest::testIndexRoute()
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function frontend()
    {
        $data['title'] = trans('index.title-front');
        return view('welcome', $data);
    }

    /**
     * Get the backend index. 
     *
     * @see:unit-test   \Test\Feature\HomeRouteTest::testBackendRoute()
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function backend()
    {
        $data['title'] = trans('index.title-admin');
        return view('home', $data);
    }
}
