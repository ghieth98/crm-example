<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $notifications = auth()->user()->unreadNotifications;

        return view('notification.index', compact('notifications'));

    }

//    /**
//     * Display the specified resource.
//     *
//     * @param int $id
//     * @return Response
//     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return redirect()->route('notification.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->route('notification.index');
    }
}
