<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index() {
        return view('admin.feedback.index', [
            'feedback' => Feedback::all()
        ]);
    }

    public function create() {
        return view('feedback.feedback');
    }

    public function store() {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'topic' => 'required|max:255',
            'text' => 'required',
        ]);

        Feedback::create($attributes);


        return redirect('/')->with('success', 'Your feedback sanded!.');
    }

}
