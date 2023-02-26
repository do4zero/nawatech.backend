<?php

namespace App\Http\Controllers\API\ShoppingSession;

use App\Http\Controllers\ApiController as BaseController;
use App\Http\Requests\API\ShoppingSession\CreateSessionRequest;
use App\Libs\HttpStatusCode;
use App\Services\ShoppingSession\API\CreateSessionService;

class SessionController extends BaseController
{
    /**
     * Create Session
     */
    public function createSession(CreateSessionRequest $request, CreateSessionService $createSession){
        $result = $createSession->create($request->all());

        $data = $result['data'];
        $message = $result['message'];

        return $this
            ->responseCode(HttpStatusCode::HTTP_201_CREATED)
            ->respond($data, $message);
    }
}
