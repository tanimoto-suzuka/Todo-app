<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classname;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClassnamesRequest;

class ClassnamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassnamesRequest $request)
    {
        //
        $currentUserId = Auth::id();
        $user_table = User::whereId($currentUserId)->first();
        $user = Auth::user();
        $class = $request->num;
        $isExist = Classname::where('class_number', $class)->first();
        if (empty($isExist)) {
            $classstore = Classname::create([
                'class_number' => $class,
                'name' => $request->name,
                'update_user' => $user->name,
            ]);
            $user_table->fill([
                'class' => $request->num,
            ])
                ->save();
        };
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $currentUserId = Auth::id();
        $user = Auth::user();
        $user_table = User::whereId($currentUserId)->first();
        $user_class = $user_table->class;
        $class_table = Classname::where('class_number', $user_class)->first();
        $classname = $class_table->name;
        return view('class.edit', compact('user', 'classname', 'class_table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassnamesRequest $request)
    {
        //
        // idを条件にtasksテーブルからレコードを取得
        $user = Auth::user();
        $currentUserId = Auth::id();
        $user_table = User::whereId($currentUserId)->first();
        $user_class = $user_table->class;
        $class_table = Classname::where('class_number', $user_class)->first();
        $classid = $class_table->id;
        $class = Classname::find($classid);

        // 更新処理
        $class->fill([
            'name' => $request->name,
            'update_user' => $user->name,
        ])
            ->save();
        return redirect()->route('tasks.index');
    }

    public function new()
    {
        $currentUserId = Auth::id();
        $user = Auth::user();
        // 部署名を持ってくる処理
        $user_table = User::whereId($currentUserId)->first();
        $user_class = $user_table->class;
        $class = Classname::get();
        $class_table = Classname::where('class_number', $user_class)->first();
        $classname = $class_table->name;

        $num = [];
        for ($i = 0; $i <= 10000; $i++) {
            $num[] = $i;
        }
        foreach ($class as $mem) {
            unset($num[$mem->class_number]);
        }

        return view('class.new', compact('user', 'classname', 'class', 'class_table', 'num'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
