<?php

namespace App\Services\LuckyGame\Strategies;

class MediumWinStrategy implements WinStrategyInterface
{
    public function calculate(int $randomNumber): float
    {
        return round($randomNumber * 0.3, 2);
    }
}
