<?php

namespace App\Http;

use App\Enums\StatusesEnum;

class Response
{
    public function __construct(
        private StatusesEnum $status,
        private string $message,
    )
    {
        header('Content-type: application/json');
        echo json_encode([
            'status' => $this->status->name,
            'message' => $this->message,
        ]);
    }
}