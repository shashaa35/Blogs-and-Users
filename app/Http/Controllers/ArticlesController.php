<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Article;
use App\Tag;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Auth\AuthController;
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
        $tags=Tag::lists('name','id');
    	return view('articles.create',compact('tags'));
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
      //  dd($request->input('tags'));
      //  $article = new Article($request->all());//$article don't have user id at this point
        
        //    \Auth::user()->articles()->save($article);//this command saves a new article through users table
        //shashank you need to work on relationships(eloquent);

        $article= \Auth::user()->articles()->create($request->all());
        //after validation not using facade and before eloquent relationships
            //Article::create($request->all());        
        // before validation i.e. CreateArticleRequest 
            //Article::create(Request::all());
        $tagIds=$request->input('tag_list');
        $article->tags()->attach($tagIds);

        /*
        if we dont want to use redirect
        $articles=Article::latest('published_at')->published()->get();
        return view('articles.index',compact('articles'));
        */
        //session()->flash('flash_message','Your article has been created');
        return redirect('articles')->with([
            'flash_message'=>'Your article has been created',
            'flash_message_important'=>true
        ]);
    }

    //to edit the article
    public function edit($id)
    {
         $article=Article::findOrFail($id);
        $tags=Tag::lists('name','id');
        return view('articles.edit',compact('article','tags'));
    }

    public function update($id,ArticleRequest $request)
    {
         $article=Article::findOrFail($id);
        $article->update($request->all());
        $tagIds=$request->input('tag_list');
        $article->tags()->sync($tagIds);
   // dd($article);
        return redirect('articles');
    }
    
    //to show a single article of particular id
    public function show($id){
//        dd($id);
         $article=Article::findOrFail($id);

//        dd($article);
        // dd($articles->published_at->diffForHumans());
        return view('articles.show',compact('article'));
    }
}
?>