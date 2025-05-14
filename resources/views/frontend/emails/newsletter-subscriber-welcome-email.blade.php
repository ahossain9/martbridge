@component('mail::message')
    # Welcome to {{ config('app.name')  }}!

    Dear {{ $subscriber->email }},

    Thanks for subscribing to our newsletter. We will keep you updated with our latest news and offers.

    Thank you for your interest in our products and services.

    Best regards,

    {{ env('CONTACT_PERSON_NAME') }}
    {{ env('CONTACT_PERSON_DESIGNATION') }}
    {{ config('app.name') }}

    29/3, Shukrabad
    Dhaka 1207, Bangladesh

    Phone: +880 1688-034-515
    Email: {{ env('CONTACT_PERSON_EMAIL') }}

    @component('mail::button', ['url' => env('APP_URL')])
        Visit {{ config('app.name') }}
    @endcomponent

    @component('mail::button', ['url' => env('APP_URL') . '/newsletter/unsubscribe/' . $subscriber->id . '/' . $subscriber->unsubscribe_token])
        Unsubscribe
    @endcomponent


@endcomponent
