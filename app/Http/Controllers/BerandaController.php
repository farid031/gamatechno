<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class BerandaController extends Controller
{
    public function index() {
        $task = Task::all();
    
        return view('beranda')->with("tasks", $task);
    }
}
