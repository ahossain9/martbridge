<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        $subscriber = new NewsletterSubscriber();
        $subscriber->status = 1;
        $subscriber->email = $request->email;
        $subscriber->save();

        return redirect()->back()->with('success', 'You have subscribed successfully.');
    }
}
