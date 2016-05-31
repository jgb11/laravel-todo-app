@extends('layouts.app')

@section('title')
  {{ trans('messages.settings') }}
@endsection

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
      <h2>{{ trans('messages.settings') }}</h2>
      <p>&nbsp;</p>
      <div class="panel panel-default">
          <div class="panel-heading">{{ trans('messages.changePass') }}</div>
          <p>&nbsp;</p>
          <form class="form-horizontal" action="{{ url('change-pass') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('oldPass') ? ' has-error' : '' }}">
                <label for="oldPass" class="col-sm-4 control-label">{{ trans('messages.actualPass') }}</label>
                <div class="col-sm-6">
                  <input type="password" name="oldPass" class="form-control" placeholder="{{ trans('messages.actualPass') }}">
                  @if ($errors->has('oldPass'))
                    <span class="help-block">
                      <strong>{{ $errors->first('oldPass') }}</strong>
                    </span>
                  @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('newPass') ? ' has-error' : '' }}">
                <label for="newPass" class="col-sm-4 control-label">{{ trans('messages.newPass') }}</label>
                <div class="col-sm-6">
                  <input type="password" name="newPass" class="form-control" placeholder="{{ trans('messages.newPass') }}">
                  @if ($errors->has('newPass'))
                    <span class="help-block">
                      <strong>{{ $errors->first('newPass') }}</strong>
                    </span>
                  @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('repeatNewPass') ? ' has-error' : '' }}">
                <label for="repeatNewPass" class="col-sm-4 control-label">{{ trans('messages.repeatNewPass') }}</label>
                <div class="col-sm-6">
                  <input type="password" name="repeatNewPass" class="form-control" placeholder="{{ trans('messages.repeatNewPass') }}">
                  @if ($errors->has('repeatNewPass'))
                    <span class="help-block">
                      <strong>{{ $errors->first('repeatNewPass') }}</strong>
                    </span>
                  @endif
                </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-9">
                <input type="submit" class="btn btn-primary" value="{{ trans('messages.save') }}">
              </div>
            </div>
          </form>
      </div>
  </div>
</div>
@endsection
