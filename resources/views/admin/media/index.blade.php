@extends('layouts.admin')

@section('content')


        <table class="table">
                <thead>
                 <tr>
                    <th>Id</th>
                    <th>file</th>
                    <th>Email</th>


                 </tr>
                </thead>
                <tbody>
                @foreach($photos as $photo)

                    <tr>
                        <td>{{$photo->id}}</td>
                        <td><img src="{{$photo->file}}" height="50" alt=""></td>
                        <td>{{$photo->created_at?$photo->created_at:'No Images Now'}}</td>
                        <td>{!! Form::open(['method'=>'DELETE','action'=>['MediaController@destroy',$photo->id]]) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                            </div>
                        {!! Form::close() !!}
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

    @stop