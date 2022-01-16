<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class ActiveController extends Controller
{
    public function index()
    {
        $task = new Task;
        $data = [
            'tasks_active' => $task->getDataTask('task_is_active')
        ];
        return view('active')->with($data);
    }
}
