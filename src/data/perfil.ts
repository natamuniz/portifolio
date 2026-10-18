// Dados pessoais do site. Edite aqui: nome, links, textos do "Sobre" e trajetória.

export const perfil = {
  nome: 'Natã',
  sobrenome: 'Muniz',
  iniciais: 'NM',
  cargo: 'Desenvolvedor web · Rio de Janeiro',
  chamada:
    'Construo APIs com regra de negócio de verdade e sites que carregam rápido e aparecem no Google. Cada projeto aqui é um registro catalogado, com ficha, data e prova de que funciona.',
  disponibilidade: '// aberto a freelas e novas oportunidades',

  linkedin: 'https://www.linkedin.com/in/nata-muniz/',
  github: 'https://github.com/natamuniz',
  email: '', // ex.: 'voce@email.com' — vazio esconde o e-mail no site
  curriculo: '', // ex.: '/curriculo.pdf' (coloque o arquivo em public/) — vazio esconde o botão
  // Endereço de um serviço de formulário (Formspree, Getform...). Vazio: o formulário abre o e-mail.
  formulario: '',

  foto: '', // ex.: '/foto.jpg' em public/ — vazio mostra um placeholder

  // Sobre: cole aqui o "Sobre" do seu LinkedIn (um parágrafo por item).
  sobreTitulo: [
    'Sou o Natã, um dev que gosta de ',
    { destaque: 'regra de negócio' },
    ' bem modelada e de site que ',
    { destaque: 'carrega rápido' },
    '.',
  ],
  sobre: [
    'Comecei pelo HTML, CSS e JavaScript, passei por automações em Python e hoje construo APIs em Laravel e sites estáticos otimizados para busca.',
    'Gosto de problemas em que o código precisa provar que está certo: testes, auditoria, integridade.',
  ],
  fatos: [
    { icone: 'RJ', valor: 'Rio de Janeiro', rotulo: 'base' },
    { icone: '</>', valor: 'PHP · Python · JS', rotulo: 'stack principal' },
    { icone: '☕', valor: 'Café primeiro', rotulo: 'depois o código' },
  ],
} as const;

export const habilidades = [
  { icone: '{ }', titulo: 'Back-end e APIs', texto: 'APIs REST em Laravel com autenticação por token, perfis de acesso e filas.' },
  { icone: '▤', titulo: 'Banco de dados', texto: 'Modelagem em PostgreSQL e MySQL, consultas recursivas e regras garantidas no banco.' },
  { icone: '⚡', titulo: 'Sites rápidos e SEO', texto: 'HTML, CSS e JS puros, imagens WebP, sitemap e dados estruturados para o Google.' },
  { icone: '>_', titulo: 'Automação em Python', texto: 'OCR, separação de PDFs e rotinas que tiram trabalho repetitivo do caminho.' },
  { icone: '✓', titulo: 'Testes e qualidade', texto: 'PHPUnit, PHPStan e CI: cada decisão técnica com um teste que a comprova.' },
  { icone: '⧉', titulo: 'Docker e deploy', texto: 'Ambiente em Docker Compose e publicação na Vercel a cada push.' },
];

// Trajetória, do mais recente para o mais antigo. Aparece como um "git log".
// Para incluir experiências profissionais do LinkedIn, adicione itens aqui.
export const trajetoria = [
  { hash: 'a7c21f0', ano: '2026', mensagem: 'feat: Arquiva, API de gestão documental', descricao: 'Laravel 13 e PostgreSQL 16, com temporalidade versionada, sigilo e auditoria imutável.' },
  { hash: '3e9b4d2', ano: '2026', mensagem: 'feat: site Forte do Forno no ar', descricao: 'Site estático com SEO local, uma página por serviço e deploy na Vercel.' },
  { hash: 'f02a8c1', ano: '2025', mensagem: 'feat: automações de OCR em Python', descricao: 'Scripts que leem e separam documentos sozinhos.' },
  { hash: '0000001', ano: '2022', mensagem: 'init: primeiros passos no front-end', descricao: 'HTML, CSS e JavaScript, os primeiros projetos no GitHub.' },
];
