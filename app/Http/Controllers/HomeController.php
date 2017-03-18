<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function frontend()
    {
        $data['title'] = trans('index.title-front');
        return view('welcome', $data);
    }

    /**
     * Get the backend index. 
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function backend()
    {
        $data['title'] = trans('index.title-admin');
        return view('home', $data);
    }
}
