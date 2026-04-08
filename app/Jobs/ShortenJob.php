<?php

namespace App\Jobs;

use App\Models\Identity\User;
use App\Models\Shortener\Url;
use App\Services\Shortener\HashGeneratorService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class ShortenJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private array $data,
        private User $user, 
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(HashGeneratorService $hashGenerator): void
    {
         $id = Redis::incr('short_url_id');
        $code = $hashGenerator->generateHash($id);

        Url::create([
            'id' => $id,
            'short_code' => $code,
            'title' => $this->data['title'] ?? null,
            'description' => $this->data['description'] ?? null,
            'url' => $this->data['url'],
            'user_id' => $this->user->id,
            'status' => $this->data['status'] ?? true,
        ]);
    }
}
