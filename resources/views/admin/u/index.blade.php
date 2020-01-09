@extends('layouts.admin')

@section('content')

    <h1>Users</h1>

    <table class="table">
        <thead>
        <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>

        </thead>
        </tr>
        <tbody>
        @foreach($users  as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td><img height="50" src="{{$user->photo ?$user->photo->file:'http://placehold.it/400x400'}}" alt="" ></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role ? $user->role->name:'Not Found'}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>


    @stop