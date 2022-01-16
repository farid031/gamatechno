<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function index()
    {
        $task = Task::all();        

        if (count($task) > 0) {
            $response = [
                'status'    => Response::HTTP_OK,
                'message'   => 'Task list',
                'data'  => $task,
            ];

            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'status'    => Response::HTTP_BAD_REQUEST,
                'message'   => 'Task List is empty',
                'data'      => array(),
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }

    public function createNewTask(Request $request)
    {
        $task = new Task;
        $task->task_desc = $request->task_desc;
        $task->task_is_active = true;
        $task->task_is_completed = false;
        $task->created_at = date('Y-m-d H:i:s');
        $task->updated_at = null;
        $task->save();

        $response = [
            'status'    => Response::HTTP_OK,
            'message'   => 'Task list saved',
            'data'      => array(),
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function updateTaskToComplete($id)
    {
        $task = Task::find($id);

        if (!empty($task)) {
            $task->task_desc = $task->task_desc;
            $task->task_is_active = false;
            $task->task_is_completed = true;
            $task->updated_at = date('Y-m-d H:i:s');
            $task->save();

            $response = [
                'status'    => Response::HTTP_OK,
                'message'   => 'Task marked in complete list',
                'data'      => array(),
            ];

            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'status'    => Response::HTTP_BAD_REQUEST,
                'message'   => 'Task List is empty',
                'data'  => array(),
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateTaskToActive($id)
    {
        $task = Task::find($id);

        if (!empty($task)) {
            $task->task_desc = $task->task_desc;
            $task->task_is_active = true;
            $task->task_is_completed = false;
            $task->updated_at = date('Y-m-d H:i:s');
            $task->save();

            $response = [
                'status'    => Response::HTTP_OK,
                'message'   => 'Task marked in active list',
                'data'      => array(),
            ];

            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'status'    => Response::HTTP_BAD_REQUEST,
                'message'   => 'Task List is empty',
                'data'  => array(),
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateAllTaskToComplete()
    {
        $task = Task::all();

        foreach ($task as $data) {
            $data->task_desc = $data->task_desc;
            $data->task_is_active = false;
            $data->task_is_completed = true;
            $data->updated_at = date('Y-m-d H:i:s');
            $data->save();
        }        

        if (count($task) > 0) {
            $response = [
                'status'    => Response::HTTP_OK,
                'message'   => 'All task marked in complete list',
                'data'  => array(),
            ];

            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'status'    => Response::HTTP_BAD_REQUEST,
                'message'   => 'Task List is empty',
                'data'      => array(),
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateAllTaskToActive()
    {
        $task = Task::all();

        foreach ($task as $data) {
            $data->task_desc = $data->task_desc;
            $data->task_is_active = true;
            $data->task_is_completed = false;
            $data->updated_at = date('Y-m-d H:i:s');
            $data->save();
        }

        if (count($task) > 0) {
            $response = [
                'status'    => Response::HTTP_OK,
                'message'   => 'All task marked in active list',
                'data'  => array(),
            ];

            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'status'    => Response::HTTP_BAD_REQUEST,
                'message'   => 'Task List is empty',
                'data'      => array(),
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }

    public function countTask($flag)
    {
        $task = new Task;

        $count_task = $task->getCountTask($flag);

        if ($flag === 'task_is_active') {
            $message = 'Count of active tasks';
        } else {
            $message = 'Count of completed tasks';
        }
        
        $response = [
            'status'    => Response::HTTP_OK,
            'message'   => $message,
            'data'  => array('count' => $count_task),
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function countAllTask()
    {
        $task = new Task;

        $count_task = $task->getCountAllTask();

        $response = [
            'status'    => Response::HTTP_OK,
            'message'   => 'Count all task',
            'data'  => array('count' => $count_task),
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);

        if (!empty($task)) {
            $task->delete();

            $response = [
                'status'    => Response::HTTP_OK,
                'message'   => 'Task deleted',
                'data'  => array(),
            ];

            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'status'    => Response::HTTP_BAD_REQUEST,
                'message'   => 'Task List is empty',
                'data'  => array(),
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }

    public function deleteAllCompleteTask()
    {
        $task = new Task;
        $complete_task = $task->getDataTask('task_is_completed');

        if (count($complete_task) > 0) {
            DB::delete('DELETE from tasks where task_is_completed = 1');

            $response = [
                'status'    => Response::HTTP_OK,
                'message'   => 'All task in complete list deleted',
                'data'  => array(),
            ];

            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'status'    => Response::HTTP_BAD_REQUEST,
                'message'   => 'Task List is empty',
                'data'      => array(),
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }
}
