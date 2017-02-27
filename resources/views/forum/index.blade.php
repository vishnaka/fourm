@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header">
        <h1>{{ __('messages.forumHeadingTitleAdmin') }}</h1>
        <div class="row">
       <a class="btn btn-success" href="{{ route('forum.create') }}"> Create New Post</a>
    </div>
    </div>
    <!-- will be used to show any messages -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    


    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Question</td>
                <td>Create by</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @if(!$forum->isEmpty())
            @foreach($forum as $value)
            <tr>
                <td>{{ $value->question }}</td>
                <td>{{ $value->name }}</td>
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <!-- edit this forum (uses the edit method found at GET /nerds/{id}/edit -->
                    <a class="btn btn-small btn-info" href="{{ URL::to('forum/' . $value->forum_id . '/edit') }}">Edit</a>
                    <!-- show the forum (uses the show method found at GET /forum/{id} -->
                    {!! Form::open(['method' => 'DELETE','route' => ['forum.destroy', $value->forum_id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="3">{{ __('messages.emptydata') }}<td></tr>
            @endif
        </tbody>
    </table>

</div>
@endsection
