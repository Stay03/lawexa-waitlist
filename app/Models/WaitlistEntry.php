<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class WaitlistEntry extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'name',
        'referred_by_id',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * Boot the model and set up event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate referral code on creation
        static::creating(function ($waitlistEntry) {
            if (empty($waitlistEntry->referral_code)) {
                $waitlistEntry->referral_code = static::generateUniqueReferralCode();
            }
        });
    }

    /**
     * Generate a unique referral code.
     *
     * @return string
     */
    protected static function generateUniqueReferralCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (static::where('referral_code', $code)->exists());

        return $code;
    }

    /**
     * Get the dynamic position of this entry in the waitlist.
     * Position is calculated based on:
     * 1. Number of referrals (more referrals = better position)
     * 2. For ties, who reached that referral count first (earlier = better position)
     *
     * @return int
     */
    public function getPosition(): int
    {
        $myReferralCount = $this->getReferralCount();
        $myCreatedAt = $this->created_at;

        // Count how many entries have better positions than this one
        $betterCount = static::query()
            ->withCount('referrals')
            ->get()
            ->filter(function ($entry) use ($myReferralCount, $myCreatedAt) {
                // Skip self
                if ($entry->id === $this->id) {
                    return false;
                }

                $theirReferralCount = $entry->referrals_count;

                // They have more referrals - they're ahead
                if ($theirReferralCount > $myReferralCount) {
                    return true;
                }

                // Same referrals, but they joined earlier - they're ahead
                if ($theirReferralCount === $myReferralCount && $entry->created_at < $myCreatedAt) {
                    return true;
                }

                return false;
            })
            ->count();

        // Position is 1-indexed (1 = best position)
        return $betterCount + 1;
    }

    /**
     * Get the person who referred this entry.
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(WaitlistEntry::class, 'referred_by_id');
    }

    /**
     * Get all people referred by this entry.
     */
    public function referrals(): HasMany
    {
        return $this->hasMany(WaitlistEntry::class, 'referred_by_id');
    }

    /**
     * Get the count of referrals for this entry.
     *
     * @return int
     */
    public function getReferralCount(): int
    {
        return $this->referrals()->count();
    }

    /**
     * Get the referral link for this entry.
     *
     * @param string|null $baseUrl
     * @return string
     */
    public function getReferralLink(?string $baseUrl = null): string
    {
        $baseUrl = $baseUrl ?? 'https://lawexa.com';
        return rtrim($baseUrl, '/') . '?waitlist-ref=' . $this->referral_code;
    }

    /**
     * Get all referral statistics for this entry.
     *
     * @return array
     */
    public function getReferralStats(): array
    {
        return [
            'total_referrals' => $this->getReferralCount(),
            'referral_code' => $this->referral_code,
            'referral_link' => $this->getReferralLink(),
            'position' => $this->getPosition(),
        ];
    }
}
