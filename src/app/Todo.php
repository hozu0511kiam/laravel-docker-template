<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model //ModelをTodoにextendsで継承している
{
    protected $table = 'todos';
    protected $fillable = [
        'content',
    ];
}
