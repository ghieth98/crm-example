<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\User;
use App\Notifications\ProjectAssigned;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $projects = Project::with(['user', 'client'])->filterStatus(request('status'))
            ->paginate(5);

        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $users = User::all()->pluck('full_name', 'id');
        $clients = Client::all()->pluck('company_name', 'id');

        return view('project.create', compact('users', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProjectRequest $request
     * @param Project $project
     * @return RedirectResponse
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $project = Project::create($request->validated());
        $user = User::find($request->user_id);

        $user->notify(new ProjectAssigned($project));

        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return Application|Factory|View
     */
    public function show(Project $project): View|Factory|Application
    {
        $project->load(['tasks', 'user', 'client']);
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return Application|Factory|View
     */
    public function edit(Project $project): View|Factory|Application
    {
        $users = User::all()->pluck('full_name', 'id');
        $clients = Client::all()->pluck('company_name', 'id');

        return view('project.edit', compact('project', 'users', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProjectRequest $request
     * @param Project $project
     * @return RedirectResponse
     */
    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        if ($project->user_id !== $request->user_id) {
            $user = User::find($request->user_id);

            $user->notify(new ProjectAssigned($project));
        }

        $project->update($request->validated());

        return redirect()->route('project.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return RedirectResponse
     */
    public function destroy(Project $project): RedirectResponse
    {
        abort_if(Gate::denies('delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $project->delete();

        return redirect()->route('project.index');
    }
}
