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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($categortyId)
    {
        //
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
                session()->flash('class', 'alert alert-success');
                session()->flash('message', trans('categories.flash-delete', ['category' => $data['category']->name]));

                return back();
            }
        }

        return redirect()->route('categories');
    }
}
