@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header">
        <h1>{{ __('messages.memberHeadingTitle') }}</h1>
    </div>
    <!-- will be used to show any messages -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">&nbsp;</div>
    <div class="col-md-12 col-md-offset-0">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Group</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @if(!$member->isEmpty())
            @foreach($member as $value)
            <tr>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->group_name }}</td>
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <!-- edit this members (uses the edit method found at GET /controller/{id}/edit -->
                    <a class="btn btn-small btn-info" href="{{ URL::to('member/' . $value->id . '/edit') }}">Edit</a>
                </td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="5">{{ __('messages.emptydata') }}<td></tr>
            @endif
        </tbody>
    </table>
    </div>
</div>
@endsection
