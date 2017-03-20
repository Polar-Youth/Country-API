<?php

namespace App\Http\Controllers;

use App\User;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests\NewsValidation;

/**
 * Class BlogController
 *
 * @package App\Http\Controllers
 */
class BlogController extends Controller
{
    /**
     * @var Article
     */
    private $dbArticle;
    
    /**
     * @var User
     */
    private $dbUser;

    /**
     * BlogController constructor.
     *
     * @param Article $dbArticle
     * @param User $dbUser
     */
    public function __construct(Article $dbArticle, User $dbUser)
    {
        $this->middleware('auth');

        $this->dbArticle = $dbArticle;
        $this->dbUser = $dbUser;
    }

    /**
     * Get the news index page.
     *
     * @see:unit-test   TODO: write unit test.
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['title']    = trans('news.title-index');
        $data['articles'] = $this->dbArticle->with(['author', 'categories'])->paginate(15);

        return view('news.index', $data);
    }

    /**
     * Show a specific news message to the user.
     *
     * @see:unit-test   TODO: write unit test.
     * @see:unit-test   TODO: write unit test (no resource).
     *
     * @param  int $articleId the database id for the news article.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($articleId)
    {
        // TODO: Check for redirect or abort 404 when no data is found.

        $data['article'] = $this->dbArticle->with(['author', 'categories'])->find($articleId);
        $data['title']   = $data['article']->title;

        return view('news.show', $data);
    }

    /**
     * Create a new article in the database.
     *
     * @see:unit-test   TODO: write unit test.
     * @see:unit-test   TODO: write unit test.
     *
     * @param  NewsValidation $input The user input validation.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsValidation $input)
    {
        $db['create']     = $this->dbArticle->create($input->except(['_token', 'categories']));
        $db['relation']   = $this->dbArticle->find($db['create']->id)->categories()->attach($input->categories);

        if ($db['create'] && $db['relation']) {
          session()->flash('class', 'alert alert-success');
          session()->flash('message', trans('news.flash-create'));
        }

        return back();
    }

    /**
     * Update a post in the database.
     *
     * @see:unit-test   TODO: Write unit test.
     * @see:unit-test   TODO: Write unit test.
     * @see:unit-test   TODO: Write unit test. (No resource)
     *
     * @param  NewsValidation $input      The user input validation.
     * @param  int            $articleId  The news article id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsValidation $input, $articleId)
    {
        $article = $this->dbArticle->find($articleId);

        if ($article) { // Article has been found.
            $update['data']       = $article->update($input->except(['_token', 'categories']));
            $update['categories'] = $article->categories->sync($input->categories);

            if ($update['data'] && $update['categories']) {
                session()->flash('class', 'alert alert-success');
                session()->flash('message', trans('news.flash-update'));
            }

            return back();
        }

        return redirect()->route('news');
    }

    /**
     * Delete a article in the database.
     *
     * @see:unit-test   TODO: write unit test.
     * @see:unit-test   TODO: write unit test when no id exists.
     *
     * @param  int $articleId  The article id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($articleId)
    {
        $db['article'] = $this->dbArticle->find($articleId);

        if ($db['article']) {
            if ($db['article']->delete()) {
                session()->flash('class', 'alert alert-success');
                session()->flash('message', trans('news.flash-delete'));
            }

            return back();
        }

        return redirect()->route('news');
    }
}
