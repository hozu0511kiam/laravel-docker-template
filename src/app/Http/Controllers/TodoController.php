<?php

namespace App\Http\Controllers;

use App\Todo;

use Illuminate\Http\Request;

class TodoController extends Controller //ControllerをTodoControllerにextendsで継承している
{
    public function index()//Todo $todoでもOK
    {
        $todo = new Todo();//Todoインスタンス化
        $todos = $todo->all();//SELECT（DB取得）

        return view('todo.index', ['todos' => $todos]);
        //view('フォルダ名.ファイル名', 使いたい配列)
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)//Requestインスタンス化
    {
        //dd tokenとcontent
        $inputs = $request->all();//追加したToDoの内容
        
        $todo = new Todo();
        $todo->fill($inputs);
        //fillメソッドはfillable（Todo.php）とセット
        //Todoインスタンスの各プロパティに一括で代入する
        
        $todo->save();//INSERT（DBの追加）

        return redirect()->route('todo.index');
    }
}