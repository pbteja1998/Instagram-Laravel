@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <ul class="list-group">
                <center><li class="list-group-item">Follow Users</li></center><br>
                @foreach($users as $user)

                    <div class="row">
                        <div class="col-md-6 col-md-offset-2"><li class="list-group-item">{{$user->name}}</li></div>
                        <form action="/follow/{{$user->id}}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-4"><button class="btn btn-success" type="submit">Follow</button></div>
                        </form>
                    </div><br>
                @endforeach
            </ul>

            <ul class="list-group">
                <center><li class="list-group-item">Following Users</li></center><br>
                @foreach($following_users as $user)

                    <div class="row">
                        <div class="col-md-6 col-md-offset-2"><li class="list-group-item">{{$user->name}}</li></div>
                        <form action="/follow/{{$user->id}}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-4"><button class="btn btn-danger" type="submit">UnFollow</button></div>
                        </form>
                    </div><br>
                @endforeach
            </ul>
        </div>
    </div>
@endsection