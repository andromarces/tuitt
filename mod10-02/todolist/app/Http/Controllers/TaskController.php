<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Session;

class TaskController extends Controller
{
    function displayTasks () {
        $tasks = Task::all();

        return view('tasks', compact('tasks'));
    }

    function addTask (Request $request) {
        $new_task = new Task();
        $new_task->name = $request->task;
        $new_task->save();
        
        return redirect('/');
    }

    function editTask (Request $request, $id) {
        $edit_task = Task::find($id);

        $rules = array(
            'task' => 'required | alpha_num | min:5'
        );
        $this->validate($request,$rules);
        
        $edit_task->name = $request->task;
        $edit_task->save();
        
    }

    function deleteTask ($id) {
        $task = Task::find($id);
        $task->delete();

        Session::flash('status', 'Task was successfully deleted!');
        
        return redirect('/');
    }

}
