// Menu do celular.
const botaoMenu = document.querySelector('.nav__toggle');
const linksMenu = document.getElementById('nav-links');

botaoMenu?.addEventListener('click', () => {
  const aberto = botaoMenu.getAttribute('aria-expanded') === 'true';
  botaoMenu.setAttribute('aria-expanded', String(!aberto));
  linksMenu?.classList.toggle('is-open', !aberto);
});

linksMenu?.querySelectorAll('a').forEach((a) =>
  a.addEventListener('click', () => {
    botaoMenu?.setAttribute('aria-expanded', 'false');
    linksMenu.classList.remove('is-open');
  }),
);

// Sem serviço de formulário: monta um e-mail com o que a pessoa escreveu.
const formulario = document.querySelector('.contato__form[data-email]');

formulario?.addEventListener('submit', (e) => {
  e.preventDefault();
  const f = new FormData(formulario);
  const assunto = `[Portfólio] ${f.get('tipo')} — ${f.get('nome')}`;
  const corpo = `${f.get('mensagem')}\n\n${f.get('nome')} · ${f.get('email')}`;
  location.href = `mailto:${formulario.dataset.email}?subject=${encodeURIComponent(assunto)}&body=${encodeURIComponent(corpo)}`;
});
