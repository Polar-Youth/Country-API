<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var User
     */
    private $users;

    /**
     * UsersController constructor.
     *
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->middleware('role:admin');

        $this->users = $users;
    }

    /**
     * List all the users in the platform.
     *
     * // TODO: Implement phpunit test.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['title'] = trans('users.title-index');
        $data['users'] = $this->users->paginate(15);

        return view('users.index', $data);
    }

    /**
     * Status for the user. ban/unban.
     *
     * // TODO: write unit test when user blocked.
     * // TODO: write unit test when user unblocked.
     * // TODO: write unit test when user doesn't exist
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status()
    {
        return back();
    }
}
