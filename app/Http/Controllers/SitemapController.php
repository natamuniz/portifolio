<?php

namespace App\Http\Controllers;

use App\Portfolio\RepositorioProjetos;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(RepositorioProjetos $projetos): Response
    {
        $base = rtrim(config('app.url'), '/');
        $urls = $projetos->todos()
            ->map(fn ($p) => $base.$p->url())
            ->prepend($base.'/');

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
