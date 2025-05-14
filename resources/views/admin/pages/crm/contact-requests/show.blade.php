@extends('admin.layouts.master')

@section('admin-title', 'Show Contact Request')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between mb-2">
            <div class="">
                <h3>Contact Request for - <span class="badge bg-primary">{{ $contact->name }}</span></h3>
            </div>
            <div class="">
                <a class="btn btn-outline-dark" href="{{ route('admin.crm.contact_requests.index') }}" >Back</a>
            </div>
        </div>
        @include('admin.partials.message')

        <!-- Contact Details Area -->
        <div class="card">
            <div class="card-body">
                @php
                    $status = $contact->is_replied ? 'Replied' : 'Pending';
                    $badge = $contact->is_replied ? 'badge bg-primary rounded-pill' : 'badge bg-danger rounded-pill';
                @endphp
                <div class="float-end {{ $badge }} mb-2">{{ $status }}</div>
                <h5 class="card-title">Email Subject: {{ $contact->subject }}</h5>
                <p class="card-text">
                    <strong>From:</strong> {{ $contact->name }}<br>
                    <strong>Email:</strong> <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a><br>
                    <strong>Phone:</strong> <a href="tel:{{$contact->phone}}">{{ $contact->phone }}</a><br>
                    <strong>Received at:</strong>
                    {{ \Carbon\Carbon::parse($contact->created_at)->format('F j, Y h:i A') }}
                </p>
                <hr>
                <div class="email-body">
                    <p>
                        {{ $contact->message }}
                    </p>
                </div>
            </div>
            <!-- button -->
            <div class="card-footer">
                <div class="">
                    <a href="{{ route('admin.crm.contact_requests.mark_as_replied', $contact->id) }}"  class="btn btn-outline-dark">Mark As Replied</a>
                </div>
            </div>
        </div>
        <!--/ Contact Details Area -->
    </div>
@endsection

