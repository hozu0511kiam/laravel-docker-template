<?php

namespace App\Http\Controllers;

use App\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todo = new Todo();
        $todos = $todo->all();

        return view('todo.index', ['todos' => $todos]);
    }

    public function create()
    {
        $createtododata = 
        return view();
        //view('フォルダ名.ファイル名', 使いたい配列)
    }

}