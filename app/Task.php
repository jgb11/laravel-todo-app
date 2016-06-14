<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['task', 'author_id'];

    public function users()
    {
      return $this->belongsToMany('App\User');
    }
}
