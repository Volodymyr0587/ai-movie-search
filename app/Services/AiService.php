<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Exceptions\AiException;

class AiService
{
    public function parseQuery(string $query): array
    {
        $prompt = "
        You are a movie and serials recommendation system.

        User query (can be Ukrainian or any language): {$query}

        1. Understand the query
        2. Translate internally to English if needed
        3. Return ONLY a JSON array of real movie titles in English

        Example:
        [\"Inception\", \"Interstellar\"]
        ";

        $response = Http::timeout(10)
            ->retry(3, 300)
            ->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent?key=" . config('services.gemini.key'),
                [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]]
                    ]
                ]
            );

        // if (!$response->ok()) {
        //     return [];
        // }

        if ($response->failed()) {

            if ($response->status() === 429) {
                throw new AiException('AI limit exceeded. Try again later 🙃');
            }

            throw new AiException('AI service is unavailable right now.');
        }

        $text = data_get($response->json(), 'candidates.0.content.parts.0.text');

        try {
            return json_decode($text, true, 512, JSON_THROW_ON_ERROR);
        } catch (\Throwable $e) {
            return [];
        }
    }
}
