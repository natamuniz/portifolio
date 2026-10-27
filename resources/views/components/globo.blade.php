{{-- Globo em wireframe com o Rio de Janeiro marcado. --}}
<svg class="globe" viewBox="0 0 400 400" aria-hidden="true">
  <defs>
    <radialGradient id="globe-glow" cx="50%" cy="50%" r="50%">
      <stop offset="60%" stop-color="#0a0b0a" stop-opacity="0"></stop>
      <stop offset="100%" stop-color="#c6f432" stop-opacity="0.18"></stop>
    </radialGradient>
  </defs>
  <circle cx="200" cy="200" r="190" fill="url(#globe-glow)"></circle>
  <g fill="none" stroke="#c6f432" stroke-width="0.8" stroke-opacity="0.45">
    <circle cx="200" cy="200" r="180"></circle>
    <ellipse cx="200" cy="200" rx="180" ry="60"></ellipse>
    <ellipse cx="200" cy="200" rx="180" ry="120"></ellipse>
    <line x1="20" y1="200" x2="380" y2="200"></line>
    <g class="globe__spin">
      <ellipse cx="200" cy="200" rx="60" ry="180"></ellipse>
      <ellipse cx="200" cy="200" rx="120" ry="180"></ellipse>
      <line x1="200" y1="20" x2="200" y2="380"></line>
    </g>
  </g>
  <circle class="globe__ping" cx="232" cy="262" r="4" fill="none" stroke="#c6f432" stroke-width="1.5"></circle>
  <circle cx="232" cy="262" r="4" fill="#c6f432"></circle>
  <text x="244" y="280" fill="#c6f432" font-family="JetBrains Mono, monospace" font-size="11">22.9°S 43.2°W · RJ</text>
</svg>
