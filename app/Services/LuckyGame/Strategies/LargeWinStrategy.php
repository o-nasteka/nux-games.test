<?php

namespace App\Services\LuckyGame\Strategies;

class LargeWinStrategy implements WinStrategyInterface
{
    public function calculate(int $randomNumber): float
    {
        return round($randomNumber * 0.5, 2);
    }
}
