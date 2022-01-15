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
        return view('beranda')->with($data);
    }
}
