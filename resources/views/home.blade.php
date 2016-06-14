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
                  <td>
                    <i class="fa fa-check" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('messages.done') }}"></i>
                  </td>
                @else
                <tr>
                  <td>
                    <i class="fa fa-clock-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('messages.todo') }}"></i>
                  </td>
                @endif
                  <td>
                    @if($task->author_id === Auth::user()->id)
                      <i class="fa fa-user" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('messages.author') }}"></i>
                    @else
                      <i class="fa fa-users" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('messages.shared') }}"></i>
                    @endif
                  </td>
                  <td class="col-xs-8">
                    @if($task->author_id === Auth::user()->id)
                    <a href="#collapseTask{{ $task->id }}" data-toggle="collapse">
                      {{ $task->task }}
                    </a>
                    <div class="collapse" id="collapseTask{{ $task->id }}">
                      <h4>{{ trans('messages.shareTask') }}</h4>
                      <form class="" action="{{ url('share') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <div class="input-group">
                          <input type="text" name="email" class="form-control input-sm" placeholder="{{ trans('messages.shareTaskText') }}">
                          <span class="input-group-btn">
                            <input type="submit" name="{{ trans('messages.share') }}" value="{{ trans('messages.share') }}" class="btn btn-primary btn-sm">
                          </span>
                        </div>
                      </form>
                    </div>
                    @else
                      {{ $task->task }}
                    @endif
                  </td>
                  <td>
                    @if($task->status == 'Pendiente')
                      {{ trans('messages.todo') }}
                    @else
                      {{ trans('messages.done') }}
                    @endif
                  </td>
                  <td class="text-right">
                    @if($task->author_id === Auth::user()->id)
                      @if($task->status != 'Completada')
                      <a href="{{ url('done', [$task->id]) }}" class="btn btn-xs btn-success" title="{{ trans('messages.markComplete') }}">
                        <span class="glyphicon glyphicon-ok"></span>
                      </a>
                      @endif
                      <a href="{{ url('delete', [$task->id]) }}" class="btn btn-xs btn-danger" title="{{ trans('messages.deleteTask') }}">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>
                    @else
                      @if($task->status != 'Completada')
                      <a href="{{ url('done', [$task->id]) }}" class="disabled btn btn-xs btn-success" title="{{ trans('messages.markComplete') }}">
                        <span class="glyphicon glyphicon-ok"></span>
                      </a>
                      @endif
                      <a href="{{ url('delete', [$task->id]) }}" class="disabled btn btn-xs btn-danger" title="{{ trans('messages.deleteTask') }}">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>
                    @endif
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
