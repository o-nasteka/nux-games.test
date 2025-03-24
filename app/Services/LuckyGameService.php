<?php

namespace App\Services;

use App\Services\LuckyGame\StrategyResolver;

class LuckyGameService
{
    public function __construct(
        protected StrategyResolver $strategyResolver
    ) {}

    public function generateResult(int $randomNumber): array
    {
        $isWin = $randomNumber % 2 === 0;
        $winAmount = 0;

        if ($isWin) {
            $strategy = $this->strategyResolver->resolve($randomNumber);
            $winAmount = $strategy->calculate($randomNumber);
        }

        return [
            'number'    => $randomNumber,
            'isWin'     => $isWin,
            'winAmount' => $winAmount,
        ];
    }
}
