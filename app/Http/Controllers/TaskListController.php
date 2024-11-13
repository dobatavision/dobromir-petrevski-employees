<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskListController extends Controller
{
    public function index()
    {
        $taskList = ['employees'];

        return view('welcome', ['task_list' => $taskList] );
    }
}
