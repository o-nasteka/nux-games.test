<?php

namespace App\Repositories;

use App\Models\AccessLink;
use Carbon\Carbon;

class AccessLinkRepository
{
    public function create(array $data): AccessLink
    {
        return AccessLink::create($data);
    }

    public function updateToken(AccessLink $link, string $newToken, Carbon $expiresAt): AccessLink
    {
        $link->update([
            'token' => $newToken,
            'expires_at' => $expiresAt,
        ]);

        return $link;
    }

    public function deleteByToken(string $token): void
    {
        AccessLink::where('token', $token)->delete();
    }
    public function findValidByToken(string $token): ?AccessLink
    {
        return AccessLink::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();
    }

    public function findByTokenOrFail(string $token): AccessLink
    {
        return AccessLink::where('token', $token)->firstOrFail();
    }
}
