@props([
    'titulo' => "{$perfil['nome']} {$perfil['sobrenome']} · Portfólio",
    'descricao' => $perfil['chamada'],
])
@php($canonico = rtrim(config('app.url'), '/').'/'.ltrim(request()->getPathInfo() === '/' ? '' : rtrim(request()->getPathInfo(), '/').'/', '/'))
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $titulo }}</title>
    <meta name="description" content="{{ $descricao }}" />
    <link rel="canonical" href="{{ $canonico }}" />
    <meta property="og:title" content="{{ $titulo }}" />
    <meta property="og:description" content="{{ $descricao }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $canonico }}" />
    <meta name="theme-color" content="#0a0b0a" />
    <link rel="icon" href="/favicon.svg" type="image/svg+xml" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wdth,wght@62..125,400..900&family=JetBrains+Mono:wght@400;500;700&display=swap" />
    <link rel="stylesheet" href="/css/site.css?v={{ filemtime(public_path('css/site.css')) }}" />
  </head>
  <body>
    <a class="skip" href="#conteudo">Pular para o conteúdo</a>
    <x-nav />
    <main id="conteudo">
      {{ $slot }}
    </main>
    <x-footer />
    <script src="/js/site.js?v={{ filemtime(public_path('js/site.js')) }}" defer></script>
  </body>
</html>
