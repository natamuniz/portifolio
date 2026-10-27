@props(['destaques'])
@php
  $principal = $destaques->first();
  $proximo = sprintf('PRJ-%03d_[aguardando-captura]/', $destaques->count() + 1);
@endphp
<section id="inicio" class="wrap hero">
  <div class="hero__text">
    <p class="mono accent hero__hello">&lt; Olá, eu sou /&gt;</p>
    <h1 class="hero__name">{{ $perfil['nome'] }}<br /><span class="accent">{{ $perfil['sobrenome'] }}</span></h1>
    <p class="mono hero__role">{{ $perfil['cargo'] }}</p>
    <p class="hero__lead">{{ $perfil['chamada'] }}</p>
    <div class="hero__ctas">
      <a href="#projetos" class="btn btn--primary">Ver projetos →</a>
      @if ($perfil['curriculo'])
        <a href="{{ $perfil['curriculo'] }}" class="btn" download="Curriculo-Nata-Muniz.pdf">Baixar currículo ↓</a>
      @else
        <a href="{{ $perfil['linkedin'] }}" class="btn" target="_blank" rel="noopener">Meu LinkedIn ↗</a>
      @endif
    </div>
    <p class="mono hero__avail">{{ $perfil['disponibilidade'] }}</p>
  </div>

  <div class="hero__visual">
    <x-globo />
    <div class="term">
      <div class="term__bar">
        <div class="term__dots" aria-hidden="true"><span></span><span></span><span></span></div>
        <span class="mono">nata@rio:~/portfolio</span>
        <span class="term__led" aria-hidden="true"></span>
      </div>
      <div class="term__body mono">
        <span class="l"><span class="accent">$</span> ls projetos/</span>
        <span class="l term__ls">@foreach ($destaques as $p)<span>{{ $p->codigo }}_{{ $p->slug }}/</span>@endforeach<span class="dim">{{ $proximo }}</span></span>
        <span class="l">&nbsp;</span>
        @if ($principal)
          <span class="l"><span class="accent">$</span> cat {{ $principal->codigo }}_{{ $principal->slug }}/ficha.yml</span>
          <span class="l"><span class="dim">tipo:   </span> API de gestão documental</span>
          <span class="l"><span class="dim">stack:  </span> [{{ implode(', ', array_slice($principal->stack, 0, 3)) }}]</span>
          <span class="l"><span class="dim">regras: </span> temporalidade, sigilo, auditoria</span>
          <span class="l"><span class="dim">fixidez:</span> sha256 <span class="accent">✓ íntegro</span></span>
          <span class="l">&nbsp;</span>
        @endif
        <span class="l"><span class="accent">$</span> <span class="term__caret cursor"></span></span>
      </div>
    </div>
  </div>
</section>
