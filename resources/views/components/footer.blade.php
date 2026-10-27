<footer class="foot">
  <div class="wrap foot__in mono">
    <span><span class="accent foot__logo">{{ $perfil['iniciais'] }}_</span> © {{ now()->year }} {{ $perfil['nome'] }} {{ $perfil['sobrenome'] }}</span>
    <span>Feito no Rio · registro atualizado em {{ now()->format('d/m/Y') }}</span>
    <div class="foot__links">
      <a class="icon-btn" href="{{ $perfil['github'] }}" target="_blank" rel="noopener" aria-label="GitHub">gh</a>
      <a class="icon-btn" href="{{ $perfil['linkedin'] }}" target="_blank" rel="noopener" aria-label="LinkedIn">in</a>
      <a class="icon-btn" href="#conteudo" aria-label="Voltar ao topo">↑</a>
    </div>
  </div>
</footer>
