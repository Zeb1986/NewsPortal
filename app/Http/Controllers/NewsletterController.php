<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Validation\ValidationException;
use Mail;

class NewsletterController extends Controller
{
    public function store(Newsletter $newsletter) {
        request()->validate(['email' => 'required|email']);
        try {
            $newsletter->subscribe(request('email'));
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email can not be added'
            ]);
        }
        return redirect('/')
            ->with('success', 'You are subscribed!');
    }

}
