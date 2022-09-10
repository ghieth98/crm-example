@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Client</div>

                <div class="card-body d-flex justify-content-between">
                    <div>
                        <div class="text-primary">{{ $project->client->client_name }}</div>
                        <p class="mb-0">{{ $project->client->client_email }}</p>
                        <p>{{ $project->client->client_phone }}</p>
                    </div>
                    <div>
                        <p class="mb-0">{{ $project->client->comapny_name }}</p>
                        <p class="mb-0">{{ $project->client->company_address }}</p>
                        <p class="mb-0">
                            {{ $project->client->comapny_city }}, {{ $project->client->comapny_zip }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Assigned User
                </div>

                <div class="card-body">
                    <p class="mb-0">{{ $project->user->full_name }}</p>
                    <p class="mb-0">{{ $project->user->email }}</p>
                    <p class="mb-0">{{ $project->user->phone_number }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-accent primary">
                <div class="card-header">Information</div>

                <div class="card-body">
                    @if($project->tasks->count())
                        <table class="table table-sm table-responsive-sm">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Assigned to</th>
                                <th>Client</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($project->tasks as $task)
                                <tr>
                                    <td><a href="{{ route('task.show', $task) }}">{{ $task->title }}</a></td>
                                    <td>{{ $task->user->full_name }}</td>
                                    <td>{{ $task->client->company_name }}</td>
                                    <td>{{ $task->deadline }}</td>
                                    <td>{{ $task->status }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{ route('task.edit', $task) }}">
                                            Edit
                                        </a>
                                        @can('delete')
                                            <form action="{{ route('task.destroy', $task) }}" method="post"
                                                  onsubmit="return confirm('Are you sure?');"
                                                  style="display:inline-block">
                                                <input type="hidden" name="_method" value="delete">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-sm btn-danger" value="delete">
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info" role="alert">
                            No tasks in this project right now. <a href="{{ route('task.create') }}">
                                Create New Task
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
