@extends('layouts.app')

@section('content')
    <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                'headers':{
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $('.like-btn').click(function () {
                var val = $(this).data("id");
                var id2 = "#like-" + val;
                var a = parseInt($(id2).text())
                $.post('/like/'+val);
                $.get('/getLikes/'+val,function(data){
                    $(id2).text(data);
                });
            });
        });

    </script>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <ul class="list-group">
                <center><li class="list-group-item">News Feed</li></center><br>
                @for ($i = 0; $i < count($images); $i++)
                    <li class="list-group-item">{{$images[$i]->user_id}}</li>
                    <img src="/storage/{{$images[$i]->name}}" alt="ALT NAME" class="img-responsive" />
                    <button data-id="{{$images[$i]->id}}" class="like-btn btn btn-success">Like</button>
                    <span id="like-{{$images[$i]->id}}">{{$images[$i]->likes()->count()}}</span><br><br>
                @endfor
            </ul>

            <form action="/images/add" method="post" class="form-group" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="file" name="image"><br>
                <button type="submit" class="btn btn-primary">Add Image</button>
            </form>
        </div>
    </div>

@endsection