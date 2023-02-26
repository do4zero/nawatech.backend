<?php

namespace App\Services\ShoppingSession\API;

use App\Interfaces\ShoppingSession\ShoppingSessionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CreateSessionService
{
    protected $session;
    private ShoppingSessionRepositoryInterface $sessionRepository;

    function __construct(ShoppingSessionRepositoryInterface $sessionRepository) {
        $this->sessionRepository = $sessionRepository;
    }

    public function create($params = array()){
        DB::beginTransaction();
        try {
            $session = $this->sessionRepository->create($params);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'reason' => $th->getMessage(),
                'message' => 'Session failed to create'
            ];
        }

        return [
            'status' => true,
            'data' => [
                'session_id' => $session->session_id
            ],
            'message' => 'Session successfully created'
        ];
    }
}
