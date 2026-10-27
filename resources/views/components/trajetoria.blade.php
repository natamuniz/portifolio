<section id="trajetoria" class="wrap section">
  <p class="eyebrow">Trajetória</p>
  <h2 class="mono traj__cmd">$ git log --oneline natã</h2>
  <ol class="traj">
    @foreach ($perfil['trajetoria'] as $commit)
      <li>
        <div class="traj__meta mono">
          <span @class(['traj__dot', 'is-head' => $loop->first]) aria-hidden="true"></span>
          <span class="accent">{{ $commit['hash'] }}</span>
          <span class="dim">{{ $commit['ano'] }}</span>
        </div>
        <div class="traj__msg mono">{{ $commit['mensagem'] }}@if ($loop->first)<span class="traj__head"> (HEAD)</span>@endif</div>
        <div class="traj__desc">{{ $commit['descricao'] }}</div>
      </li>
    @endforeach
  </ol>

  <h3 class="mono traj__cmd traj__cmd--sub">$ cat formacao.txt</h3>
  <ul class="form">
    @foreach ($perfil['formacao'] as $f)
      <li class="card form__item">
        <span @class(['form__status', 'mono', 'is-on' => $f['status'] === 'cursando'])>{{ $f['status'] }}</span>
        <h4>{{ $f['curso'] }}</h4>
        <p class="mono">{{ $f['instituicao'] }}</p>
      </li>
    @endforeach
  </ul>
</section>
