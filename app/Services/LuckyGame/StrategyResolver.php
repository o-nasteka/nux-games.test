<?php

namespace App\Services\LuckyGame;

use App\Services\LuckyGame\Strategies\{
    WinStrategyInterface,
    JackpotWinStrategy,
    LargeWinStrategy,
    MediumWinStrategy,
    SmallWinStrategy,
    LoseStrategy
};

class StrategyResolver
{
    public function resolve(int $randomNumber): WinStrategyInterface
    {
        if ($randomNumber % 2 !== 0) {
            return new LoseStrategy();
        }

        return match (true) {
            $randomNumber > config('lucky_game.thresholds.jackpot') => new JackpotWinStrategy(),
            $randomNumber > config('lucky_game.thresholds.large')   => new LargeWinStrategy(),
            $randomNumber > config('lucky_game.thresholds.medium')  => new MediumWinStrategy(),
            default                                                      => new SmallWinStrategy(),
        };
    }
}
