<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('profile.index');
    }

    /**
     * @param UpdateProfileRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        auth()->user()->update($request->validated());

        return redirect()->route('profile.index')->with('status', 'Updated Successfully');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return RedirectResponse
     */
    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        auth()->user()->update([
            'password' => bcrypt($request->new_password)
        ]);

        return redirect()->route('profile.index')
            ->with('status','Password Changed Successfully');
    }
}
