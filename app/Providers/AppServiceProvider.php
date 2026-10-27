<?php

namespace App\Providers;

use App\Portfolio\RepositorioProjetos;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            RepositorioProjetos::class,
            fn () => new RepositorioProjetos(resource_path('content/projetos')),
        );
    }

    public function boot(): void
    {
        // Os dados de config/perfil.php ficam disponíveis em todas as views como $perfil.
        View::share('perfil', config('perfil'));
    }
}
