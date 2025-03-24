<?php

namespace App\Services\LuckyGame\Strategies;

class LoseStrategy implements WinStrategyInterface
{
    public function calculate(int $randomNumber): float
    {
        return 0;
    }
}
