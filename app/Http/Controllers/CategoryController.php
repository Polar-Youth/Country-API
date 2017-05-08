<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Http\Requests\CategoryValidation;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @var Categories
     */
    private $categories;

    /**
     * CategoryController constructor.
     *
     * @param Categories $categories
     */
    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    /**
     * List all the tags with their information in the system.
     *
     * @see:unit-test   \Tests\Feature\CategoryControllerTest::testIndexController()
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['title']      = trans('categories.title-index');
        $data['categories'] = Categories::paginate(15);

        return view('categories.index', $data);
    }

    /**
     * Create view for a new category.
     *
     * @see:unit-test   \Tests\Feature\CategoryControllerTest::testCategoryCreateView()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data['title'] = trans('categories.title-create');
        return view('categories.create', $data);
    }

    /**
     * Insert a new category.
     *
     * @see:unit-test \Tests\Feature\CategoryControllerTest::testCategoryInsertError()
     * @see:unit-test \Tests\Feature\CategoryControllerTest::testCategoryInsertOk()
     *
     * @param  CategoryValidation $input The user input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryValidation $input)
    {
        if ($this->categories->create($input->except(['_token']))) { // Record has been created.
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('categories.flash-store'));
        }

        return back();
    }

    /**
     * Show a specific category in the system.
     *
     * @see:unit-test   \Tests\Feature\CategoryControllerTest::testShowWithData()
     * @see:unit-test   \Tests\Feature\CategoryControllerTest::testShowNoData()
     *
     * @param  int $categoryId The category id in the system.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($categoryId)
    {
        $data['category'] = $this->categories->find($categoryId);

        if ($data['category']) {
            $data['title']  = trans('categories.title-show', ['category' => $data['category']->title]);

            return view('categories.show', $data);
        }

        return redirect()->route('categories');
    }

    /**
     * Edit view for a category.
     *
     * @see:unit-test \Tests\Feature\CategoryControllerTest::testCategoryTestEditNoData()
     * @see:unit-test \Tests\Feature\CategoryControllerTest::testCategoryTestEditData()
     *
     * @param  int $categoryId The category id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($categoryId)
    {
        $data['category'] = $this->categories->find($categoryId);

        if ($data['category']) { // Record has been found.
            $data['title'] = trans('categories.title-edit', ['category' => $data['category']->name]);

            return view('categories.edit', $data);
        }

        return redirect()->route('categories');
    }

    /**
     * Update a category.
     *
     * @see:unit-test   \Tests\Feature\CategoryControllerTest::testUpdateValidationSuccess()
     * @see:unit-test   \Tests\Feature\CategoryControllerTest::testUpdateValidationErr()
     * @see:unit-test   \Tests\Feature\CategoryControllerTest::testUpdateNoResource()
     *
     * @param  CategoryValidation $input The user input in the database.
     * @param  int $categoryId The category id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryValidation $input, $categoryId)
    {
        $db['categories'] = $this->categories->find($categoryId);

        if ($db['categories']) { // Record found.
            if ($db['categories']->update($input->except(['_token']))) {
                session()->flash('class', 'alert alert-success');
                session()->flash('message', trans('categories.flash-update', ['category' => $db['categories']->name]));

                return back();
            }
        }

        return response()->route('categories');
    }

    /**
     * Delete a category in the database.
     *
     * @see:unit-test   \Tests\Feature\CategoryControllerTest::testDestroyWithData()
     * @see:unit-test   \Tests\Feature\CategoryControllerTest::testDestroyWithNoData()
     *
     * @param  int $categoryId The category id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($categoryId)
    {
        $data['category'] = $this->categories->find($categoryId);

        if ($data['category']) { // The record is found.
            if ($data['category']->delete()) { // The record has been deleted.
                $data['category']->newsItems()->sync([]);
                $data['category']->supportItems()->sync([]);

                session()->flash('class', 'alert alert-success');
                session()->flash('message', trans('categories.flash-delete', ['category' => $data['category']->name]));

                return back();
            }
        }

        return redirect()->route('categories');
    }
}
