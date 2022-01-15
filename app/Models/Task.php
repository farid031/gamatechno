<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    public function getCountTask($flag)
    {
        $task = DB::table('tasks')
            ->select('*')
            ->where($flag, '=', 1)
            ->count();

        return $task;
    }

    public function getDataTask($flag)
    {
        $task = DB::table('tasks')
            ->select('*')
            ->where($flag, '=', 1)
            ->get();

        return $task;
    }
}
