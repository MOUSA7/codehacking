@extends("layouts.admin")

@section('content')

    <h1>Edit Categories</h1>

    {!! Form::model($categories,['method'=>'PATCH','action'=>['AdminCategoryController@update',$categories->id]]) !!}

     <div class="form-group">

    {!! Form::label('name','Name :') !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}

    </div>

    <div class="form-group">
        {!! Form::submit('Edit Category',['class'=>'btn btn-primary col-sm-4']) !!}
    </div>
    {!! Form::close() !!}

    {!! Form::open(['method'=>'DELETE','action'=>['AdminCategoryController@destroy',$categories->id]]) !!}


    <div class="form-group">
        {!! Form::submit('Delete Category',['class'=>'btn btn-danger col-sm-4']) !!}
    </div>
    {!! Form::close() !!}

    @stop