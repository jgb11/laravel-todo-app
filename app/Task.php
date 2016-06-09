<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['task'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
