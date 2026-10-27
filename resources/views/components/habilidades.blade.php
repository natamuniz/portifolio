<section id="habilidades" class="wrap section">
  <p class="eyebrow">Habilidades &amp; serviços</p>
  <ul class="skills">
    @foreach ($perfil['habilidades'] as $h)
      <li class="card skill">
        <span class="skill__icon mono" aria-hidden="true">{{ $h['icone'] }}</span>
        <h3>{{ $h['titulo'] }}</h3>
        <p>{{ $h['texto'] }}</p>
      </li>
    @endforeach
  </ul>
</section>
