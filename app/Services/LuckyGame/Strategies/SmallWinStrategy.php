<?php

namespace App\Services\LuckyGame\Strategies;

class SmallWinStrategy implements WinStrategyInterface
{
    public function calculate(int $randomNumber): float
    {
        return round($randomNumber * 0.1, 2);
    }
}
