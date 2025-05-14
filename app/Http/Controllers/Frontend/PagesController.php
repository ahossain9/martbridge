<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactReceived;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        $sliders = Cache::rememberForever('sliders', function () {
            return Slider::query()
                ->where('slider_type', 'home')
                ->where('status', 1)
                ->orderBy('priority')
                ->get();
        });

        $banners = Cache::rememberForever('banners', function () {
            return Slider::query()
                ->where('slider_type', 'banner')
                ->where('status', 1)
                ->orderBy('priority')
                ->get()->take(3);
        });

        return view('frontend.pages.home.index', [
            'sliders' => $sliders,
            'banners' => $banners,
        ]);
    }

    public function about()
    {
        return view('frontend.pages.home.about');
        //            ->with('title', 'About Us');
    }

    public function contact()
    {
        return view('frontend.pages.home.contact');
    }

    public function submitContact(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'phone' => 'nullable|numeric',
            'subject' => 'required|min:3|max:50',
            'message' => 'required|min:3|max:500',
        ]);

        $data['ip_address'] = $request->ip();

        $contact = Contact::create($data);

        Mail::to($contact->email)->send(new ContactReceived($contact));

        toastr()->success('Your query received successfully! You will get response soon.');

        return back();
    }

    public function faq()
    {
        return view('frontend.pages.home.faq');
    }

    public function privacy()
    {
        return view('frontend.pages.home.privacy-policy');
    }

    public function terms()
    {
        return view('frontend.pages.home.terms-conditions');
    }

    public function quickView(string $slug): View
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();

        return view('frontend.pages.shop.quick-view', [
            'product' => $product,
        ]);
    }
}
