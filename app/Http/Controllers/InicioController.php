<?php

namespace App\Http\Controllers;

use App\Portfolio\RepositorioProjetos;
use Illuminate\Contracts\View\View;

class InicioController extends Controller
{
    public function __invoke(RepositorioProjetos $projetos): View
    {
        return view('inicio', [
            'destaques' => $projetos->destaques(),
            'outros' => $projetos->outros(),
        ]);
    }
}
