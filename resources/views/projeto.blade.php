<x-layout :titulo="$projeto->titulo.' · '.$projeto->codigo.' · Natã Muniz'" :descricao="$projeto->resumo">
  <article class="wrap prj">
    <a href="/#projetos" class="mono prj__voltar">← arquivo de projetos</a>

    <header class="prj__head">
      <p class="eyebrow">{{ $projeto->codigo }} · {{ $projeto->ano }} · {{ $projeto->tipo }}</p>
      <h1 class="prj__titulo">{{ $projeto->titulo }}</h1>
      <p class="prj__resumo">{{ $projeto->resumo }}</p>
      <div class="prj__ctas">
        @if ($projeto->link)
          <a href="{{ $projeto->link }}" target="_blank" rel="noopener" class="btn btn--primary">Ver ao vivo ↗</a>
        @endif
        @if ($projeto->repositorio)
          <a href="{{ $projeto->repositorio }}" target="_blank" rel="noopener" class="btn">Código no GitHub ↗</a>
        @endif
      </div>
    </header>

    <dl class="ficha mono">
      <div><dt>Código</dt><dd>{{ $projeto->codigo }}</dd></div>
      <div><dt>Ano</dt><dd>{{ $projeto->ano }}</dd></div>
      <div><dt>Tipo</dt><dd>{{ $projeto->tipo }}</dd></div>
      @if ($projeto->papel)
        <div class="ficha__papel"><dt>Papel</dt><dd>{{ $projeto->papel }}</dd></div>
      @endif
      @if ($projeto->stack)
        <div class="ficha__stack"><dt>Stack</dt><dd>@foreach ($projeto->stack as $s)<span class="tag">{{ $s }}</span>@endforeach</dd></div>
      @endif
    </dl>

    @if ($projeto->capa)
      <figure class="prj__capa">
        <img src="{{ $projeto->imagem($projeto->capa, 1440) }}" srcset="{{ $projeto->srcset($projeto->capa, [800, 1440]) }}" sizes="(max-width: 1240px) 100vw, 1192px" alt="{{ $projeto->capaAlt ?? $projeto->titulo }}" {!! $projeto->tamanho($projeto->capa) !!} decoding="async" />
      </figure>
    @elseif ($projeto->previa)
      <pre class="prj__previa mono">{{ $projeto->previa }}</pre>
    @endif

    @if ($corpo = $projeto->corpoHtml())
      <div class="prose">{!! $corpo !!}</div>
    @endif

    @if ($projeto->galeria)
      <div class="prj__galeria">
        @foreach ($projeto->galeria as $g)
          <figure>
            <img src="{{ $projeto->imagem($g['arquivo'], 800) }}" srcset="{{ $projeto->srcset($g['arquivo'], [400, 800]) }}" sizes="(max-width: 700px) 100vw, 400px" alt="{{ $g['alt'] }}" {!! $projeto->tamanho($g['arquivo']) !!} loading="lazy" decoding="async" />
            <figcaption class="mono">{{ $g['alt'] }}</figcaption>
          </figure>
        @endforeach
      </div>
    @endif

    <nav class="prj__nav mono" aria-label="Outros projetos">
      @if ($anterior)
        <a href="{{ $anterior->url() }}">← {{ $anterior->codigo }} {{ $anterior->titulo }}</a>
      @else
        <span></span>
      @endif
      @if ($proximo)
        <a href="{{ $proximo->url() }}">{{ $proximo->codigo }} {{ $proximo->titulo }} →</a>
      @endif
    </nav>
  </article>
</x-layout>
