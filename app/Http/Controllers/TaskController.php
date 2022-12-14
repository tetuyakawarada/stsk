<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Subject;
use App\Models\State;
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
        $event = Auth::user()->events->last();
        $tasks = Auth::user()->tasks;

        $total_time = 0;
        $progress_time = 0;

        foreach ($tasks as $task) {
            $total_time += $task->total_page * $task->page_time / 60;
            $progress_time += $task->finish_page * $task->page_time / 60;
        }

        if ($total_time == 0) {
            $total_progress_degree = 0;
        } else {
            $total_progress_degree = $progress_time * 100 / $total_time;
        }

        return view('tasks.index')->with(compact('tasks', 'event', 'total_time', 'progress_time', 'total_progress_degree',));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        $events = Auth::user()->events;

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
            ->route('tasks.index')
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
        $events = Auth::user()->events;

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
            ->route('tasks.index')
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
        $states = State::all();

        return view('tasks.progress_edit')->with(compact('task', 'subjects', 'events', 'states'));
    }


    public function progress_update(Request $request, $id)
    {
        // $task->fill($request->all());

        $task = Task::find($id);

        // 値の用意
        $task->finish_page = $request->finish_page;
        $task->state_id = $request->state_id;

        // 保存
        $task->save();

        return redirect()
            ->route('tasks.index')
            ->with('notice', 'イベントを更新しました');
    }
}
