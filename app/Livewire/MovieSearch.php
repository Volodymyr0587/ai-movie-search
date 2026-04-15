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

    public function search(AiService $ai, MovieService $movies)
    {
        $this->loading = true;

        $titles = $ai->parseQuery($this->query);

        $this->movies = collect($titles)
            ->map(fn($title) => $movies->search($title))
            ->filter(fn($m) => isset($m['Title']))
            // ->filter(fn($m) => !empty($m))
            ->values()
            ->toArray();

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.movie-search');
    }
}
