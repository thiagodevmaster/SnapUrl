<?php

namespace App\Http\Controllers\Api\V1\Shortener;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shortener\ShortenRequest;
use App\Jobs\ShortenJob;
use Illuminate\Http\JsonResponse;

class UrlController extends Controller
{

    public function store(ShortenRequest $request):  JsonResponse
    {
        $data = $request->validated();
        
        ShortenJob::dispatch($data, $request->user());
        
        return response()->json(['message' => 'URL shortened successfully']);
    }
}
