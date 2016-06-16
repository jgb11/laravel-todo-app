@extends('layouts.app')

@section('title')
  {{ trans('messages.404') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <h2>{{ trans('messages.404') }}</h2>
        <p>
          {{ trans('messages.text404') }}
        </p>
      </div>
    </div>
  </div>
@endsection
