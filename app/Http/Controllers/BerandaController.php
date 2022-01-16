<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class BerandaController extends Controller
{
    public function index() {
        $task = new Task;
        $data = [
            'tasks_active'  => $task->getDataTask('task_is_active'),
            'tasks_complete'=> $task->getDataTask('task_is_completed')
        ];
        return view('all')->with($data);
    }

    public function active()
    {
        $task = new Task;
        $data = [
            'count_active'  => $task->getCountTask('task_is_active'),
            'tasks_active' => $task->getDataTask('task_is_active')
        ];
        return view('active')->with($data);
    }

    public function complete()
    {
        $task = new Task;
        $data = [
            'count_complete'  => $task->getCountTask('task_is_completed'),
            'tasks_complete' => $task->getDataTask('task_is_completed')
        ];
        return view('complete')->with($data);
    }
}
