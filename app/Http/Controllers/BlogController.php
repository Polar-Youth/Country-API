<?php

namespace App\Http\Controllers;

use App\User;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests\NewsValidation;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['title']    = trans('new.title-index');
        $data['articles'] = $this->dbArticle->with(['author', 'categories'])->paginate(15);

        return view('news.index', $data);
    }

    /**
     * Show a specific news message to the user.
     *
     * @param  int $articleId the database id for the news article.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($articleId)
    {
        $data['article'] = $this->dbArticle->with(['author', 'categories'])->find($articleId);
        $data['title']   = $data['article']->title;

        return view('news.show', $data);
    }

    /**
     * Create a new article in the database.
     *
     * @param  NewsValidation $input The user inpu validation.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsValidation $input)
    {
        return back();
    }
}
