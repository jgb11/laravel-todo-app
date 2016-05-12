<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Task;
use App\User;
use Auth;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tasks = Task::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(6);
      return view('home', ['tasks' => $tasks]);
    }

    public function postCreate(Request $req)
    {
      $task = new Task();
      $task->task = $req->task;
      $task->user_id = Auth::user()->id;
      $task->save();

      return redirect('/home');
    }

    public function postChangePass(Request $req)
    {
      if (Hash::check($req->oldPass, Auth::user()->password)) {
        if($req->newPass === $req->repeatNewPass){
          $user = User::find(Auth::user()->id);
          $user->password = Hash::make($req->newPass);
          $user->save();
        } else {
          // $req->session->flash('error', 'Las contraseñas nuevas no coinciden.');
        }
      } else {
        // $req->session->flash('error', 'La contraseña actual no coincide con la del usuario.');
      }


      return redirect('/settings');
    }

    public function getDone($id)
    {
      $task = Task::find($id);
      if($task->user_id === Auth::user()->id && $task->status === 'Pendiente') {
        $task->status = 'Completada';
        $task->save();
      }

      return redirect('/home');
    }

    public function getDelete($id)
    {
      $task = Task::find($id);
      if($task->user_id === Auth::user()->id) {
        $task->delete();
      }

      return redirect('/home');
    }

    public function getSettings()
    {
      return view('auth/settings');
    }
}
