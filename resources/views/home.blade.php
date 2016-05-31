@extends('layouts.app')

@section('title')
  Home
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form class="" action="{{ url('create') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('task') ? ' has-error' : '' }}">
                <div class="input-group">
                  <input type="text" name="task" class="form-control" placeholder="{{ trans('messages.taskHelp') }}">
                  <span class="input-group-btn">
                    <input type="submit" name="{{ trans('messages.save') }}" value="{{ trans('messages.save') }}" class="btn btn-primary">
                  </span>
                </div>
                @if ($errors->has('task'))
                  <span class="help-block">
                    <strong>{{ $errors->first('task') }}</strong>
                  </span>
                @endif
              </div>
            </form>

            <p>&nbsp;</p>

            <table class="table table-responsive table-striped">
              @forelse($tasks as $task)
                @if($task->status == 'Completada')
                <tr class="success">
                @else
                <tr>
                @endif
                  <td class="col-xs-8">
                    {{ $task->task }}
                  </td>
                  <td>
                    @if($task->status == 'Pendiente')
                      {{ trans('messages.todo') }}
                    @else
                      {{ trans('messages.done') }}
                    @endif
                  </td>
                  <td class="text-right">
                    @if($task->status != 'Completada')
                    <a href="{{ url('done', [$task->id]) }}" class="btn btn-xs btn-success" title="Marcar como completada">
                      <span class="glyphicon glyphicon-ok"></span>
                    </a>
                    @endif
                    <a href="{{ url('delete', [$task->id]) }}" class="btn btn-xs btn-danger" title="Eliminar tarea">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </td>
                </tr>
              @empty
                <h2>{{ trans('messages.noTasks') }}</h2>
              @endforelse
            </table>
            <div class="text-center">
              {{ $tasks->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
