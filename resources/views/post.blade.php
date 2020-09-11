             {{-- صفحة عرض المنشورات والردود--}}
@extends('layouts.blog-post')

@section('content')

    <!-- Title -->
    <h1 class="mt-4">{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by
        <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p>Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="{{$post->photo->file}}" alt="">

    <hr>

    <!-- Post Content -->

    <blockquote class="blockquote">
        <p class="mb-0">{{$post->body}}.</p>
        <footer class="blockquote-footer">
            @if(Session::has('msg_comment'))

                <p class="bg-primary">{{session('msg_comment')}}</p>

            @endif
        </footer>
    </blockquote>


    <hr>

    <!-- Comments Form -->
    @if(Auth::check())
    <div class="card my-4">
        <h5>Leave a Comment:</h5>

    {!! Form::open(['method'=>'POST', 'action'=> 'AdminCommentsController@store','files'=>true]) !!}

        <input type="hidden" name="post_id" value="{{$post->id}}">

          <div class="form-group">
                 {!! Form::label('body', 'Body:') !!}
                 {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>3])!!}
           </div>

             <div class="form-group">
                {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
             </div>

           {!! Form::close() !!}
        @endif
    </div>

    <!-- Single Comment -->
    @if(count($comments)>0)
        @foreach($comments as $comment)
    <div class="media mb-4">
        <img height="50" class="d-flex mr-3 rounded-top" src="{{$comment->photo}}" alt="">
        <div class="media-body">
            <h5 class="mt-0">{{$post->user->name}}
            <small>{{$comment->created_at->diffForHumans()}}</small>  </h5>
             {{$comment->body}}



            @if(count($comment->replies)>=0 )
                <div class="comment-reply-container">
                    <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                    <div class="comment-reply">

                        {!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@createreply']) !!}

                        <input type="hidden" name="comment_id" value="{{$comment->id}}">

                        <div class="form-group">
                            {!! Form::label('body','Comment') !!}
                            {!! Form::textarea('body',null,['class'=>'form-control','rows'=>1,'style'=>'height: 40px']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('submit',['class'=>'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div><!--Comment-reply-container div!-->
                </div><!--Comment-reply div!-->
                @foreach($comment->replies as $reply)

                    @if($reply->is_active ==1)
            <div class="media mt-4">
                <img width="50" class="d-flex mr-3 rounded" src="{{$reply->photo}}"  alt="">
                <div class="media-body">
                    <h5 class="mt-0">{{$reply->author}}</h5>
                    <small>{{$reply->created_at->diffForHumans()}}</small>
                   {{$reply->body}}
                    {{-- {{$post->body}} --}}
                </div>
            </div>

                    @endif
                @endforeach
                @endif

</div>
</div>
@endforeach
@endif

<!-- Comment with nested comments -->

@stop


              @section('scripts')
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

                  <script>
                     $(document).ready(function () {
                         $(".comment-reply-container .toggle-reply").click(function () {
                             $(this).next().slideToggle('slow');
                         });
                     });

                 </script>
             @stop

