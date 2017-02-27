@extends('layouts.app')

@section('content')

<div class="container">
    <div class="btn-group">
        <a href="{{ url('/member') }}" class="btn btn-primary">
            Back
        </a>
    </div>
    <div class="page-header">
        <h1>{{ __('messages.memberHeadingTitleAdminEdit') }}</h1>
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
    {!! Form::model($member, ['method' => 'PATCH','route' => ['member.update', $member->id]]) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name(<label>{{ $member->email }}</label>)</strong>
                 {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
            
            <div class="form-group">
                <strong>Group</strong>
                 <select class="form-control" name="group_id">
                                    @foreach ($groups as $grp)
                                        <option value="{{$grp->group_id}}" @if ($grp->group_id == $member->group_id) selected @endif >{{$grp->group_name}}</option>
                                    @endforeach
                               </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {!! Form::submit('Update Member', ['class' => 'btn btn-primary']) !!}
        </div>

    </div>
    {!! Form::close() !!}
    </div>
</div>
@endsection
