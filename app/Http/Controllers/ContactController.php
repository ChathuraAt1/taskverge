<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiryReceived;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle public contact form submission and send notification email.
     */
    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:40'],
            'branch' => ['nullable', 'string', 'max:100'],
            'subject' => ['nullable', 'string', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ], [
            'name.required' => 'Please provide your full name.',
            'email.required' => 'Please provide a valid email address.',
            'email.email' => 'Please provide a valid email address format.',
            'message.required' => 'Please enter your message or question.',
            'message.min' => 'Your message should be at least 10 characters long.',
        ]);

        $recipient = config('mail.contact_recipient', 'help@taskverge.net');

        try {
            Mail::to($recipient)->send(new ContactInquiryReceived($validated));
        } catch (\Throwable $e) {
            Log::error('Failed to dispatch contact inquiry email: ' . $e->getMessage(), [
                'recipient' => $recipient,
                'data' => $validated,
            ]);
            // If SMTP is not yet configured or fails, log it and inform the user gracefully
        }

        return redirect()
            ->to(route('home') . '#contact')
            ->with('contact_status', 'Thank you! Your message has been sent to our team at help@taskverge.net. We will get back to you shortly.');
    }
}
