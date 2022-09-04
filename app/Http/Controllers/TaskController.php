<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Task $tasks
     * @return Application|Factory|View
     */
    public function index(Task $tasks): View|Factory|Application
    {
        $tasks->with(['user', 'client', 'project']);

        return view('task.view', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $users = User::all()->pluck('first_name', 'id');
        $clients = Client::all()->pluck('company_name', 'id');
        $projects = Project::all()->pluck('title', 'id');

        return view('task.create', compact('users', 'clients', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTaskRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function store(StoreTaskRequest $request, Task $task): RedirectResponse
    {
        $task->create($request->validated());

        return redirect()->route('task.index');
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param Task $task
//     * @return Response
//     */
//    public function show(Task $task)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return Application|Factory|View
     */
    public function edit(Task $task): View|Factory|Application
    {
        $users = User::all()->pluck('first_name', 'id');
        $clients = Client::all()->pluck('company_name', 'id');
        $projects = Project::all()->pluck('title', 'id');

        return view('task.edit', compact('users', 'clients', 'projects', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('task.index');
    }
}
