<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\Subject;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\TaskList\TaskListExtension;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Auth::user()->tasks;
        return view('tasks.index')->with(compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        $events = Event::all();

        return view('tasks.create')->with(compact('subjects', 'events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task($request->all());

        $task->user_id = $request->user()->id;

        // 登録
        $task->save();

        return redirect()
            ->route('tasks.index', $task)
            ->with('notice', 'イベントを登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show')->with(compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $subjects = Subject::all();
        $events = Event::all();

        return view('tasks.edit')->with(compact('task', 'subjects', 'events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->fill($request->all());

        $task->save();

        return redirect()
            ->route('tasks.index', $task)
            ->with('notice', 'イベントを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('notice', 'イベントを更新しました');
    }



    public function progress_edit(Task $task)
    {
        $subjects = Subject::all();
        $events = Event::all();

        return view('tasks.progress_edit')->with(compact('task', 'subjects', 'events'));
    }


    public function progress_update(Task $task)
    {
        // $task->fill($request->all());

        $task->save();

        return redirect()
            ->route('tasks.index', $task)
            ->with('notice', 'イベントを更新しました');
    }
}
