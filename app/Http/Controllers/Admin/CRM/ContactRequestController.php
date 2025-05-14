<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Constants\AdminConstant;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactRequestController extends Controller
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

    public function index()
    {
        if (! $this->user->can('contact request read')) {
            return redirect()->route('admin.unauthorized');
        }

        return view('admin.pages.crm.contact-requests.index', [
            'contacts' => Contact::orderBy('created_at', 'desc')->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (! $this->user->can('contact request read')) {
            return redirect()->route('admin.unauthorized');
        }

        $contact = Contact::findOrFail($id);

        if (! $contact->is_read) {
            $contact->is_read = true;
            $contact->save();
        }

        return view('admin.pages.crm.contact-requests.show', [
            'contact' => $contact,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (! $this->user->can('contact request delete')) {
            return redirect()->route('admin.unauthorized');
        }

        $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with('success', 'Contact request deleted successfully!');
    }

    public function markAsReplied(string $id): RedirectResponse
    {
        if (! $this->user->can('contact request reply')) {
            return redirect()->route('admin.unauthorized');
        }

        $contact = Contact::findOrFail($id);

        if ($contact->is_replied) {
            return back()->with('warning', 'Contact request already marked as replied!');
        }
        $contact->is_replied = true;
        $contact->save();

        return back()->with('success', 'Contact request marked as replied!');
    }
}
