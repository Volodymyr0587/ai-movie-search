<?php

namespace App\Livewire;

use App\Services\AiService;
use App\Services\MovieService;
use Livewire\Component;

class MovieSearch extends Component
{
    public $query = '';
    public $movies = [];
    public $loading = false;
    public $error = '';

    // public function search(AiService $ai, MovieService $movies)
    // {
    //     $this->loading = true;

    //     $titles = $ai->parseQuery($this->query);

    //     $this->movies = collect($titles)
    //         ->map(fn($title) => $movies->search($title))
    //         ->filter(fn($m) => isset($m['Title']))
    //         // ->filter(fn($m) => !empty($m))
    //         ->values()
    //         ->toArray();

    //     $this->loading = false;
    // }


    public function search(AiService $ai, MovieService $movies)
    {
        $this->loading = true;
        $this->error = '';
        $this->movies = [];

        try {
            $titles = $ai->parseQuery($this->query);

            $this->movies = collect($titles)
                ->map(function ($title) use ($movies) {
                    try {
                        return $movies->search($title);
                    } catch (\Throwable $e) {
                        // якщо один фільм впав — не валимо все
                        return [];
                    }
                })
                ->filter(fn($m) => isset($m['Title']))
                ->values()
                ->toArray();

            if (empty($this->movies)) {
                $this->error = 'No movies found 😕';
            }

        } catch (\App\Exceptions\AiException $e) {
            $this->error = $e->getMessage();

        } catch (\Throwable $e) {
            report($e); // лог в laravel.log
            $this->error = 'Something went wrong. Try again later.';
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.movie-search');
    }
}
