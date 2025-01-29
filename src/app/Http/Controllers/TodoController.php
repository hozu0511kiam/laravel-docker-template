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
        return view('todo.index');
        //view('フォルダ名.ファイル名', 使いたい配列)
    }

    public function store(Request $request)
    {
    $content = $request->input('content');
    // 1. todosテーブルの1レコードを表すTodoクラスをインスタンス化
    $todo = new Todo();
    // 2. Todoインスタンスのカラム名のプロパティに保存したい値を代入
    $todo->content = $content;
    // 3. Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行
    $todo->save();

    return redirect()->route('todo.index');
    }
}