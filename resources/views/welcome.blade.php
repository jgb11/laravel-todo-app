@extends('layouts.app')

@section('title')
  {{ trans('messages.welcome') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('messages.welcome') }}</div>

                <div class="panel-body">
                  <h2>{{ trans('messages.title') }}</h2>
                    {{ trans('messages.infoMsg') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
