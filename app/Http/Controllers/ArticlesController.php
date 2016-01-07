<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use App\Http\Controller\Auth;
use App\Http\Controller\Auth\AuthController;
class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    //show all articles
    public function index(){
    //    return \Auth::user()->name;
        //without using function
        //$articles=Article::latest('published_at')->where('published_at','<=',Carbon::now())->get();
        $articles=Article::latest('published_at')->published()->get();
        return view('articles.index',compact('articles'));
    }

    //view of create article page
    public function create(){
    	return view('articles.create');
    }

    /*
    validation without using article request
    public function store(Request $request)
    {
        $this->validate($request, [
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ]);
    }
    */


    /*
    Post function of create article view to store new article
    ArticleRequest is used for validating the request through rules defind in that file
    */
    public function store(ArticleRequest $request)
    {
      //  $article = new Article($request->all());//$article don't have user id at this point
        
        //    \Auth::user()->articles()->save($article);//this command saves a new article through users table
        //shashank you need to work on relationships(eloquent);

        \Auth::user()->articles()->create($request->all());
        //after validation not using facade and before eloquent relationships
            //Article::create($request->all());        
        // before validation i.e. CreateArticleRequest 
            //Article::create(Request::all());
        /*
        if we dont want to use redirect
        $articles=Article::latest('published_at')->published()->get();
        return view('articles.index',compact('articles'));
        */
//        session()->flash('flash_message','Your article has been created');
        return redirect('articles')->with([
            'flash_message'=>'Your article has been created',
            'flash_message_important'=>true
        ]);
    }

    //to edit the article
    public function edit(Article $article)
    {
        // $article=Article::findOrFail($id);
        return view('articles.edit',compact('article'));
    }
    public function update(Article $article,ArticleRequest $request)
    {
        // $article=Article::findOrFail($id);
        $article->update($request->all());
        return redirect('articles');
    }
    
    //to show a single article of particular id
    public function show(Article $article){ 

        // $article=Article::findOrFail($id);
        // dd($articles->published_at->diffForHumans());
        return view('articles.show',compact('article'));
    }
}
?>