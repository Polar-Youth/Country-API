<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Http\Requests\SupportValidation;
use App\Support;
use App\ThreadStatus;
use Illuminate\Http\Request;

/**
 * Class SupportController
 *
 * @package App\Http\Controllers
 */
class SupportController extends Controller
{
    /**
     * @var Support
     */
    private $supportItems;

    /**
     * @var Categories
     */
    private $categories;

    /**
     * @var ThreadStatus
     */
    private $status;

    /**
     * SupportController constructor.
     *
     * @param Support       $supportItems
     * @param Categories    $categories
     * @param ThreadStatus  $status
     */
    public function __construct(Support $supportItems, Categories $categories, ThreadStatus $status)
    {
        $this->middleware('auth')->except(['index', 'search']);

        $this->supportItems = $supportItems;
        $this->categories   = $categories;
        $this->status       = $status;
    }

    /**
     * Get the index for the support forum.
     *
     * @see:unit-test   \Tests\Feature\SupportControllerTest::testIndexController()
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['title']    = trans('support.title-index');
        $data['selector'] = 'all';
        $data['items']    = $this->supportItems->with(['author'])->paginate(10);

        return view('support.index', $data);
    }

    /**
     * Get support thread based on their group.
     *
     * // TODO: Set unit-test when data found.
     * // TODO: Set unit-test when no data found.
     *
     * @param  string $selector The support thread group.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function group($selector)
    {
        $data['selector'] = $selector;
        $data['title']    = trans('support.title-group', ['selector' => $selector]);

        if ($selector === 'all') {
            $data['items']  = $this->supportItems->with(['author', 'status'])->paginate(10);
        } else {
            $data['items']  = $this->supportItems->with(['author', 'status'])
                ->whereHas('status', function ($query) use ($selector) {
                    $query->where('name', $selector);
                })->paginate(10);
        }

        return view('support.index', $data);
    }

    /**
     * Get the create view for a new thread.
     *
     * @see:unit-test   \Tests\Feature\SupportControllerTest::testCreateController
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data['title']      = trans('support.title-create');
        $data['categories'] = $this->categories->where('module', '=', 'support')->get();

        return view('support.create', $data);
    }

    /**
     * Store the new thread in the database.
     *
     * TODO: Create unit-test when validation fails.
     * TODO: Create unit-test when validation passes.
     *
     * @param  SupportValidation $input  The user input.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SupportValidation $input)
    {
        $db['store'] = $this->supportItems->create($input->except(['_token', 'tags']));

        if ($db['store']) { // Data >>> Stored
            $relationBase = $this->supportItems->find($db['store']->id);

            // Status assign.
            $status = $this->status->where('name', 'open')->get()->first();
            $relationBase->status()->attach($status->id);
            // End Status assign.

            // Tags assign.
            if (! empty($input->get('tags'))) { // There tags given
                $relationBase->tags()->sync($input->get('categories'));
            }
            // End Tags assign.

            // Session data
            $class   = 'alert alert-success';
            $message = trans('support.flash-create');
        } else { // Data >>> Not stored
            $class   = 'alert alert-success';
            $message = trans('support.flash-create-error');
        }

        session()->flash('class', $class);
        session()->flash('message', $message);

        return back();
    }

    /**
     * Search for a specific topic.
     *
     * @param  Request $input The input facade.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $input)
    {
        $term = $input->get('term');

        $data['selector']   = 'all';
        $data['title']      = trans('support.title-search', ['term' => $term]);
        $data['items']      = $this->supportItems->with(['author'])
            ->where('title', 'LIKE', "%$term%")
            ->orWhere('post', 'LIKE', "$term")
            ->paginate(10);

        return view('support.index', $data);
    }

    /**
     * Show the specific data about a support ticket.
     *
     * TODO: write unit test
     *
     * @param  int $itemId The id for the support ticket in the database
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($itemId)
    {
        $data['item']  = $this->supportItems->with(['author', 'tags', 'comments'])->find($itemId);

        if ($data['item']) {
            $data['title'] = $data['item']->title;

            return view();
        }

        return redirect()->route('support.index');
    }
}
