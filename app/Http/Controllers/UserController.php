<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $users
     * @return Application|Factory|View
     */
    public function index(User $users): View|Factory|Application
    {
        $users->with('roles')->paginate(15);

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @param User $user
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreUserRequest $request, User $user): Redirector|RedirectResponse|Application
    {
        $user->create($request->validated());

        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user): Application|Factory|View
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('user.index');
    }

    //    /**
//     * Display the specified resource.
//     *
//     * @param User $user
//     * @return Application|Factory|View
//     */
//    public function show(User $user)
//    {
//          return view('user.show');
//    }
}
