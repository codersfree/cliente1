<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Token{

    public function getAccessToken($user, $service){

        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post('http://api.codersfree.test/oauth/token', [
            'grant_type' => 'password',
            'client_id' => config('services.codersfree.client_id'),
            'client_secret' => config('services.codersfree.client_secret'),
            'username' => request('email'),
            'password' => request('password')
        ]);

        $access_token = $response->json();

        $user->accessToken()->create([
            'service_id' => $service['data']['id'],
            'access_token' => $access_token['access_token'],
            'refresh_token' => $access_token['refresh_token'],
            'expires_at' => now()->addSecond($access_token['expires_in'])
        ]);
    }

}