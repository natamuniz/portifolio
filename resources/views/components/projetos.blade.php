@props(['destaques', 'outros'])
<section id="projetos" class="wrap section">
  <div class="proj__top">
    <div>
      <p class="eyebrow">Arquivo de projetos</p>
      <h2 class="h2">Registros em destaque</h2>
    </div>
    @if ($outros->isNotEmpty())
      <a href="#outros" class="mono accent proj__all">Ver todos os registros →</a>
    @endif
  </div>

  <div class="proj__grid">
    @foreach ($destaques as $projeto)
      <x-projeto-card :projeto="$projeto" />
    @endforeach
    <article class="proj__slot">
      <div class="proj__slot-head mono">{{ sprintf('PRJ-%03d', $destaques->count() + 1) }} · ---- · ----</div>
      <div class="proj__slot-body">
        <span class="mono" aria-hidden="true">+</span>
        <h3>Próximo registro</h3>
        <p>Aguardando captura. Novos projetos entram aqui com uma ficha nova.</p>
      </div>
    </article>
  </div>

  @if ($outros->isNotEmpty())
    <div id="outros" class="outros">
      <div class="outros__head mono">Outros registros do arquivo</div>
      <ul>
        @foreach ($outros as $p)
          <li>
            <a href="{{ $p->url() }}">
              <span class="mono outros__cod">{{ $p->codigo }}</span>
              <span class="mono outros__nome">{{ $p->titulo }}</span>
              <span class="outros__desc">{{ $p->resumo }}</span>
              <span class="mono outros__ano">{{ $p->ano }}</span>
              <span class="accent" aria-hidden="true">↗</span>
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  @endif
</section>
