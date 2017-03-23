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
        // $this->middleware('role:admin,access_users');

        $this->users = $users;
    }

    /**
     * List all the users in the platform.
     *
     * @see:unit-test   \Tests\Feature\UsersControllerTest::testIndexController()
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
    public function status($userId, $statusId)
    {
        switch ($statusId) {
            case 1: // User getting blocked.
                break;
            case 2: // User getting unblocked.
                break;
            default:
        }
        return back();
    }

    /**
     * Delete a user out off the database.
     *
     * @param  int $userId The user id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($userId)
    {
        $db['user'] = $this->users->find($userId);

        if ($db['user']) { // Record is found.
            if($db['user']->delete()) { // Record has been deleted.
                session()->flash('class', 'alert alert-success');
                session()->flash('message', trans('users.flash-delete'));
            }

            return back();
        }

        return response()->route('users');
    }
}
