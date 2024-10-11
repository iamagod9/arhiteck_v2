<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreFeedbackRequest;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(StoreFeedbackRequest $request)
    {
        Feedback::create([
            'stars' => $request->stars,
            'name' => $request->feedback_name,
            'phone' => $request->feedback_phone,
            'comment' => $request->comment,
            'is_published' => false,
        ]);

        return response()->json(['message' => 'Ваш отзыв получен и будет опубликован в ближайшее время.'], 201);
    }
}