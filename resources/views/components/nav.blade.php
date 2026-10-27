@php($links = [
    '/#inicio' => 'Início',
    '/#sobre' => 'Sobre',
    '/#habilidades' => 'Habilidades',
    '/#projetos' => 'Projetos',
    '/#trajetoria' => 'Trajetória',
    '/#contato' => 'Contato',
])
<header class="nav">
  <nav class="wrap nav__in" aria-label="Principal">
    <a href="/" class="nav__logo mono" aria-label="Página inicial">{{ $perfil['iniciais'] }}<span class="cursor">_</span></a>
    <button class="nav__toggle" type="button" aria-expanded="false" aria-controls="nav-links" aria-label="Abrir menu">
      <span></span><span></span>
    </button>
    <div class="nav__links mono" id="nav-links">
      @foreach ($links as $href => $rotulo)
        <a href="{{ $href }}">{{ $rotulo }}</a>
      @endforeach
      <a href="{{ $perfil['linkedin'] }}" target="_blank" rel="noopener" class="btn btn--ghost-accent nav__cta">Vamos conversar ↗</a>
    </div>
  </nav>
</header>
