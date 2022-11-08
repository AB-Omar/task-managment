<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Priority;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id = null)
    {
        // dd($project_id);
        $tasks = Task::query()->select(
            'tasks.id',
            'tasks.name',
            'priorities.name as priority',
            'projects.name as project',
            'projects.id as projectId',
        )
        ->leftJoin('priorities', 'priorities.id', '=', 'priority_id')
        ->leftJoin('projects', 'projects.id', '=', 'project_id')
        ->orderBy('priorities.id','asc')
        ->paginate(3);    
        
        if ($project_id != null){
            $tasks = $tasks->where('projectId' ,'=', $project_id);
        }
        return view('tasks.index', [
            'tasks' => $tasks,
            'projects' => Project::all(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create', [
            'priorities' => Priority::all(),
            'projects' => Project::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        Task::create($request->all());

       return redirect(route('tasks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task,
            'priorities' => Priority::all(),
            'projects' => Project::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->all());

        return redirect(route('tasks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect(route('tasks.index'));
    }
}
