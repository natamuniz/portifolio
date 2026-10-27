<?php

namespace App\Http\Controllers;

use App\Portfolio\RepositorioProjetos;
use Illuminate\Contracts\View\View;

class ProjetoController extends Controller
{
    public function __invoke(RepositorioProjetos $projetos, string $slug): View
    {
        $todos = $projetos->todos();
        $posicao = $todos->search(fn ($p) => $p->slug === $slug);

        abort_if($posicao === false, 404);

        return view('projeto', [
            'projeto' => $todos[$posicao],
            'anterior' => $todos[$posicao - 1] ?? null,
            'proximo' => $todos[$posicao + 1] ?? null,
        ]);
    }
}
