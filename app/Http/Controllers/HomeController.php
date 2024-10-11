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
        $feedbacks = Feedback::where('is_published', 1)->get()->sortByDesc('created_at');
        $types = EstateType::all();

        return view('index', compact('feedbacks', 'estates', 'types'));
    }
}