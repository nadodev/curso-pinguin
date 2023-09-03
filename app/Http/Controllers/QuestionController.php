<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\{RedirectResponse, Request, Response};

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        Question::query()->create(
            $request->validate([
                'question' => ['required', 'string', 'max:260'],
            ])
        );

        return to_route('dashboard');
    }
}
