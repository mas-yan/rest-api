<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
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
        $article = Article::paginate(15);

        ArticleResource::collection($article);

        return response()->json([
            'status' => 'success',
            'message' => 'data article',
            'data' => $article
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'body' => ['required'],
            'subject_id' => ['required'],
        ]);

        $articles = Auth::user()->articles()->create($this->articleRequest());

        return response()->json([
            'status' => 'success',
            'message' => 'article created',
            'author' => Auth::user()->name,
            'data' => $articles,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'get Article',
            'data' => new ArticleResource($article)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $articles = $article->update($this->articleRequest());
        return response()->json([
            'status' => 'success',
            'message' => 'article updated',
            'data' => $articles,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json('article was deleted', 200);
    }

    public function articleRequest()
    {
        return [
            'title' => request('title'),
            'slug' => \Str::slug(request('title')),
            'body' => request('body'),
            'subject_id' => request('subject_id'),
        ];
    }
}
