<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreFeedbackRequest;
use App\Models\EstateType;
use Illuminate\Http\Request;

use App\Models\Estate;
use App\Models\Feedback;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $estates = Estate::paginate(9)->withQueryString();
        $feedbacks = Feedback::all();
        $types = EstateType::all();

        return view('index', compact('feedbacks', 'estates', 'types'));
    }

    public function show(Request $request)
    {
    }

    public function store(StoreFeedbackRequest $request)
    {
        Feedback::create(['name' => $request->feedback_name, 'phone' => $request->feedback_phone, 'comment' => $request->comment]);

        return to_route('home');
    }
}
