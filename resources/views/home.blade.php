@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header">
        <h1>{{ __('messages.forumHeadingTitle') }}</h1>
    </div>
    @if(!$posts->isEmpty())
    @foreach($posts as $value)
    <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">{{ $value->question}}</div>
        <div class="panel-body">
            Post by <strong>{{ $value->name}}</strong>
            <a href="{{ URL::to('reply/' . $value->forum_id . '/comment') }}">Comments <span class="badge">{{ $value->count}}</span></a>
            On <span class="time-format">{{ $value->forum_on}}</span>
        </div>
    </div>
     </div>
   @endforeach
   @else
   <div class="empt-rec">{{ __('messages.emptydata') }}</div>
   @endif
</div>
@endsection
