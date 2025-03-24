<?php

namespace App\Services\LuckyGame\Strategies;

interface WinStrategyInterface
{
    public function calculate(int $randomNumber): float;
}
