{{-- Com "formulario" preenchido em config/perfil.php, o formulário envia para esse serviço.
     Sem ele, mas com e-mail, abre o app de e-mail da pessoa já preenchido (ver public/js/site.js). --}}
<section id="contato" class="wrap section contato">
  <div class="contato__texto">
    <p class="eyebrow">Contato</p>
    <h2 class="h2 contato__titulo">Vamos abrir um <span class="accent">novo registro?</span></h2>
    <p class="contato__p">Tem um projeto, uma vaga ou só quer trocar uma ideia? Me chama.</p>
    <ul class="contato__lista mono">
      @if ($perfil['email'])
        <li><a href="mailto:{{ $perfil['email'] }}"><span class="icon-btn" aria-hidden="true">@</span>{{ $perfil['email'] }}</a></li>
      @endif
      <li><a href="{{ $perfil['linkedin'] }}" target="_blank" rel="noopener"><span class="icon-btn" aria-hidden="true">in</span>linkedin.com/in/nata-muniz</a></li>
      <li><a href="{{ $perfil['github'] }}" target="_blank" rel="noopener"><span class="icon-btn" aria-hidden="true">gh</span>github.com/natamuniz</a></li>
    </ul>
  </div>

  @if ($perfil['formulario'] || $perfil['email'])
    <form class="card contato__form" method="post"
      @if ($perfil['formulario']) action="{{ $perfil['formulario'] }}" @else data-email="{{ $perfil['email'] }}" @endif>
      <div class="contato__linha">
        <label>Nome<input name="nome" type="text" autocomplete="name" required /></label>
        <label>E-mail<input name="email" type="email" autocomplete="email" required /></label>
      </div>
      <label>Tipo de projeto
        <select name="tipo">
          <option>Site</option><option>API / sistema</option><option>Automação</option><option>Vaga</option><option>Outro</option>
        </select>
      </label>
      <label>Mensagem<textarea name="mensagem" rows="5" required></textarea></label>
      <button type="submit" class="btn btn--primary">Enviar mensagem →</button>
    </form>
  @else
    <div class="card contato__cta">
      <p class="mono dim">$ ./conversar --via linkedin</p>
      <p>O jeito mais rápido de falar comigo é pelo LinkedIn.</p>
      <a href="{{ $perfil['linkedin'] }}" target="_blank" rel="noopener" class="btn btn--primary">Vamos conversar ↗</a>
    </div>
  @endif
</section>
