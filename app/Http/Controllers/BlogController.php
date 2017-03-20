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
        // $this->middleware('auth');

        $this->dbArticle = $dbArticle;
        $this->dbUser = $dbUser;
    }

    /**
     * Get the news index page.
     *
     * @see:unit-test   \Tests\Feature\NewsControllerTest::testIndexController()
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['title']    = trans('news.title-index');
        $data['articles'] = $this->dbArticle->with(['author', 'categories'])->paginate(15);

        // TODO: Build up the view.
        return view('news.index', $data);
    }

    /**
     * Show a specific news message to the user.
     *
     * @see:unit-test   \Tests\Feature\NewsControllerTest::testShowControllerResource()
     * @see:unit-test   \Tests\Feature\NewsControllerTest::testShowControllerNoResource()
     *
     * @param  int $articleId the database id for the news article.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($articleId)
    {
        $data['article'] = $this->dbArticle->with(['author', 'categories'])->find($articleId);

        if ($data['article']) { // Record has been found.
            $data['title']   = $data['article']->title;

            // TODO: build up the view.
            return view('news.show', $data);
        }

        return redirect()->route('news');
    }

    /**
     * Create a new article in the database.
     *
     * @see:unit-test   \Tests\Feature\NewsControllerTest::testStoreControllerOk()
     * @see:unit-test   \Tests\Feature\NewsControllerTest::testStoreControllerNotOk()
     *
     * @param  NewsValidation $input The user input validation.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsValidation $input)
    {
        $db['create']     = $this->dbArticle->create($input->except(['_token', 'categories']));

        if ($db['create']) {
            $this->dbArticle->find($db['create']->id)->categories()->attach($input->categories);

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
     * @see:unit-test   \Tests\Feature\NewsControllerTest::testDeleteControllerDeleteOk()
     * @see:unit-test   \Tests\Feature\NewsControllerTest::testDeleteControllerNoResource()
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
