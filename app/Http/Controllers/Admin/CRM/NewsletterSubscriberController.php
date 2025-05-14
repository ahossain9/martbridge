<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Constants\AdminConstant;
use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class NewsletterSubscriberController extends Controller
{
    public object $user;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard(AdminConstant::ADMIN_GUARD)->user();

            return $next($request);
        });
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $newsletterSubscribersCount = NewsletterSubscriber::count();

        $newsletterSubscribers = NewsletterSubscriber::latest()->paginate(50);

        return view('admin.pages.crm.newsletter-subscribers.index', [
            'newsletterSubscribersCount' => $newsletterSubscribersCount,
            'newsletterSubscribers' => $newsletterSubscribers,
        ]);
    }
}
