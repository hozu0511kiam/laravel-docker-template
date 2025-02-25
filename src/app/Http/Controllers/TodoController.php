<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;

//use Illuminate\Http\Request;

class TodoController extends Controller //ControllerをTodoControllerにextendsで継承している
{
    private $todo;

    public function __construct(Todo $todo)//コンストラクタインジェクション
    {
        $this->todo = $todo;
    }

    public function index()//Todo $todoでもOK
    {
        $todos = $this->todo->all();//SELECT（DB取得）
        return view('todo.index', ['todos' => $todos]);
        //view('フォルダ名.ファイル名', 使いたい配列)
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(TodoRequest $request)//Requestインスタンス化
    {
        //dd tokenとcontent
        $inputs = $request->all();//追加したToDoの内容
        
        $this->todo->fill($inputs);
        //fillメソッドはfillable（Todo.php）とセット
        //Todoインスタンスの各プロパティに一括で代入する
        
        $this->todo->save();//INSERT（DBの追加）

        return redirect()->route('todo.index');
        //ControllerからRouting(web.php)にリダイレクトする
    }

    public function show($id)
    {
        //dd($id); 何番目を詳細表示するか
        $todo = $this->todo->find($id);
        //find()メソッドで指定IDデータを取得
        return view('todo.show', ['todo' => $todo]);
        //todoフォルダのshowファイルで$todo(value)をtodo(key)とする
    }

    public function edit($id)
    {
        $todo = $this->todo->find($id);
        return view('todo.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request, $id) // 第1引数:リクエスト情報の取得 第2引数:ルートパラメータの取得
    {
        $inputs = $request->all();
        $todo = $this->todo->find($id);
        $todo->fill($inputs)->save();
        //fillメソッドはfillable（Todo.php）とセット
        //INSERT（DBの追加）
        return redirect()->route('todo.show', $todo->id);
    }
    public function delete($id)
    {
        $todo = $this->todo->find($id);
        $todo->delete();
        return redirect()->route('todo.index');
    }
}