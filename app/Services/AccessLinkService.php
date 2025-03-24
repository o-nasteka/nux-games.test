<?php

namespace App\Services;

use App\Models\AccessLink;
use App\Repositories\AccessLinkRepository;
use App\Support\TokenGenerator;
use Illuminate\Support\Carbon;

class AccessLinkService
{
    public function __construct(
        protected AccessLinkRepository $repository
    ) {}

    public function getValidLink(string $token): ?AccessLink
    {
        return $this->repository->findValidByToken($token);
    }

    public function regenerateToken(string $token): AccessLink
    {
        $accessLink = $this->repository->findByTokenOrFail($token);

        $newToken = TokenGenerator::generate();
        $expiresAt = now()->addMinutes(config('settings.link_expiration_minutes'));

        return $this->repository->updateToken($accessLink, $newToken, $expiresAt);
    }

    public function deactivateToken(string $token): void
    {
        $this->repository->deleteByToken($token);
    }

    public function createAccessLink(string $username, string $phone): AccessLink
    {
        $token = TokenGenerator::generate();

        return $this->repository->create([
            'username' => $username,
            'phone' => $phone,
            'token' => $token,
            'expires_at' => Carbon::now()->addMinutes(config('settings.link_expiration_minutes')),
        ]);
    }
}
