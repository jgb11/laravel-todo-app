<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Task;
use App\User;
use Auth;
use Hash;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      if(session()->has('lang')){
        App::setLocale(session()->get('lang'));
      }
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
      $this->validate($req, [
        'task' => 'required|max:255',
      ]);
      $task = new Task();
      $task->task = $req->task;
      $task->user_id = Auth::user()->id;
      $task->save();
      session()->flash('success', 'Tarea creada correctamente.');
      return redirect('/home');
    }

    public function postChangePass(Request $req)
    {
      $this->validate($req, [
        'oldPass' => 'required',
        'newPass' => 'required|min:6',
        'repeatNewPass' => 'required|min:6',
      ]);

      if (Hash::check($req->oldPass, Auth::user()->password)) {
        if($req->newPass === $req->repeatNewPass){
          $user = User::find(Auth::user()->id);
          $user->password = Hash::make($req->newPass);
          session()->flash('success', 'Se ha modificado la contraseña.');
          $user->save();
        } else {
          session()->flash('error', 'Las contraseñas no coinciden.');
        }
      } else {
        session()->flash('error', 'Contraseña incorrecta.');
      }

      return redirect('/settings');
    }

    public function getDone($id)
    {
      $task = Task::find($id);
      if($task->user_id === Auth::user()->id && $task->status === 'Pendiente') {
        $task->status = 'Completada';
        session()->flash('info', 'Tarea completada.');
        $task->save();
      }

      return redirect('/home');
    }

    public function getDelete($id)
    {
      $task = Task::find($id);
      if($task->user_id === Auth::user()->id) {
        session()->flash('info', 'Tarea eliminada.');
        $task->delete();
      } else {
        session()->flash('error', 'No tienes permiso para hacer esto.');
      }

      return redirect('/home');
    }

    public function getSettings()
    {
      return view('auth/settings');
    }
}
