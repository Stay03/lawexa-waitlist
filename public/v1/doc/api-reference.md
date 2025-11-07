# Lawexa Waitlist API Documentation

**Version:** 1.0
**Last Updated:** November 2025

## Table of Contents

- [Overview](#overview)
- [Base URL](#base-url)
- [Authentication](#authentication)
- [Rate Limiting](#rate-limiting)
- [Endpoints](#endpoints)
  - [Join Waitlist](#post-apiwaitlist)
  - [Get Referral Stats](#get-apiwaitlistreferralcodestats)
  - [Admin: List All Entries](#get-apiadminwaitlist)
- [Referral System](#referral-system)
- [Error Handling](#error-handling)
- [Email Notifications](#email-notifications)
- [Code Examples](#code-examples)

---

## Overview

The Lawexa Waitlist API allows you to manage a viral waitlist with built-in referral tracking. Users can join the waitlist, receive unique referral links, and climb the rankings by referring others.

### Features

- ✅ Email-based waitlist signup
- ✅ Automatic referral code generation
- ✅ Dynamic position ranking based on referrals
- ✅ Email notifications via Mailgun
- ✅ Referral tracking and statistics
- ✅ Admin dashboard endpoint

---

## Base URL

```
https://lawexa.com/api
```

For local development:
```
http://localhost:8000/api
```

---

## Authentication

**Current Status:** Public endpoints require no authentication.

> **⚠️ Important:** The admin endpoint (`/api/admin/waitlist`) should be protected with authentication middleware in production environments.

---

## Rate Limiting

The waitlist signup endpoint is rate-limited to prevent abuse:

- **Limit:** 10 requests per minute per IP address
- **Endpoint:** `POST /api/waitlist`
- **Response on Limit:** HTTP 429 (Too Many Requests)

---

## Endpoints

### POST /api/waitlist

Join the waitlist and receive a unique referral code.

#### Request

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `email` | string | ✅ Required | Valid email address (must be unique) |
| `name` | string | ❌ Optional | User's full name (max 255 characters) |
| `waitlist-ref` | string | ❌ Optional | Referral code from another user |

#### Example Request

```bash
curl -X POST https://lawexa.com/api/waitlist \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "email": "user@example.com",
    "name": "John Doe",
    "waitlist-ref": "ABC12XYZ"
  }'
```

#### Success Response (201 Created)

```json
{
  "success": true,
  "message": "Successfully joined the waitlist!",
  "data": {
    "id": 1,
    "email": "user@example.com",
    "name": "John Doe",
    "referral_code": "DPYA0QB3",
    "referral_link": "https://lawexa.com?waitlist-ref=DPYA0QB3",
    "position": 42,
    "total_referrals": 0,
    "created_at": "2025-11-07T22:18:28+00:00"
  }
}
```

#### Error Response (422 Validation Error)

```json
{
  "message": "The email has already been taken.",
  "errors": {
    "email": [
      "This email is already on the waitlist."
    ]
  }
}
```

#### What Happens After Signup

1. User receives a confirmation email via Mailgun
2. Email includes their referral link and current position
3. If a referral code was provided, the referrer gets credit
4. User's position is calculated dynamically based on referrals

---

### GET /api/waitlist/{referralCode}/stats

Get referral statistics for a specific referral code.

#### URL Parameters

| Parameter | Type | Description |
|-----------|------|-------------|
| `referralCode` | string | 8-character referral code (e.g., DPYA0QB3) |

#### Example Request

```bash
curl -X GET https://lawexa.com/api/waitlist/DPYA0QB3/stats \
  -H "Accept: application/json"
```

#### Success Response (200 OK)

```json
{
  "success": true,
  "data": {
    "total_referrals": 5,
    "referral_code": "DPYA0QB3",
    "referral_link": "https://lawexa.com?waitlist-ref=DPYA0QB3",
    "position": 15
  }
}
```

#### Error Response (404 Not Found)

```json
{
  "success": false,
  "message": "Referral code not found."
}
```

---

### GET /api/admin/waitlist

Get all waitlist entries with statistics (Admin only).

> **⚠️ Security Warning:** This endpoint should be protected with authentication middleware in production.

#### Example Request

```bash
curl -X GET https://lawexa.com/api/admin/waitlist \
  -H "Accept: application/json"
```

#### Success Response (200 OK)

```json
{
  "success": true,
  "total": 100,
  "entries": [
    {
      "id": 2,
      "name": "John Doe",
      "email": "john@example.com",
      "referral_code": "AQETDRT5",
      "position": 1,
      "total_referrals": 25,
      "joined_at": "2025-11-07T22:14:21+00:00"
    },
    {
      "id": 5,
      "name": "Jane Smith",
      "email": "jane@example.com",
      "referral_code": "HM9A4T9T",
      "position": 2,
      "total_referrals": 15,
      "joined_at": "2025-11-07T22:15:13+00:00"
    }
  ]
}
```

---

## Referral System

### How Position Calculation Works

The waitlist uses a **dynamic ranking system** based on referrals:

1. **Primary Factor:** Number of referrals (more referrals = better position)
2. **Tie-Breaker:** When users have the same number of referrals, whoever joined first gets the better position
3. **Dynamic:** Positions update automatically as new referrals are added

### Referral Link Format

```
https://lawexa.com?waitlist-ref={REFERRAL_CODE}
```

### Example Ranking Scenario

| User | Referrals | Joined | Position |
|------|-----------|--------|----------|
| User A | 10 | Yesterday | #1 |
| User B | 5 | Yesterday | #2 |
| User C | 5 | Today | #3 |
| User D | 0 | Today | #4 |

**If User D gets 6 referrals, they jump to Position #2!**

---

## Error Handling

### HTTP Status Codes

| Code | Meaning | When It Occurs |
|------|---------|----------------|
| `200` | OK | Request succeeded |
| `201` | Created | Waitlist entry created successfully |
| `404` | Not Found | Referral code doesn't exist |
| `422` | Unprocessable Entity | Validation failed (invalid email, duplicate, etc.) |
| `429` | Too Many Requests | Rate limit exceeded (>10 requests/minute) |

### Common Validation Errors

**Duplicate Email:**
```json
{
  "message": "The email has already been taken.",
  "errors": {
    "email": ["This email is already on the waitlist."]
  }
}
```

**Invalid Referral Code:**
```json
{
  "message": "The selected waitlist-ref is invalid.",
  "errors": {
    "waitlist-ref": ["The referral code provided is invalid."]
  }
}
```

**Missing Required Field:**
```json
{
  "message": "The email field is required.",
  "errors": {
    "email": ["An email address is required to join the waitlist."]
  }
}
```

---

## Email Notifications

When a user joins the waitlist, they automatically receive a confirmation email containing:

- ✉️ Welcome message
- 📊 Current position in the waitlist
- 🔗 Unique referral code and link
- 📈 Instructions on how to move up the waitlist
- 👥 Total number of referrals

**Email Delivery:** Emails are sent asynchronously via Mailgun using Laravel's queue system for optimal performance.

---

## Code Examples

### JavaScript/Fetch

```javascript
// Join the waitlist
async function joinWaitlist(email, name, referralCode = null) {
  const response = await fetch('https://lawexa.com/api/waitlist', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    body: JSON.stringify({
      email: email,
      name: name,
      'waitlist-ref': referralCode
    })
  });

  const data = await response.json();

  if (data.success) {
    console.log('Joined! Your referral link:', data.data.referral_link);
    console.log('Your position:', data.data.position);
  } else {
    console.error('Error:', data.message);
  }

  return data;
}

// Get referral stats
async function getStats(referralCode) {
  const response = await fetch(
    `https://lawexa.com/api/waitlist/${referralCode}/stats`,
    {
      headers: { 'Accept': 'application/json' }
    }
  );

  return await response.json();
}

// Usage
joinWaitlist('user@example.com', 'John Doe', 'DPYA0QB3');
```

### Python

```python
import requests

# Join the waitlist
def join_waitlist(email, name, referral_code=None):
    url = "https://lawexa.com/api/waitlist"
    payload = {
        "email": email,
        "name": name
    }
    if referral_code:
        payload["waitlist-ref"] = referral_code

    response = requests.post(
        url,
        json=payload,
        headers={"Accept": "application/json"}
    )

    return response.json()

# Get stats
def get_stats(referral_code):
    url = f"https://lawexa.com/api/waitlist/{referral_code}/stats"
    response = requests.get(url, headers={"Accept": "application/json"})
    return response.json()

# Usage
result = join_waitlist("user@example.com", "John Doe", "DPYA0QB3")
print(f"Your referral link: {result['data']['referral_link']}")
```

### PHP

```php
<?php
// Join the waitlist
function joinWaitlist($email, $name, $referralCode = null) {
    $url = "https://lawexa.com/api/waitlist";

    $data = [
        'email' => $email,
        'name' => $name
    ];

    if ($referralCode) {
        $data['waitlist-ref'] = $referralCode;
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Get stats
function getStats($referralCode) {
    $url = "https://lawexa.com/api/waitlist/{$referralCode}/stats";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Usage
$result = joinWaitlist('user@example.com', 'John Doe', 'DPYA0QB3');
echo "Your referral link: " . $result['data']['referral_link'];
?>
```

---

## Changelog

### Version 1.0 (November 2025)

- ✅ Initial API release
- ✅ Waitlist signup endpoint
- ✅ Referral tracking system
- ✅ Dynamic position calculation
- ✅ Email notifications via Mailgun
- ✅ Admin dashboard endpoint

---

## Support

For API support or questions, contact: **dev@lawexa.com**

**Documentation URL:** https://lawexa.com/v1/doc/

---

&copy; 2025 Lawexa. All rights reserved.
