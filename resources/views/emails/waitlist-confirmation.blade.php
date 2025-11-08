<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Lawexa Waitlist</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header-image {
            width: 100%;
            height: auto;
            display: block;
        }
        .content {
            padding: 50px 40px;
            background-color: #ffffff;
        }
        .logo-text {
            text-align: center;
            font-size: 28px;
            font-weight: 600;
            color: #D4AF37;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        h1 {
            text-align: center;
            color: #1a1a1a;
            font-size: 32px;
            font-weight: 600;
            margin: 0 0 15px 0;
            line-height: 1.3;
        }
        .subtitle {
            text-align: center;
            color: #666;
            font-size: 18px;
            margin: 0 0 40px 0;
        }
        .message {
            text-align: center;
            font-size: 16px;
            color: #333;
            margin-bottom: 35px;
            line-height: 1.6;
        }
        .cta-button {
            display: block;
            width: fit-content;
            margin: 30px auto;
            background-color: #D4AF37;
            color: #ffffff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .cta-button:hover {
            background-color: #B8941F;
        }
        .whatsapp-button {
            display: block;
            width: fit-content;
            margin: 30px auto;
            background-color: #25D366;
            color: #ffffff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .whatsapp-button:hover {
            background-color: #1da851;
        }
        .stats-container {
            background-color: #FAFAFA;
            border-radius: 12px;
            padding: 30px;
            margin: 35px 0;
            text-align: center;
        }
        .stat-item {
            margin: 20px 0;
        }
        .stat-label {
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #D4AF37;
        }
        .referral-code-display {
            font-size: 36px;
            font-weight: 700;
            color: #D4AF37;
            letter-spacing: 4px;
            font-family: 'Courier New', monospace;
        }
        .info-section {
            margin: 35px 0;
            padding: 25px;
            background-color: #FFF9E6;
            border-radius: 4px;
            border-left: 4px solid #D4AF37;
        }
        .info-section h3 {
            color: #1a1a1a;
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 15px;
        }
        .info-section p {
            color: #555;
            margin: 0;
            font-size: 15px;
            line-height: 1.6;
        }
        .custom-message {
            background-color: #FFF9E6;
            border-left: 4px solid #D4AF37;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .custom-message p {
            margin: 0;
            color: #555;
            font-size: 15px;
        }
        .footer {
            text-align: center;
            padding: 30px 40px;
            background-color: #f9f9f9;
            font-size: 13px;
            color: #999;
            line-height: 1.6;
        }
        .footer p {
            margin: 5px 0;
        }
        .divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 30px 0;
        }
        .section-divider {
            height: 2px;
            background-color: #e0e0e0;
            margin: 40px 0;
        }
        .prize-list {
            margin: 20px 0;
            padding: 0;
            list-style: none;
        }
        .prize-item {
            margin: 15px 0;
            padding-left: 0;
            color: #333;
            font-size: 15px;
            line-height: 1.6;
        }
        .benefit-list {
            margin: 20px 0;
            padding: 0;
            list-style: none;
        }
        .benefit-item {
            margin: 12px 0;
            padding-left: 0;
            color: #555;
            font-size: 15px;
            line-height: 1.6;
        }
        .section-heading {
            color: #1a1a1a;
            font-size: 22px;
            font-weight: 600;
            margin: 30px 0 20px 0;
            text-align: center;
        }
        .invite-code-box {
            background-color: #FAFAFA;
            border: 2px solid #D4AF37;
            border-radius: 4px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        .invite-code {
            font-size: 18px;
            font-weight: 600;
            color: #D4AF37;
            word-break: break-all;
        }
        .social-share-section {
            text-align: center;
            margin: 30px 0;
        }
        .social-share-title {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }
        .social-share-icons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            transition: transform 0.2s ease, opacity 0.2s ease;
            text-decoration: none;
        }
        .social-icon:hover {
            transform: scale(1.1);
            opacity: 0.8;
        }
        .social-icon svg {
            width: 28px;
            height: 28px;
        }
        .twitter-icon {
            background-color: #000000;
        }
        .whatsapp-icon {
            background-color: #25D366;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <!-- Header Image -->
        <img src="{{ asset('6.png') }}" alt="Lawexa" class="header-image">

        <!-- Main Content -->
        <div class="content">
            <h1>You're In! Welcome to the Lawexa Waitlist</h1>

            <p class="subtitle">Hi{{ $name ? ' ' . $name : '' }},</p>

            <p class="message">
                Welcome to the Lawexa community!
            </p>

            <p class="message">
                Your spot on the early access waitlist is confirmed, you're now one step closer to using Lawexa,
                the AI legal assistant built to make the law clear, simple, and accessible for everyone.
            </p>

            <div class="section-divider"></div>

            <!-- What Happens Next Section -->
            <h2 class="section-heading">What Happens Next</h2>

            <p class="message">
                We're putting the final touches on Lawexa to deliver the smartest, most intuitive legal experience yet.
                You'll be notified personally as soon as your access is ready.
            </p>

            <p class="message">
                In the meantime, you can skip the line, and even win amazing rewards.
            </p>

            <div class="section-divider"></div>

            <!-- Skip the Wait Section -->
            <h2 class="section-heading">Skip the Wait. Climb the Leaderboard. Win Big.</h2>

            <p class="message">
                Lawexa is powered by community, and we're rewarding those who help us grow.
            </p>

            <p class="message">
                Every friend you refer using your unique invite link earns you points on the Lawexa Referral Leaderboard.<br>
                The more people you invite, the higher you rank, and the bigger the rewards.
            </p>

            <!-- Prize List -->
            <div class="info-section">
                <h3>Top Referrers Win:</h3>
                <ul class="prize-list">
                    <li class="prize-item">• 1st Place: Exclusive Lawexa Access + Launch Event VIP Pass + ₦50,000</li>
                    <li class="prize-item">• 2nd Place: Free 3-Month Lawexa Subscription + Launch Event Invite</li>
                    <li class="prize-item">• 3rd Place: Free 1-Month Lawexa Subscription</li>
                </ul>
            </div>

            <p class="message">
                Refer just 3 people to get instant early access, and start climbing from there!
            </p>

            <!-- Invite Link Box -->
            <div class="invite-code-box">
                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">Your unique invite link:</p>
                <div class="invite-code">{{ $referralLink }}</div>
            </div>

            <!-- CTA Button -->
            <a href="{{ $referralLink }}" class="cta-button">Share Your Referral Link</a>

            <!-- Social Share Section -->
            <div class="social-share-section">
                <p class="social-share-title">Share on social media:</p>
                <div class="social-share-icons">
                    <!-- Twitter/X Icon -->
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode('I just joined the @LawexaAi waitlist! The AI legal assistant making law accessible for everyone. Join me: ' . $referralLink . ' #UseLawexa') }}" class="social-icon twitter-icon" target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>

                    <!-- WhatsApp Icon -->
                    <a href="https://wa.me/?text={{ urlencode('I just joined the Lawexa waitlist! The AI legal assistant making law accessible for everyone. Join me: ' . $referralLink) }}" class="social-icon whatsapp-icon" target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="section-divider"></div>

            <!-- Shape What We Build Section -->
            <h2 class="section-heading">Shape What We Build</h2>

            <p class="message">
                As an early member, you're not just using Lawexa — you're helping shape its future.
            </p>

            <ul class="benefit-list">
                <li class="benefit-item">► Weekly Founder Q&As: Share feedback, suggest features, and get sneak peeks.</li>
                <li class="benefit-item">► Exclusive Lagos Launch Event: Meet the team and connect with other pioneers.</li>
                <li class="benefit-item">► Vote on Features: Your opinions guide what we build next.</li>
            </ul>

            <div class="section-divider"></div>

            <!-- Join Community Section -->
            <h2 class="section-heading">Join the Lawexa Community</h2>

            <p class="message">
                Connect with other early users, track leaderboard updates, and stay in the loop on prize giveaways:
            </p>

            <a href="https://chat.whatsapp.com/CNDMnd0eWYp4Qiy7k4oVlL" class="whatsapp-button">Join the WhatsApp Community</a>

            <div class="section-divider"></div>

            <p class="message">
                We're thrilled to have you on board.<br>
                Let's make legal knowledge smarter, together.
            </p>

            <p class="message" style="margin-top: 30px;">
                <strong>Warm regards,</strong><br>
                The Lawexa Team
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>This email was sent to {{ $entry->email }}</p>
            <p>&copy; {{ date('Y') }} Lawexa. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
