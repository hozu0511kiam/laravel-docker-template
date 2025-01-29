<?php

namespace App\Http\Controllers;

use App\Todo;

use Illuminate\Http\Request;

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
        return view('todo.create');
        //view('フォルダ名.ファイル名', 使いたい配列)
    }

    public function store(Request $request)
    {
        $inputs = $request->all();

        $todo = new Todo();
        $todo->fill($inputs);
        
        $todo->save();

        return redirect()->route('todo.index');
    }
}