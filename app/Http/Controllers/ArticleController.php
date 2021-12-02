<?php

namespace App\Http\Controllers;

use App\Article;
use App\Rules\SelectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::when(isset(request()->search), function ($q) {
            $search = request()->search;
            $q->where("title","like","%$search%")->orWhere("description","like","%$search%");
        })
            ->with('user', 'category')
            ->orderByDesc('id')->paginate(6);
        return view('article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
//            "category"=>["required",new SelectCategory()], //with rules building
            "category" => "required|exists:categories,id",
            "title" => "required|min:3|max:200|unique:articles,title",
            "description" => "required|min:5",
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->category_id = $request->category;
        $article->user_id = Auth::id();
        $article->save();
        return redirect()->route('article.index')->with('status', '<p class="alert alert-success"><b>' . $request->title . '</b> created.</p>');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('article.show',["article"=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article.edit',['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
//            "category"=>["required",new SelectCategory()], //with rules building
            "category" => "required|exists:categories,id",
            "title" => "required|min:3|max:200|unique:articles,title,".$article->id,
            "description" => "required|min:5",
        ]);

        $article->title = $request->title;
        $article->description = $request->description;
        $article->category_id = $request->category;
//        $article->user_id = Auth::id();
        $article->update();
        return redirect()->route('article.show',$article->id)->with('status', '<p class="alert alert-success"><b>' . $request->title . '</b> updated.</p>');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
//        return request();
        $title = $article->title;
        $article->delete();
        return redirect()->route('article.index',['page'=>request()->page])->with('status', '<p class="alert alert-success"><b>' . $title . '</b> deleted.</p>');
    }
}
