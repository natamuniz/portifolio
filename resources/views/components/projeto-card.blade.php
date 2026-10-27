@props(['projeto'])
<article class="card pcard">
  <div class="pcard__head mono">
    <span>{{ $projeto->codigo }} · {{ $projeto->ano }} · {{ mb_strtoupper($projeto->tipo) }}</span>
    @if ($projeto->selo)
      <span class="pcard__selo">{{ mb_strtoupper($projeto->selo) }}</span>
    @endif
  </div>
  <a href="{{ $projeto->url() }}" class="pcard__media" tabindex="-1" aria-hidden="true">
    @if ($projeto->capa)
      <img src="{{ $projeto->imagem($projeto->capa, 800) }}" srcset="{{ $projeto->srcset($projeto->capa, [400, 800]) }}" sizes="(max-width: 700px) 100vw, 400px" alt="" {!! $projeto->tamanho($projeto->capa) !!} loading="lazy" decoding="async" />
    @else
      <pre class="mono">{{ $projeto->previa }}</pre>
    @endif
  </a>
  <div class="pcard__body">
    <h3><a href="{{ $projeto->url() }}" class="pcard__link">{{ $projeto->titulo }}</a></h3>
    <p>{{ $projeto->resumo }}</p>
    <div class="pcard__tags">
      @foreach (array_slice($projeto->stack, 0, 4) as $s)
        <span class="tag">{{ $s }}</span>
      @endforeach
    </div>
    <div class="pcard__foot">
      <span class="mono">{{ $projeto->enderecoCurto() }}</span>
      <span class="icon-btn" aria-hidden="true">↗</span>
    </div>
  </div>
</article>
