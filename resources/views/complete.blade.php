@extends('template')

@section('content')
<section class="main">
    <input id="toggle-all" class="toggle-all" type="checkbox">
    <label for="toggle-all">Mark all as complete</label>
    <ul class="todo-list">
        <!-- These are here just to show the structure of the list items -->
        <!-- List items should get the class `editing` when editing and `completed` when marked as completed -->
        @foreach($tasks_complete as $data)
        <li class="completed">
            <div class="view">
                <input class="toggle" id="set-active_{{$data->id}}" type="checkbox" checked>
                <label>{{$data->task_desc}}</label>
                <button class="destroy" id="destroy_{{$data->id}}" onclick="return confirm('Are you sure to delete this data?')"></button>
            </div>
            <input class="edit" value="Create a Todo template">
        </li>
        @endforeach
    </ul>
</section>
<!-- This footer should be hidden by default and shown when there are todos -->
<footer class="footer">
    <!-- This should be `0 items left` by default -->
    <span class="todo-count"><strong id="item-left">{{$count_complete}}</strong> item left</span>
    <!-- Remove this if you don't implement routing -->
    <ul class="filters">
        <li>
            <a id="all-page" href="{{URL::to('/')}}">All</a>
        </li>
        <li>
            <a id="active-page" href="{{URL::to('/active')}}">Active</a>
        </li>
        <li>
            <a id="complete-page" class="selected" href="{{URL::to('/complete')}}">Completed</a>
        </li>
    </ul>
    <!-- Hidden if no completed items are left ↓ -->
    <button class="clear-completed" id="clear-completed">Clear completed</button>
</footer>
@endsection