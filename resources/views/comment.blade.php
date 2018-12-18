@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Comment</div>
                    <div class="card-body">
                        {{$comment->body}}
                    </div>
                    <div class="card-footer">
                        {{ Form::open(['method'  => 'DELETE', 'route' => ['comments.destroy', $answer, $comment->id]])}}
                        <button class="btn btn-danger float-right mr-2" value="submit" type="submit" id="submit">Delete
                        </button>
                        {!! Form::close() !!}
                        <a class="btn btn-primary float-right" href="{{ route('comments.edit',['answer_id'=> $answer, 'comment_id'=> $comment->id, ])}}">
                            Edit Comment
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection