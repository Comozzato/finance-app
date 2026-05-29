<?php

namespace App\Http\Controllers\Api\V1\Pluggy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PluggyConnectController extends Controller
{
    //
    protected string $clientId;
    protected string $clientSecret;
    public function __construct()
    {
        $this->clientId = config('services.pluggy.client_id');
        $this->clientSecret = config('services.pluggy.client_secret');
    }

    public function __invoke(Request $request)
    {


        $authResponse = file_get_contents('https://api.pluggy.ai/auth', false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode([
                    'clientId' => $this->clientId,
                    'clientSecret' => $this->clientSecret,
                ])
            ]
        ]));

        $clientUserId = '123';
        $apiKey = json_decode($authResponse)->apiKey;

        if (!$clientUserId) {
            return response()->json([
                'error' => 'clientUserId não enviado'
            ], 422);
        }

        $connectTokenResponse = file_get_contents('https://api.pluggy.ai/connect_token', false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\nX-API-KEY: $apiKey",
                'content' => json_encode([
                    'options' => [
                        'clientUserId' => $clientUserId
                    ]
                ])
            ]
        ]));

        return response()->json([
            'accessToken' => json_decode($connectTokenResponse)->accessToken
        ]);
    }
}
