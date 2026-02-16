<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 8px; padding: 30px; }
        h2 { color: #f97316; margin-top: 0; }
        .field { margin-bottom: 16px; }
        .label { font-weight: bold; color: #555; font-size: 13px; text-transform: uppercase; }
        .value { margin-top: 4px; color: #222; font-size: 15px; }
        .footer { margin-top: 24px; padding-top: 16px; border-top: 1px solid #eee; color: #999; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Contact Form Submission</h2>

        <div class="field">
            <div class="label">Name</div>
            <div class="value">{{ $contactMessage->name }}</div>
        </div>

        <div class="field">
            <div class="label">Email</div>
            <div class="value"><a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a></div>
        </div>

        <div class="field">
            <div class="label">Phone</div>
            <div class="value"><a href="tel:{{ $contactMessage->phone }}">{{ $contactMessage->phone }}</a></div>
        </div>

        @if($contactMessage->message)
        <div class="field">
            <div class="label">Message</div>
            <div class="value">{{ $contactMessage->message }}</div>
        </div>
        @endif

        <div class="footer">
            Sent from Mobile Kitchen Pro contact form on {{ $contactMessage->created_at->format('M d, Y \a\t h:i A') }}
        </div>
    </div>
</body>
</html>
