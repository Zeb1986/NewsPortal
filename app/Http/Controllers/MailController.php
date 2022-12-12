<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
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
    public static function sendNotif($attributes)
    {
        $mailData = [
            'title' => $attributes['title'],
            'body' => $attributes['excerpt'],
            'slug' => $attributes['slug']
        ];

        $emails = Subscriber::pluck('email');

        if(sizeof($emails)==0) {
            return null;
        }
        Mail::to($emails)->send(new DemoMail($mailData));
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
