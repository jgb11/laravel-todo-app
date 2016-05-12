@extends('layouts.app')

@section('title')
  Settings
@endsection

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
      <h2>Setting</h2>
      <p>&nbsp;</p>
      <div class="panel panel-default">
          <div class="panel-heading">Change password</div>
          <p>&nbsp;</p>
          <form class="form-horizontal" action="{{ url('change-pass') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="oldPass" class="col-sm-4 control-label">Contraseña actual</label>
              <div class="col-sm-6">
                <input type="password" name="oldPass" class="form-control" placeholder="Contraseña actual">
              </div>
            </div>
            <div class="form-group">
              <label for="newPass" class="col-sm-4 control-label">Contraseña nueva</label>
              <div class="col-sm-6">
                <input type="password" name="newPass" class="form-control" placeholder="Contraseña nueva">
              </div>
            </div>
            <div class="form-group">
              <label for="repeatNewPass" class="col-sm-4 control-label">Repetir contraseña nueva</label>
              <div class="col-sm-6">
                <input type="password" name="repeatNewPass" class="form-control" placeholder="Repetir contraseña nueva">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-9">
                <input type="submit" class="btn btn-primary" value="Guardar">
              </div>
            </div>
          </form>
      </div>
  </div>
</div>
@endsection
