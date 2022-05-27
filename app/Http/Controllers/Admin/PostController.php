<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id',  Auth::user()->id)->orderBy('id', 'desc')->paginate(20);

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($data['title'], '-');

        // ? Uso i Fillable in maniera espansiva
        // $newPost = new Post();
        // $newPost->fill($data);
        // $newPost->save();

        // § fillable in maniera rapida
        Post::create($data);

        return redirect()->route('admin.posts.index')
        ->with('message', $data['title']. " è stato pubblicato con successo.");
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', ["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        // $data['user_id'] = Auth::user()->id;

        // § aggiorno a mano
        $post->title = $data["title"];
        $post->image_url = $data["image_url"];
        $post->content = $data["content"];
        $post->slug = Str::slug($data['title'], '-');
        $post->categories()->sync($data['category']);
        $post->save();

        return redirect()->route('admin.posts.show', $post)
        ->with('message', $data['title']. " è stato modificato con successo.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted-message', "$post->title è stato eliminato con successo dalla lista dei post");
        //
    }
}
