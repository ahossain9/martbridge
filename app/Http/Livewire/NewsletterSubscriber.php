<?php

namespace App\Http\Livewire;

use App\Jobs\NewsletterSubscriberWelcomeMailJob;
use App\Models\NewsletterSubscriber as NewsletterSubscriberModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class NewsletterSubscriber extends Component
{
    public string $email = '';

    protected array $rules = [
        'email' => 'required|email|unique:newsletter_subscribers,email',
    ];

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.newsletter-subscriber');
    }

    public function subscribe()
    {
        $data = $this->validate();
        $data['status'] = 1;
        $data['unsubscribe_token'] = Str::random(32);
        $data['ip'] = $_SERVER['REMOTE_ADDR'];

        if (NewsletterSubscriberModel::where('email', $this->email)->exists()) {
            $this->dispatchBrowserEvent('alert',
                ['type' => 'warning', 'message' => 'You have already subscribed to our newsletter']);

            return;
        }

        try {
            $subscriber = NewsletterSubscriberModel::create($data);
            $this->reset();

            // send email through job
            NewsletterSubscriberWelcomeMailJob::dispatch($subscriber);

            $this->dispatchBrowserEvent('alert',
                ['type' => 'success', 'message' => 'Thanks for subscribing to our newsletter']);

            return;
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert',
                ['type' => 'error', 'message' => 'Something went wrong. Please try again later.']);

            return;
        }
    }
}
