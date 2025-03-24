<?php

namespace App\Http\Controllers;

use App\Services\AccessLinkService;
use Inertia\Inertia;
use Inertia\Response;

class AccessLinkController extends Controller
{
    public function __construct(protected AccessLinkService $accessLinkService)
    {
    }
    public function show($token): Response
    {
        $link = $this->accessLinkService->getValidLink($token);

        if (!$link) {
            abort(404, 'Link expired or invalid.');
        }

        return Inertia::render('AccessPage', [
            'username' => $link->username,
            'phone' => $link->phone,
            'access_url' => route('access.show', ['token' => $link->token]),
        ]);
    }

    public function regenerate(string $token)
    {
        $updatedLink = $this->accessLinkService->regenerateToken($token);

        return Inertia::render('AccessPage', [
            'username' => $updatedLink->username,
            'phone' => $updatedLink->phone,
            'access_url' => route('access.show', ['token' => $updatedLink->token]),
        ]);
    }

    public function deactivate(string $token)
    {
        $this->accessLinkService->deactivateToken($token);

        return redirect('/');
    }



}
