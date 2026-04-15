<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MovieService
{
    public function search(string $title): array
    {
        return Cache::remember("movie_{$title}", 3600, function () use ($title) {
            $response = Http::timeout(5)
                ->retry(3, 200)
                ->get('http://www.omdbapi.com/', [
                    'apikey' => config('services.omdb.key'),
                    't' => $title
                ]);

            if (!$response->ok()) {
                return [];
            }

            $data = $response->json();

            // якщо фільм не знайдено
            if (!isset($data['Response']) || $data['Response'] === 'False') {
                return [];
            }

            return $data ?? [];
        });
    }
}
