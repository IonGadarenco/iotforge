<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getPendingTasks()
    {
        $tasks = Task::where('status', 'pending')->first();

        if ($tasks) {
            $tasks->status = 'processed';
            $tasks->save();
        }

        return response()->json($tasks);
    }

    public function updateTaskStatus(Request $request, $id)
    {
        $task = Task::find($id);

        if ($task) {
            $task->status = $request->status;
            $task->save();
        }

        return response()->json($task);
    }
}
