<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;
use Symfony\Component\Console\Input\Input;

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

    public function store(TodoRequest $request)
    {
        $inputs = $request->all();//SLECT文とは別 inputでも実装可能
        $this->todo->fill($inputs)->save();
        return redirect()->route('todo.index');
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
        $inputs = $request->all();//トークン・メソッド（PUT）、内容
        $todo = $this->todo->find($id);
        $todo->fill($inputs)->save();
        //fillメソッドはfillable（Todo.php）とセット
        //UPDATE（DBの変更更新）
        return redirect()->route('todo.show', $todo->id);
    }

    public function delete($id)
    {
        $this->todo->find($id)->delete();
        return redirect()->route('todo.index');
    }
    //論理削除
    //①タイムスタンプのあるなし→カラム作成
    //②SoftDeletes 自分のクラス→トレイト→継承(Model)
}