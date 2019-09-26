<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Post;

class WelcomeController extends Controller
{
    public function index(Request $request){
        return view('welcome')
        ->with('posts', Post::searched()->orderBy('published_at')->simplePaginate(4))
        ->with('tags', Tag::all())
        ->with('categories', Category::all());
    }

    public function show(Post $post){
        return view('users.show')->with('post', $post);
    }

    public function showCategory(Category $category){
        return view('users.category')
        ->with('category', $category)
        ->with('posts', $category->posts()->searched()->simplePaginate(4))
        ->with('tags', Tag::all())
        ->with('categories', Category::all());
    }

    public function showTag(Tag $tag){
         return view('users.tag')
        ->with('tag', $tag)
        ->with('posts', $tag->posts()->searched()->simplePaginate(4))
        ->with('tags', Tag::all())
        ->with('categories', Category::all());
    }
}
