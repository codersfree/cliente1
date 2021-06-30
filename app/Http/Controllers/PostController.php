<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function store(){

        $this->resolveAuthorization();

        $response = Http::withHeaders([
            'Accept'    => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->post('http://api.codersfree.test/v1/posts', [
            'name' => 'Este es un nombre de prueba',
            'slug' => 'esto-esun-nombre-de-prueba',
            'extract' => 'sdsdsds',
            'body' => 'asdasdasdasdas',
            'category_id' => 1
        ]);

        return $response->json();

    }
}
