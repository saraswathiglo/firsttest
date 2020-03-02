@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Data</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{url('firsttest')}}">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                Please fix the following errors
                            </div>
                        @endif
                        
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
                            @if($errors->has('title'))
                                <span class="help-block">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url">Url</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="URL" value="{{ old('url') }}">
                            @if($errors->has('url'))
                                <span class="help-block">{{ $errors->first('url') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
