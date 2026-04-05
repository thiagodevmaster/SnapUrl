<?php

namespace App\Http\Controllers\Api\V1\Shortener;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function store():  JsonResponse
    {
        //TODO: Implement the logic to shorten the URL and return the response
        return response()->json(['message' => 'URL shortened successfully']);
    }
}
