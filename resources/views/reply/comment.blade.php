@extends('layouts.app')

@section('content')

<div class="container">
    <div class="btn-group">
        <a href="{{ url('/home') }}" class="btn btn-primary">
            Back
        </a>
    </div>
    <div class="page-header">
        <h1>{{ $forum->question }}</h1>
    </div>
    <!-- will be used to show any messages -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
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
        {!! Form::open(array('route' => 'reply.store','method'=>'POST')) !!}
        {{ Form::hidden('forum_id',$forumId) }}
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Reply:</strong>
                    {!! Form::textarea('reply', null, array('placeholder' => 'Reply','class' => 'form-control','style'=>'height:100px')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                {!! Form::submit('Reply', ['class' => 'btn btn-primary']) !!}
            </div>

        </div>
        {!! Form::close() !!}
        <div class="row">&nbsp;</div>
        @if(!$comments->isEmpty())
        @foreach($comments as $value)
        <div class="panel panel-default">
            <div class="panel-heading">{{ $value->reply}}</div>
            <div class="panel-body">
                Answer by <strong>{{ $value->name}}</strong>
                On <span class="time-format">{{ $value->reply_on}}</span>
            </div>
        </div>
        @endforeach
        @else
        <div class="empt-rec">{{ __('messages.emptydata') }}</div>
        @endif
    </div>
</div>
@endsection
