<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Inquiry</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #020617; color: #f8fafc; padding: 24px; margin: 0; }
        .container { max-width: 600px; margin: 0 auto; background: #0f172a; border-radius: 16px; border: 1px solid #1e293b; padding: 32px; }
        .header { border-bottom: 1px solid #1e293b; padding-bottom: 20px; margin-bottom: 24px; }
        .brand { font-size: 20px; font-weight: 800; color: #10b981; }
        .title { font-size: 18px; font-weight: 700; color: #ffffff; margin-top: 8px; }
        .field { margin-bottom: 16px; }
        .label { font-size: 11px; font-weight: 700; text-transform: uppercase; color: #94a3b8; letter-spacing: 0.05em; }
        .value { font-size: 14px; color: #f1f5f9; margin-top: 4px; font-weight: 500; }
        .message-box { background: #020617; border-radius: 12px; border: 1px solid #1e293b; padding: 16px; margin-top: 20px; white-space: pre-wrap; font-size: 14px; line-height: 1.6; color: #cbd5e1; }
        .footer { margin-top: 28px; padding-top: 20px; border-top: 1px solid #1e293b; font-size: 11px; color: #64748b; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="brand">TaskVerge</div>
            <div class="title">New Website Inquiry Received</div>
        </div>

        <div class="field">
            <div class="label">Sender Name</div>
            <div class="value">{{ $inquiry['name'] }}</div>
        </div>

        <div class="field">
            <div class="label">Email Address</div>
            <div class="value"><a href="mailto:{{ $inquiry['email'] }}" style="color: #34d399; text-decoration: none;">{{ $inquiry['email'] }}</a></div>
        </div>

        @if(!empty($inquiry['phone']))
        <div class="field">
            <div class="label">Phone Number</div>
            <div class="value">{{ $inquiry['phone'] }}</div>
        </div>
        @endif

        @if(!empty($inquiry['branch']))
        <div class="field">
            <div class="label">Inquiring Branch</div>
            <div class="value">{{ $inquiry['branch'] }}</div>
        </div>
        @endif

        @if(!empty($inquiry['subject']))
        <div class="field">
            <div class="label">Subject</div>
            <div class="value">{{ $inquiry['subject'] }}</div>
        </div>
        @endif

        <div class="field">
            <div class="label">Message</div>
            <div class="message-box">{{ $inquiry['message'] }}</div>
        </div>

        <div class="footer">
            This message was submitted via the contact form on TaskVerge (<a href="{{ config('app.url') }}" style="color: #64748b;">{{ config('app.url') }}</a>).<br>
            Recipient address: help@taskverge.net
        </div>
    </div>
</body>
</html>
