@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-8 col-md-offset-2">
    <div class="starter-template">
        <h1>Hello welcome to Simple Question Forum</h1>
        <p class="lead">To submit answers please <a href="{{ url('/login') }}" class="btn-link">login</a> if you’re not having account or <a href="{{ url('/register') }}" class="btn-link">register</a>.</p>
      </div>
    </div>
</div>
@endsection
