<?php

namespace App\Http\Controllers;

use App\Models\Classname;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Http\Requests\TasksRequest;
use App\Http\Requests\UserupRequest;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class TasksController extends Controller
{
    //
    public function index()
    {
        $currentUserId = Auth::id();
        $user = Auth::user();
        $user_table = User::whereId($currentUserId)->first();
        $user_class = $user_table->class;
        $class_table = Classname::where('class_number', $user_class)->first();
        $classname = $class_table->name;
        $tasks = Task::where('user_id', $currentUserId)->orderBy('updated_at', 'desc')->get();
        $othertasks = Task::where('class', $user_class)->where('user_id', '!=', $currentUserId)->orderBy('updated_at', 'desc')->get();
        return view('tasks.index', compact('tasks', 'user', 'othertasks', 'user_class', 'classname'));
    }
    public function show($id)
    {
        $retern = Str::after($_SERVER['HTTP_REFERER'], 'http://localhost');
        $user = Auth::user();
        $task = Task::find($id);

        return view('tasks.show', compact('task', 'user', 'retern'));
    }
    public function add($id)
    {
        $user_id = $id;
        $user = Auth::user();
        $users = User::where('id', $id)->first();
        $retern = Str::after($_SERVER['HTTP_REFERER'], 'http://localhost');
        return view('tasks.add', compact('user', 'user_id', 'retern', 'users'));
    }
    public function store(TasksRequest $request)
    {
        // tasksテーブルにフォームで入力した値を挿入する
        $currentUserId = Auth::id();
        $user_table = User::whereId($currentUserId)->first();
        $user_class = $user_table->class;
        $store_users = User::where('id', $request->id)->first();
        $result = Task::create([
            'dateline' => $request->dateline,
            'class' => $user_class,
            'user_id' => $request->id,
            'created_user' => Auth::user()->name,
            'user_name' => $store_users->name,
            'created_user' => Auth::user()->name,
            'name' => $request->name,
            'content' => $request->content,
        ]);


        // タスク一覧画面にリダイレクト
        if ($store_users->id !== $currentUserId) {
            return redirect()->route('users.date', ['id' => $request->id]);
        } else {
            return redirect()->route('tasks.index');
        };
    }
    public function edit($id)
    {
        $user = Auth::user();
        $task = Task::find($id);
        return view('tasks.edit', compact('task', 'user'));
    }
    public function update(TasksRequest $request, $id)
    {
        // idを条件にtasksテーブルからレコードを取得
        $task = Task::find($id);
        // 更新処理
        $task->fill([
            'dateline' => $request->dateline,
            'state' => $request->state,
            'name' => $request->name,
            'content' => $request->content,
        ])
            ->save();

        // タスク一覧画面にリダイレクト
        return redirect()->route('tasks.index');
    }
    public function delete($id)
    {
        // idを条件にtasksテーブルから該当レコードを削除
        $task = Task::destroy($id);

        // タスク一覧画面にリダイレクト
        return redirect()->route('tasks.index');
    }
    public function users()
    {

        $user = Auth::user();
        $currentUserId = Auth::id();
        $user_table = User::whereId($currentUserId)->first();
        $user_class = $user_table->class;
        $class_table = Classname::where('class_number', $user_class)->first();
        $classname = $class_table->name;
        $class_user = User::where('class', $user_class)->where('id', '!=', $currentUserId)->orderBy('updated_at', 'desc')->get();
        $othertasks = array();

        if ($class_user !== NULL) {
            foreach ($class_user as $use) {

                array_push($othertasks, Task::where('user_id', $use->id)->where('user_id', '!=', $currentUserId)->orderBy('updated_at', 'desc')->first());
            }
        }

        return view('users.show', compact('user', 'class_user', 'classname', 'othertasks', 'currentUserId'));
    }
    public function date($id)
    {
        $user = Auth::user();
        $user_table = User::where('id', $id)->first();
        $tasks = Task::where('user_id', $id)->get();

        $user_class = $user_table->class;
        $class_table = Classname::where('class_number', $user_class)->first();
        $classname = $class_table->name;
        $retern = Str::after($_SERVER['HTTP_REFERER'], 'http://localhost');

        return view('users.date', compact('user', 'user_table', 'classname', 'tasks', 'retern'));
    }

    public function useredit()
    {
        $currentUserId = Auth::id();
        $user = Auth::user();
        // 部署名を持ってくる処理
        $user_table = User::whereId($currentUserId)->first();
        $user_class = $user_table->class;
        $class = Classname::get();
        $class_table = Classname::where('class_number', $user_class)->first();
        $classname = $class_table->name;
        return view('users.edit', compact('user', 'classname', 'class', 'class_table'));
    }
    public function userupdate(UserupRequest $request)
    {
        // idを条件にtasksテーブルからレコードを取得
        $currentUserId = Auth::id();
        $user_table = User::whereId($currentUserId)->first();
        $oldpass = Hash::make($request->oldpassword);
        $task_table = Task::where('user_id', $currentUserId)->get();
        // 更新処理

        $user_table->fill([
            'name' => $request->name,
            'email' => $request->email,
        ])
            ->save();

        if ($request->class == 0) {
            return redirect()->route('class.new');
        }

        $user_table->fill([
            'class' => $request->class,
        ])
            ->save();

        foreach ($task_table as $task) {
            $task->fill([
                'class' => $request->class,
            ])
                ->save();
        }

        // タスク一覧画面にリダイレクト
        return redirect()->route('tasks.index');
    }
}
