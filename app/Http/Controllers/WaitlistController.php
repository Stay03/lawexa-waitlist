<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWaitlistEntryRequest;
use App\Http\Resources\WaitlistEntryResource;
use App\Mail\WaitlistConfirmationMail;
use App\Models\WaitlistEntry;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class WaitlistController extends Controller
{
    /**
     * Store a new waitlist entry.
     *
     * @param StoreWaitlistEntryRequest $request
     * @return JsonResponse
     */
    public function store(StoreWaitlistEntryRequest $request): JsonResponse
    {
        // Get validated data
        $validated = $request->validated();

        // Find the referrer if waitlist-ref code is provided
        $referredById = null;
        if (!empty($validated['waitlist-ref'])) {
            $referrer = WaitlistEntry::where('referral_code', $validated['waitlist-ref'])->first();
            if ($referrer) {
                $referredById = $referrer->id;
            }
        }

        // Create the waitlist entry
        $entry = WaitlistEntry::create([
            'email' => $validated['email'],
            'name' => $validated['name'] ?? null,
            'referred_by_id' => $referredById,
        ]);

        // Send confirmation email (queued)
        Mail::to($entry->email)->send(new WaitlistConfirmationMail($entry));

        // Return the entry with stats
        return response()->json([
            'success' => true,
            'message' => 'Successfully joined the waitlist!',
            'data' => new WaitlistEntryResource($entry),
        ], 201);
    }

    /**
     * Get stats for a specific referral code.
     *
     * @param string $referralCode
     * @return JsonResponse
     */
    public function show(string $referralCode): JsonResponse
    {
        $entry = WaitlistEntry::where('referral_code', $referralCode)->first();

        if (!$entry) {
            return response()->json([
                'success' => false,
                'message' => 'Referral code not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $entry->getReferralStats(),
        ]);
    }

    /**
     * Get all waitlist entries (admin endpoint).
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Get all entries with referral counts, ordered by position
        $entries = WaitlistEntry::withCount('referrals')
            ->get()
            ->sortByDesc('referrals_count')
            ->values()
            ->map(function ($entry, $index) {
                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'email' => $entry->email,
                    'referral_code' => $entry->referral_code,
                    'position' => $index + 1,
                    'total_referrals' => $entry->referrals_count,
                    'joined_at' => $entry->created_at->toIso8601String(),
                ];
            });

        return response()->json([
            'success' => true,
            'total' => $entries->count(),
            'entries' => $entries,
        ]);
    }
}
