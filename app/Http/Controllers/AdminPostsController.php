<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Category;
use App\Comment;
use App\Http\Requests\AdminPostsRequest;
use App\photo;
use App\post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminPostsController extends Controller
{

    public function index()
    {
        $posts = post::all();
        return view('admin.posts.index',compact('posts'));
        //
    }

    public function create()
    {
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.create',compact('categories'));
        //
    }


    public function store(AdminPostsRequest $request)
    {
        $input = $request->all();
        $user = Auth::user();

        if ($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo = photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }
        $user->posts()->create($input);

        return redirect('/admin/posts');
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $post = post::find($id);
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.edit',compact('post','categories'));
        //
    }


    public function update(Request $request, $id)
    {
        $input = $request->all();
        $slug = Str::slug('Laravel 5 Framework', '-');
        $user = Auth::user();

        if ($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo = photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }
        $user->posts()->whereId($id)->first()->update($input);
        return redirect('/admin/posts');
        //
    }

    public function destroy($id)
    {
        $post = post::find($id);
        unlink(public_path().$post->photo->file);
        $post->delete();

        return redirect('/admin/posts');
        //
    }
    public function post($slug){
        $post = Post::where('title','=',$slug)->firstOrFail();
        $comments = $post->comments()->whereIsActive(1)->get();
        return view('post',compact('post','comments'));
    }


}
//Post::where('alternate,'=',$slug)->firstOrFail();
