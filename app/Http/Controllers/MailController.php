<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Mail;
use App\Mail\DemoMail;

class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $mailData = [
            'title' => 'New post is published',
            'body' => 'This is for testing email using smtp.'
        ];
        $emails = Subscriber::pluck('email');
//        Mail::to('zeb1986@ukr.net')->send(new DemoMail($mailData));

        dd($emails);
    }

    public function store() {
        $attributes = request()->validate([
            'email' => ['required', Rule::unique('subscribers', 'email'), 'email']
        ]);

        Subscriber::create($attributes);
        return redirect('/')
            ->with('success', 'You are subscribed!');
    }
}
