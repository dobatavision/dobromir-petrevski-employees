@extends('layout')

@section('content')

    <h1><b>Hello, this is a Dobromir Petrevski's Tasks list</b></h1>
    <h2>Please select a task from the links below:</h2>
        @foreach($task_list as $task)
        <nav class="w-full py-4 bg-blue-800 shadow">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between">
                <nav>
                    <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                        <li><a class="hover:text-gray-200 hover:underline px-4" href="task/{{$task}}">{{ucfirst($task)}}</a></li>
                    </ul>
                </nav>
            </div>

        </nav>
        @endforeach
@endsection
