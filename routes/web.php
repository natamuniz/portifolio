<?php

use App\Http\Controllers\ImagemController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', InicioController::class)->name('inicio');
Route::get('/projetos/{slug}', ProjetoController::class)->name('projeto');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/img/projetos/{slug}/{nome}-{largura}.webp', ImagemController::class)
    ->where(['slug' => '[a-z0-9-]+', 'nome' => '[\w-]+?', 'largura' => '\d+'])
    ->name('imagem');
