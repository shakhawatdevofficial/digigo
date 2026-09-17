<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactReplyMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of all contact inquiries.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $contacts = Contact::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%");
                });
            })
            ->when($status && in_array($status, ['pending', 'read', 'replied', 'closed']), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalContacts = Contact::count();
        $pendingContacts = Contact::where('status', 'pending')->count();
        $repliedContacts = Contact::where('status', 'replied')->count();
        $closedContacts = Contact::where('status', 'closed')->count();

        return view('admin.contacts.index', compact(
            'contacts',
            'totalContacts',
            'pendingContacts',
            'repliedContacts',
            'closedContacts',
            'search',
            'status'
        ));
    }

    /**
     * Display the specified contact inquiry and reply interface.
     */
    public function show(Contact $contact)
    {
        // Mark as read when opened
        if (! $contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        $defaultFromName = auth()->user()->name ?? config('mail.from.name', 'DigiGo Customer Support');
        $defaultFromEmail = config('mail.from.address', 'support@digigo.com');

        return view('admin.contacts.show', compact('contact', 'defaultFromName', 'defaultFromEmail'));
    }

    /**
     * Send email reply to the contact inquiry.
     */
    public function reply(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'from_email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        // Send queued reply email to contact's email address in background
        Mail::to($contact->email)->send(new ContactReplyMail(
            replySubject: $validated['subject'],
            replyMessage: $validated['message'],
            fromName: $validated['name'],
            fromEmail: $validated['from_email'],
            recipientName: $contact->name,
            recipientEmail: $contact->email,
            originalSubject: $contact->subject,
            originalMessage: $contact->message,
            originalDate: $contact->created_at ? $contact->created_at->format('M d, Y \a\t h:i A') : null,
            contactId: $contact->id
        ));

        // Update contact status and record reply details
        $contact->update([
            'is_read' => true,
            'status' => 'replied',
            'reply_subject' => $validated['subject'],
            'reply_message' => $validated['message'],
            'replied_at' => now(),
        ]);

        return redirect()->route('admin.contacts.show', $contact->id)->with('success', 'Reply email has been sent successfully to '.$contact->email.'!');
    }

    /**
     * Update status of the contact inquiry.
     */
    public function updateStatus(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,read,replied,closed'],
        ]);

        $contact->update([
            'status' => $validated['status'],
            'is_read' => true,
        ]);

        return redirect()->back()->with('success', 'Contact status updated successfully!');
    }

    /**
     * Remove the specified contact inquiry.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted successfully!');
    }
}
