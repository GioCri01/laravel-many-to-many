<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use App\Category;
use App\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view("post-crud.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view("post-crud.create", compact("categories","tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
       $data = $request->all();
       $new_post = new Post();
       $data["slug"] = Post::generateSlug($data["title"]);
       $new_post->fill($data);

       $new_post->save();

       if(array_key_exists("tags", $data)){
        $new_post->tags()->attach($data["tags"]);
       }

       return redirect()->route("admin.post.show" , $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
       return view("post-crud.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
       return view("post-crud.edit", compact("post","categories","tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->all();

        if($data["title"] != $post->title){
            $data["slug"] = Post::generateSlug($data["title"]);
        }

        $post->update($data);

        if(array_key_exists("tags", $data)){
            $post->tags()->sync($data["tags"]);
        }else{
            $post->tags()->detach();
        }

        return redirect()->route("admin.post.show",$post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route("admin.post.index")->with("post_eliminato","post eliminato correttamente");
    }
}
