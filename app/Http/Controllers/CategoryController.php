<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Http\Requests\CategoryValidation;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = trans('categories.title-create');
        return view('', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryValidation $input
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  int  $categoryId     The category id in the database.
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId)
    {
        $data['categories'] = $this->categories->find($categoryId);
        $data['title']      = trans('categories.title-show', ['category' => $data['category']->title]);

        return view('', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function edit($categoryId)
    {
        $data['category'] = $this->categories->find($categoryId);

        if ($data['category']) { // Record has been found.
            $data['title'] = trans('categories.title-edit', ['category' => $data['category']->name]);

            return view('category.show', $data);
        }

        return redirect()->route('categories');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryValidation $input
     * @param  int $categoryId
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoryId)
    {
        $data['category'] = $this->categories->find($categoryId);

        if ($data['category']) { // The record is found.
            if ($data['category']->delete()) { // The record has been deleted.
                $this->categories->newsItems()->sync([]);
                $this->categories->supportItems()->sync([]);

                session()->flash('class', 'alert alert-success');
                session()->flash('message', trans('categories.flash-delete', ['category' => $data['category']->name]));

                return back();
            }
        }

        return redirect()->route('categories');
    }
}
