<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
//use Request;//using this instead of the above commented out request
//appearently the above is a facade but I'm not sure what difference that
//makes
use App\Http\Requests\ArticleRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{

    public function __construct()
    {
        //this applies the auth middleware to the class
        //$this->middleware('auth');
        //to target specific routes within the controller
        $this->middleware('auth', ['only' => 'create']);
        //also you can replace the array with ['except'=>'index']
        //which will apply authentication to all pages except index
    }

    //this fetches all the articles
    public function index()
    {
        //this is how to get an authenticated user
        //the slash in front of auth is needed
        //unless you include the article facade which I did
        Auth::user();
        //to get specific attribute of an authenticated user do this
        //\Auth:user()->name;

        //get all the data(get())
        //in descending order(latest())
        //all latest does is an a order by clause to the prebuilt query
        //note: you must select the column you want to order by
        //note: published is our own method that sets a where clause to
        //limit the data output (this is called a scope)
        $articles = Article::latest('published_at')->published()->get();

        $latest = Article::latest()->first();

        return view ('articles.index', compact('articles', 'latest'));
    }

    //this fetches the article by ID
    //now that we've bound the object/model to the route wildcard
    //in RouteServiceProvider.php inside the boot function
    //are route returns the object/model directly instead of an Id number
    //so now our show function can look like the following
    public function show(Article $article/**$id*/)
    {
        //$article = Article::findOrFail($id);

        //dd is die dump
        //dd($article->published_at);

        return view('articles.show', compact('article'));
    }

    //the routes us to the create article page
    public function create()
    {
        //get the name column results and store it in tags
        //passing id as the second parameter sets the index's name
        //so if the name within the column is personal a representation
        //would be array['personal'] = '1' for example
        $tags = \App\Tag::lists('name', 'id');

        return view ('articles.create', compact('tags'));
    }

    //this collects the data from the articles form
    //processes it and redirects us to the articles index page
    //Also, we're passing in validation if that never validates
    //the function won't run
    public function store(ArticleRequest $request)
    {
        //request returns all inputs stored in the GET and POST
        //super global arrays
        //$input = Request::all();

        //set the published at field behind the scenes
        //$input['published_at'] = Carbon::now();

        //you can also do
        //$input = Request::get('nameOfField');
        //to get the individual field

        //we could create a new article object like so
        //$article = new Article;
        //then manually save each field to it
        //$article->title = $input['title'];

        //but since we've declared what is fillable in our model we can
        //just do the following

        //this creates the article and saves it to the database in one
        //shot
        //Article::create($input);

        //we can do the above all in one step like so
        //when using this $request validation we no longer need the facade
        //Article::create(Request::all());

        //our new way of doing it with validation is
        //Article::create($request->all());

        //now with user authentication
        //in order to add the user id to the article
        //fill the article with the user submitted data
        //$article = new Article($request->all());

        //associates the users articles new article and saves it
        //Also, this is where laravel associates the user id with the
        //article (this happens behind the scenes when save an article
        //this way)
        //you must include the article facade for this to work
        //$article = Auth::user()->articles()->save($article);

        //flash messages are temporary, they only exist for one request
        //\Session::flash('flash_message', 'Your article has been created!');
        //another way to send flash messages
        //session()->flash('flash_message_important', true);
        //use the with function to send flash messages to the page
        //return redirect('articles')->with([
        //    'flash_message' => 'Your article has been created!',
        //    'flash_message_important' => true
        //]);

        //we need to get the tags submitted by the user
        //$tagIds = $request->input('tags');

        //now attach the tags to the article
        //$article->tags()-attach($tagIds);

        //we can do the above by placing the request directly
        //within the attach functions parameters
        //$article->tags()->attach($request->input('tag_list'));

        //abstract the operations of this function to a private method
        $this->createArticle($request);

        //the new way of doing this with the laracasts flash package is as
        //follows
        //you can use a specific message like flash->success('message')
        // or just the base flash('message') etc.
        flash()->success('Your article has been created');
        //to add an overlay do this and look at the
        // custom js in the app.blade.php as you need to implement the modal
        //from there
        //flash()->overlay('Body','Title');

        return redirect('articles');

    }

    //please view the show methods comments to understand why id was
    //replaced with article
    public function edit(Article $article)
    {
        //find the article by id
        //$article = Article::findOrFail($id);

        //submit our tag for editing
        $tags = Tag::lists('name', 'id');

        //return the view with the data
        return view('articles.edit', compact('article', 'tags'));
    }

    //view the show methods comments to get some insight
    public function update(Article $article, ArticleRequest $request)
    {
        //create the new updated article
        //$article = Article::findOrFail($id);
        //update the article
        $article->update($request->all());

        //pass necessary params to syncTags function
        $this->syncTags($article, $request->input('tag_list'));

        //redirect to the articles index page
        return redirect('articles');

    }

    /**
     * Sync up the list of tags in the database
     *
     * @param Article $article
     * @param array $tags
     */
    private function syncTags(Article $article, array $tags)
    {
        //sync the tags we have in the updated request with the tags in the db
        //that are within the article_tag pivot table
        $article->tags()->sync($tags);
    }

    private function createArticle(ArticleRequest $request)
    {
        $article = Auth::user()->articles()->create($request->all());

        $this->syncTags($article, $request->input('tag_list'));

        return $article;
    }

}
