<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WaitlistEntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'referral_code' => $this->referral_code,
            'referral_link' => $this->getReferralLink(),
            'position' => $this->getPosition(),
            'total_referrals' => $this->getReferralCount(),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
