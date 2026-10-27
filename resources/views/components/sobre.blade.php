<section id="sobre" class="wrap section sobre">
  @if ($perfil['foto'])
    <div class="sobre__foto">
      <img src="{{ $perfil['foto'] }}" alt="Foto de {{ $perfil['nome'] }} {{ $perfil['sobrenome'] }}" width="340" height="425" loading="lazy" />
      <span class="sobre__barra" aria-hidden="true"></span>
      <span class="sobre__carimbo mono" aria-hidden="true">Ficha · Autor</span>
    </div>
  @endif
  <div @class(['sobre__texto', 'sobre__texto--solo' => ! $perfil['foto']])>
    <p class="eyebrow">Sobre mim</p>
    <h2 class="sobre__titulo">{!! collect($perfil['sobre_titulo'])->map(fn ($t) => is_array($t) ? '<span class="accent">'.e($t['destaque']).'</span>' : e($t))->implode('') !!}</h2>
    @foreach ($perfil['sobre'] as $paragrafo)
      <p class="sobre__p">{{ $paragrafo }}</p>
    @endforeach
    <ul class="sobre__fatos">
      @foreach ($perfil['fatos'] as $fato)
        <li>
          <span class="sobre__icone mono" aria-hidden="true">{{ $fato['icone'] }}</span>
          <div>
            <div class="sobre__valor">{{ $fato['valor'] }}</div>
            <div class="sobre__rotulo mono">{{ $fato['rotulo'] }}</div>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</section>
