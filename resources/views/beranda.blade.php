@extends('template')

@section('content')
<section class="main">
    <input id="toggle-all" class="toggle-all" type="checkbox">
    <label for="toggle-all">Mark all as complete</label>
    <ul class="todo-list">
        <!-- These are here just to show the structure of the list items -->
        <!-- List items should get the class `editing` when editing and `completed` when marked as completed -->
        @foreach($tasks_active as $data)
        <li>
            <div class="view">
                <input class="toggle" id="set-complete_{{$data->id}}" type="checkbox">
                <label>{{$data->task_desc}}</label>
                <button class="destroy" id="destroy_{{$data->id}}" onclick="return confirm('Are you sure to delete this data?')"></button>
            </div>
            <input class="edit" value="Rule the web">
        </li>
        @endforeach

        @foreach($tasks_complete as $data)
        <li class="completed">
            <div class="view">
                <input class="toggle" type="checkbox" checked>
                <label>{{$data->task_desc}}</label>
                <button class="destroy" id="destroy_{{$data->id}}" onclick="return confirm('Are you sure to delete this data?')"></button>
            </div>
            <input class="edit" value="Create a Todo template">
        </li>
        @endforeach
    </ul>
</section>
@endsection