<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Template • Todo</title>
    <link rel="stylesheet" href="{{URL::asset('template/css/base.css')}}">
    <link rel="stylesheet" href="{{URL::asset('template/css/index.css')}}">
    <!-- CSS overrides - remove if you don't need it -->
    <link rel="stylesheet" href="{{URL::asset('template/css/app.css')}}">
</head>

<body>
    <section class="todoapp">
        <header class="header">
            <h1>Super2Do</h1>
            <input type="text" class="new-todo" id="new-todo" placeholder="What needs to be done?" autofocus>
        </header>
        <!-- This section should be hidden by default and shown when there are todos -->
        @yield('content')
    </section>
    <!-- Scripts here. Don't remove ↓ -->
    <script src="{{URL::asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{URL::asset('template/js/app.js')}}"></script>
</body>

</html>