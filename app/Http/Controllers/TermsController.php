<?php

namespace App\Http\Controllers;

use App\Http\Requests\TermsAcceptRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('terms');
    }

    public function store(TermsAcceptRequest $request)
    {
        auth()->user()->update([
            'terms_accepted' => true
        ]);

        return redirect()->route('home');
    }
}
