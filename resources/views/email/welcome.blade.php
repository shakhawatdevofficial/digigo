<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to DigiGo</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAF7F2;
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            color: #27272A;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table {
            border-spacing: 0;
            border-collapse: collapse;
        }
        td {
            padding: 0;
        }
        img {
            border: 0;
        }
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #FAF7F2;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .main-container {
            background-color: #FFFFFF;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #EBE0D0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #0F0F11;
            padding: 32px 24px;
            text-align: center;
        }
        .logo-box {
            display: inline-block;
            background-color: #FFD000;
            color: #0F0F11;
            font-weight: 900;
            font-size: 20px;
            line-height: 36px;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            text-align: center;
            vertical-align: middle;
            margin-right: 8px;
        }
        .logo-text {
            color: #FFFFFF;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            vertical-align: middle;
            display: inline-block;
        }
        .logo-dot {
            color: #FFD000;
        }
        .hero {
            background: linear-gradient(180deg, #0F0F11 0%, #18181B 100%);
            padding: 0 32px 36px 32px;
            text-align: center;
        }
        .badge {
            display: inline-block;
            background-color: rgba(255, 208, 0, 0.15);
            color: #FFD000;
            border: 1px solid rgba(255, 208, 0, 0.35);
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }
        .hero-title {
            color: #FFFFFF;
            font-size: 26px;
            font-weight: 800;
            margin: 0 0 12px 0;
            line-height: 1.3;
        }
        .hero-subtitle {
            color: #A1A1AA;
            font-size: 14px;
            line-height: 1.6;
            margin: 0 auto;
            max-width: 460px;
        }
        .content-body {
            padding: 36px 32px;
        }
        .greeting {
            font-size: 16px;
            font-weight: 700;
            color: #0F0F11;
            margin-bottom: 12px;
        }
        .paragraph {
            font-size: 14px;
            line-height: 1.7;
            color: #52525B;
            margin: 0 0 20px 0;
        }
        .perks-card {
            background-color: #FAF7F2;
            border: 1px solid #EBE0D0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 28px;
        }
        .perk-item {
            padding: 8px 0;
        }
        .perk-bullet {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: #FFD000;
            color: #0F0F11;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            font-size: 11px;
            font-weight: bold;
            margin-right: 10px;
            vertical-align: middle;
        }
        .perk-text {
            font-size: 13px;
            font-weight: 600;
            color: #27272A;
            vertical-align: middle;
        }
        .cta-container {
            text-align: center;
            margin: 32px 0 20px 0;
        }
        .cta-btn {
            display: inline-block;
            background-color: #FFD000;
            color: #0F0F11 !important;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 50px;
            box-shadow: 0 4px 14px rgba(255, 208, 0, 0.4);
            letter-spacing: 0.3px;
        }
        .footer {
            background-color: #F5EFE6;
            border-top: 1px solid #EBE0D0;
            padding: 28px 24px;
            text-align: center;
        }
        .footer-text {
            font-size: 12px;
            line-height: 1.6;
            color: #71717A;
            margin: 0 0 12px 0;
        }
        .footer-links a {
            color: #52525B;
            text-decoration: underline;
            font-size: 11px;
            margin: 0 8px;
        }
        .unsubscribe-link {
            color: #A1A1AA !important;
            text-decoration: underline;
            font-size: 11px;
        }
        @media only screen and (max-width: 600px) {
            .main-container {
                border-radius: 0 !important;
                border-left: none !important;
                border-right: none !important;
            }
            .content-body {
                padding: 24px 20px !important;
            }
            .hero {
                padding: 0 20px 28px 20px !important;
            }
            .hero-title {
                font-size: 22px !important;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <center>
            <table role="presentation" class="main-container" width="100%" cellpadding="0" cellspacing="0">
                <!-- 1. Header with Brand Logo -->
                <tr>
                    <td class="header">
                        <div style="display: inline-block; text-align: center;">
                            <span class="logo-box">D</span>
                            <span class="logo-text">DIGIGO<span class="logo-dot">.</span></span>
                        </div>
                    </td>
                </tr>

                <!-- 2. Hero Banner -->
                <tr>
                    <td class="hero">
                        <div class="badge">OFFICIAL DIGITAL SOLUTION</div>
                        <h1 class="hero-title">Welcome to DigiGo, {{ $user->name }}! 🎉</h1>
                        <p class="hero-subtitle">Your account is active. Explore official digital subscriptions, premium cloud solutions, and instant licenses.</p>
                    </td>
                </tr>

                <!-- 3. Main Content -->
                <tr>
                    <td class="content-body">
                        <div class="greeting">Hello {{ $user->name }},</div>
                        <p class="paragraph">
                            Thank you for joining <strong>DigiGo</strong>. We are thrilled to have you as part of our growing community of over 50,000+ satisfied customers across Bangladesh!
                        </p>

                        <!-- Perks & Highlights Card -->
                        <div class="perks-card">
                            <div style="font-size: 12px; font-weight: bold; color: #71717A; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">
                                What you get with your account:
                            </div>
                            
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="perk-item">
                                        <span class="perk-bullet">✓</span>
                                        <span class="perk-text">Instant digital product delivery with activation support</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="perk-item">
                                        <span class="perk-bullet">✓</span>
                                        <span class="perk-text">100% genuine & official subscriptions (Office 365, OTT, Cloud)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="perk-item">
                                        <span class="perk-bullet">✓</span>
                                        <span class="perk-text">24/7 dedicated customer assistance & warranty</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="perk-item">
                                        <span class="perk-bullet">✓</span>
                                        <span class="perk-text">Secured bKash, Nagad, and Card payment gateway</span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- CTA Button -->
                        <div class="cta-container">
                            <a href="{{ route('home') }}" class="cta-btn" target="_blank">
                                Explore Digital Shop →
                            </a>
                        </div>

                        <p class="paragraph" style="margin-top: 28px; font-size: 13px; text-align: center; color: #71717A;">
                            Need help getting started? Reply to this email or contact our support team anytime.
                        </p>
                    </td>
                </tr>

                <!-- 4. Footer -->
                <tr>
                    <td class="footer">
                        <p class="footer-text">
                            <strong>DigiGo Bangladesh</strong><br>
                            Gulshan-1, Dhaka, Bangladesh • Support: email@digigo.click
                        </p>

                        <div class="footer-links" style="margin-bottom: 12px;">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="{{ route('home') }}#products">Products</a>
                            <a href="{{ route('home') }}#faq">FAQ</a>
                            <a href="{{ route('home') }}#contact">Contact</a>
                        </div>

                        <p style="margin: 12px 0 0 0;">
                            <a href="{{ route('unsubscribe', ['email' => $user->email]) }}" class="unsubscribe-link">
                                Unsubscribe
                            </a>
                        </p>

                        <p class="footer-text" style="font-size: 10px; color: #A1A1AA; margin-top: 8px;">
                            © {{ date('Y') }} DigiGo Bangladesh. All rights reserved.
                        </p>
                    </td>
                </tr>
            </table>
        </center>
    </div>
</body>
</html>

