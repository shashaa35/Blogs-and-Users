<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller {

	public function show($tag){
        $tags= Tag::where('name',$tag)->firstOrFail();
//        dd($tags);
        $articles=$tags->articles()->published()->get();
        //dd($art);
        return view('articles.index',compact('articles'));
    }

}
