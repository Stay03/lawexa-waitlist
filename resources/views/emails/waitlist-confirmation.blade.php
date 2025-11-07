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
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .stats {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 20px;
            margin: 25px 0;
        }
        .stats-item {
            margin: 10px 0;
        }
        .stats-label {
            font-weight: bold;
            color: #555;
        }
        .referral-link {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
        }
        .referral-link:hover {
            background-color: #0056b3;
        }
        .custom-message {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
        .referral-code {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to the Lawexa Waitlist!</h1>
            <p>Thank you{{ $name ? ', ' . $name : '' }} for joining our waitlist!</p>
        </div>

        @if($customMessage)
        <div class="custom-message">
            <p>{{ $customMessage }}</p>
        </div>
        @endif

        <div class="stats">
            <div class="stats-item">
                <span class="stats-label">Your Current Position:</span> #{{ $position }}
            </div>
            <div class="stats-item">
                <span class="stats-label">Total Referrals:</span> {{ $totalReferrals }}
            </div>
            <div class="stats-item">
                <span class="stats-label">Your Referral Code:</span>
                <div class="referral-code">{{ $referralCode }}</div>
            </div>
        </div>

        <div style="text-align: center;">
            <h3>Move Up the Waitlist!</h3>
            <p>Share your unique referral link to move up in the queue. The more people you refer, the higher you'll climb!</p>
            <a href="{{ $referralLink }}" class="referral-link">{{ $referralLink }}</a>
        </div>

        <div style="margin-top: 30px;">
            <h3>How It Works:</h3>
            <ul>
                <li>Share your referral link with friends and colleagues</li>
                <li>When they join using your link, you both move up in the waitlist</li>
                <li>The more referrals you get, the higher your position</li>
                <li>Track your progress anytime using your referral code</li>
            </ul>
        </div>

        <div class="footer">
            <p>This email was sent to {{ $entry->email }}</p>
            <p>&copy; {{ date('Y') }} Lawexa. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
