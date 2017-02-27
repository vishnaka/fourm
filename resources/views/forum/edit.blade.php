@extends('layouts.app')

@section('content')

<div class="container">
        <div class="btn-group">
        <a href="{{ url('/forum') }}" class="btn btn-primary">
            Back
        </a>
    </div>
    <div class="page-header">
        <h1>{{ __('messages.forumHeadingTitleAdminEdit') }}</h1>
    </div>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-md-8 col-md-offset-2">
    {!! Form::model($forum, ['method' => 'PATCH','route' => ['forum.update', $forum->forum_id]]) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Question:</strong>
                {!! Form::textarea('question', null, array('placeholder' => 'Question','class' => 'form-control','style'=>'height:100px')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {!! Form::submit('Update Question', ['class' => 'btn btn-primary']) !!}
        </div>

    </div>
    {!! Form::close() !!}
    </div>
</div>
@endsection
