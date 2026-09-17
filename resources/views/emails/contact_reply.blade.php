<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $replySubject }}</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #1e293b; margin: 0; padding: 32px 16px; line-height: 1.6;">
    <div style="max-width: 620px; margin: 0 auto; background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 25px rgba(0, 0, 0, 0.06); border: 1px solid #e2e8f0;">
        
        <!-- Header Banner -->
        <div style="background: linear-gradient(135deg, #0f0f11 0%, #1e1e24 100%); padding: 26px 32px; border-bottom: 3px solid #ffd000;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="vertical-align: middle;">
                        <span style="font-size: 22px; font-weight: 900; color: #ffffff; letter-spacing: -0.5px;">
                            DIGIGO<span style="color: #ffd000;">.</span>
                        </span>
                        <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; letter-spacing: 0.8px; margin-top: 3px;">
                            Official Customer Support
                        </div>
                    </td>
                    @if(!empty($contactId))
                    <td style="text-align: right; vertical-align: middle;">
                        <span style="display: inline-block; background-color: rgba(255, 208, 0, 0.15); color: #ffd000; font-size: 11px; font-weight: 800; padding: 5px 14px; border-radius: 9999px; border: 1px solid rgba(255, 208, 0, 0.3);">
                            Ticket #{{ $contactId }}
                        </span>
                    </td>
                    @endif
                </tr>
            </table>
        </div>

        <!-- Main Body -->
        <div style="padding: 32px 32px 28px 32px;">
            <!-- Greeting -->
            <p style="font-size: 15px; margin: 0 0 14px 0; color: #0f172a; font-weight: 700;">
                Hello {{ $recipientName ?: 'Valued Customer' }},
            </p>
            <p style="font-size: 14px; color: #475569; margin: 0 0 24px 0; line-height: 1.6;">
                Thank you for contacting <strong>DigiGo Support</strong>. Our team has reviewed your message and provided an update below:
            </p>

            <!-- Conversation Box 1: Support Response Bubble -->
            <div style="background-color: #fdfaf3; border: 1px solid #fef3c7; border-left: 4px solid #ffd000; border-radius: 14px; padding: 20px 22px; margin-bottom: 26px;">
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px;">
                    <tr>
                        <td style="vertical-align: middle;">
                            <strong style="font-size: 13px; color: #0f172a;">{{ $fromName }}</strong>
                            <span style="display: inline-block; font-size: 10px; font-weight: 800; background-color: #0f0f11; color: #ffd000; padding: 2px 7px; border-radius: 5px; margin-left: 6px; vertical-align: middle;">
                                SUPPORT STAFF
                            </span>
                        </td>
                        <td style="text-align: right; font-size: 11px; color: #94a3b8; vertical-align: middle;">
                            {{ now()->format('M d, Y \a\t h:i A') }}
                        </td>
                    </tr>
                </table>
                <div style="font-size: 14px; color: #1e293b; line-height: 1.75; white-space: pre-line;">
                    {!! nl2br(e($replyMessage)) !!}
                </div>
            </div>

            <!-- Conversation Box 2: Previous Thread / Customer's Original Message -->
            @if(!empty($originalMessage))
            <div style="margin-top: 28px; padding-top: 22px; border-top: 1px dashed #cbd5e1;">
                <div style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 12px;">
                    Conversation Thread &bull; Your Original Message
                </div>
                <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px 18px;">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 8px;">
                        <tr>
                            <td style="font-size: 12px; font-weight: 700; color: #334155;">
                                {{ $recipientName }} @if(!empty($recipientEmail))<span style="color: #64748b; font-weight: normal;">&lt;{{ $recipientEmail }}&gt;</span>@endif
                            </td>
                            @if(!empty($originalDate))
                            <td style="text-align: right; font-size: 11px; color: #94a3b8;">
                                {{ $originalDate }}
                            </td>
                            @endif
                        </tr>
                    </table>
                    @if(!empty($originalSubject))
                        <div style="font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 6px;">
                            <strong>Subject:</strong> {{ $originalSubject }}
                        </div>
                    @endif
                    <div style="font-size: 13px; color: #64748b; line-height: 1.6; white-space: pre-line; background-color: #ffffff; padding: 12px 14px; border-radius: 8px; border: 1px solid #f1f5f9;">
                        {!! nl2br(e($originalMessage)) !!}
                    </div>
                </div>
            </div>
            @endif

            <!-- Help Notice Card -->
            <div style="margin-top: 26px; background-color: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 18px; text-align: center;">
                <p style="font-size: 12px; color: #475569; margin: 0;">
                    Have additional questions? Simply reply directly to this email or visit our website for instant live support.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div style="background-color: #0f0f11; padding: 22px 32px; text-align: center; color: #94a3b8; font-size: 12px; border-top: 1px solid #27272a;">
            <p style="margin: 0 0 4px 0; color: #ffffff; font-weight: 700; font-size: 13px;">
                DigiGo &mdash; Modern Digital Shop
            </p>
            <p style="margin: 0; color: #64748b; font-size: 11px;">
                Official Digital Subscriptions, Instant Delivery &amp; 24/7 Verified Support.
            </p>
            <p style="margin: 10px 0 0 0; color: #475569; font-size: 10px;">
                &copy; {{ date('Y') }} DigiGo Bangladesh. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
