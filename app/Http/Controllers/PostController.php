<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\posts\createPostRequest;
use App\Http\Requests\posts\UpdatePostRequest;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('verifyPostMiddleware')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isAdmin()){
            $posts = Post::all();
        } else {
            $posts = auth()->user()->posts;
        }

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createPostRequest $request)
    {
        $image = $request->image->store('posts');

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);

        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post has been added successfuly. Please wait until admin accept it.');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(auth()->user()->id == $post->user_id || auth()->user()->isAdmin()){
            return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'content', 'published_at', 'category_id']);
        if($request->hasFile('image')){
            $post->deleteImage();
            $data['image'] = $request->image->store('posts');
        }
        $post->update($data);
        $post->tags()->sync($request->tags);
        session()->flash('success', 'Post has been updated successfuly.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if($post->trashed()){
            $post->deleteImage();
            $post->forceDelete();
            session()->flash('success', 'Post has been deleted successfuly.');
            return redirect(route('trashed-posts.index'));
        } else {
            $post->delete();
            session()->flash('success', 'Post has been trashed successfuly.');
            return redirect(route('posts.index'));
        }
    }

    public function trashed(){
        if(auth()->user()->isAdmin()){
            $trashed = Post::onlyTrashed()->get();
        } else {
            $trashed = auth()->user()->posts()->onlyTrashed()->get();
        }

        return view('posts.index')->withPosts($trashed);
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post has been restored successfuly.');

        return redirect()->back();
    }

    public function accept(Post $post){
        $post->accepted = true;
        $post->save();
        return redirect()->back();
    }
}
