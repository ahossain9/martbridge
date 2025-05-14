@component('mail::message')
    # Welcome to {{ config('app.name')  }}!

    Dear {{ $contact->name }},

    We have received your message and will get back to you as soon as possible.

    Thank you for contacting us.

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


@endcomponent
