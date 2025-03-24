<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\AccessLinkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    protected $accessLinkService;

    public function __construct(AccessLinkService $accessLinkService)
    {
        $this->accessLinkService = $accessLinkService;
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $accessLink = $this->accessLinkService->createAccessLink($data['username'], $data['phone']);

        return Redirect::route('access.show', ['token' => $accessLink->token]);
    }

}

