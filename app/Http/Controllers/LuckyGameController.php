<?php

namespace App\Http\Controllers;

use App\Http\Requests\LuckyGameRequest;
use App\Models\AccessLink;
use App\Repositories\LuckyGameRepository;
use App\Services\LuckyGameService;
use App\Models\LuckyGame;
use Illuminate\Http\JsonResponse;
use Random\RandomException;

class LuckyGameController extends Controller
{
    protected LuckyGameService $luckyGameService;
    protected LuckyGameRepository $luckyGameRepository;

    public function __construct(LuckyGameService $luckyGameService, LuckyGameRepository $luckyGameRepository)
    {
        $this->luckyGameService = $luckyGameService;
        $this->luckyGameRepository = $luckyGameRepository;
    }

    /**
     * @throws RandomException
     */
    public function play(LuckyGameRequest $request): JsonResponse
    {
        $randomNumber = random_int(1, 1000);
        $result = $this->luckyGameService->generateResult($randomNumber);

        $accessLink = AccessLink::where('token', $request->token)->firstOrFail();

        $this->luckyGameRepository->store($accessLink->id, $result);
        $this->luckyGameRepository->cleanOldRecords($accessLink->id);

        return response()->json([
            'result' => $result,
        ]);
    }

    public function history(string $token): JsonResponse
    {
        $history = LuckyGame::select('lucky_games.number', 'lucky_games.is_win', 'lucky_games.win_amount')
            ->join('access_links', 'lucky_games.access_link_id', '=', 'access_links.id')
            ->where('access_links.token', $token)
            ->latest('lucky_games.created_at')
            ->take(3)
            ->get();

        return response()->json([
            'history' => $history,
        ]);
    }


}
