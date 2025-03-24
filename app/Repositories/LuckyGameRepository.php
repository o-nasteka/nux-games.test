<?php

namespace App\Repositories;

use App\Models\LuckyGame;

class LuckyGameRepository
{
    /**
     * Store a new lucky game result.
     */
    public function store(int $accessLinkId, array $result): void
    {
        LuckyGame::create([
            'access_link_id' => $accessLinkId,
            'number' => $result['number'],
            'is_win' => $result['isWin'],
            'win_amount' => $result['winAmount'],
        ]);
    }

    /**
     * Keep only the latest 3 records per token.
     */
    public function cleanOldRecords(string $accessLinkId): void
    {
        LuckyGame::where('access_link_id', $accessLinkId)
            ->orderBy('created_at', 'desc')
            ->skip(3)
            ->take(PHP_INT_MAX)
            ->delete();
    }
}
