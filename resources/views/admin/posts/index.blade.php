@extends("layouts.admin")

@section('content')

    <h1>Posts</h1>

    <table class="table">
        <thead>
        <tr>
        <th>Id</th>
        <th>Owner</th>
        <th>photo</th>
        <th>Category</th>
        <th>title</th>
        <th>body</th>
        <th>Link</th>
        <th>Comments</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        </tr>
        </thead>

        <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td><a href="{{route('admin.posts.edit',$post->id)}}">{{$post->user->name}}</a></td>
            <td><img height="50" src="{{$post->Photo ? $post->photo->file:'http://placehold.it/400x400'}}" alt=""></td>
            <td>{{$post->category ? $post->category->name:'UNCategorized'}}</td>
            <td>{{$post->title}}</td>
            <td>{{str_limit($post->body,15)}}</td>
            <td><a href="{{route('post',$post->slug)}}">view post</a></td>
            <td><a href="{{route('admin.Comments.show',$post->id)}}">Show Comment</a></td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
        </tr>
            @endforeach
        </tbody>

    </table>

    @stop
