<?php

namespace App\Services\Shortener;

use App\Exceptions\InvalidHashException;
use Hashids\Hashids;

class HashGeneratorService
{
    private Hashids $hashids;

    public function __construct()
    {
        $this->hashids = new Hashids(env('SALT'), env('HASH_LENGTH'), env('ALLOWED_CHARACTERS'));
    }

    public function generateHash(int $id): string
    {
        return $this->hashids->encode($id + 10000);
    }

    public function decodeHash(string $hash): int
    {
        $decoded = $this->hashids->decode($hash);
        
        if (empty($decoded)) {
            throw new InvalidHashException();
        }

        return $decoded[0] - 10000;
    }
}