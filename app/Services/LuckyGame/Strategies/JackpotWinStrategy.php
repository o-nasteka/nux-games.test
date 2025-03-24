<?php

namespace App\Services\LuckyGame\Strategies;

class JackpotWinStrategy implements WinStrategyInterface
{
    public function calculate(int $randomNumber): float
    {
        return round($randomNumber * 0.7, 2);
    }
}
