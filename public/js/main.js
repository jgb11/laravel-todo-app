$(function () {
  $('[data-toggle="tooltip"]').tooltip();

  var $urlBase = document.location.protocol + '//' + document.location.hostname + ':' + document.location.port + '/pc-laravel-tasks/public/';

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).on('click', '.delete', function(){
    var $taskId = $(this).data('id');
    $.ajax({
      url: $urlBase + "delete/" + $taskId,
      dataType: 'html',
      success: function(data) {
        $(document).find('#tasks').html(data);
      },
      error: function() {
        alert('Error');
      }
    });
  });

  $(document).on('click', '.complete', function(){
    var $taskId = $(this).data('id');
    $.ajax({
      url: $urlBase + "done/" + $taskId,
      dataType: 'html',
      success: function(data) {
        $(document).find('#tasks').html(data);
      },
      error: function() {
        alert('Error');
      }
    });
  });

  $(document).on('click', '.save', function(){
    var $task = $('#taskText').val();
    $.ajax({
      url: $urlBase + "create",
      dataType: 'html',
      method: 'post',
      data: {
        task: $task
      },
      success: function(data) {
        $(document).find('#tasks').html(data);
        $('#taskText').val('');
      },
      error: function() {
        alert('Error');
      }
    });
  });
});
