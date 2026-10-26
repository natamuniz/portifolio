// Dados pessoais do site. Edite aqui: nome, links, textos do "Sobre" e trajetória.

export const perfil = {
  nome: 'Natã',
  sobrenome: 'Muniz',
  iniciais: 'NM',
  cargo: 'Desenvolvedor back-end · PHP/Laravel e Python',
  chamada:
    'Desenvolvo sistemas, automações, integrações de APIs e bancos de dados. Hoje sou responsável técnico por um SIGAD em conformidade com o e-ARQ Brasil na Safe Conversão Digital. Cada projeto aqui é um registro catalogado, com ficha, data e prova de que funciona.',
  disponibilidade: '// aberto a freelas e novas oportunidades',

  linkedin: 'https://www.linkedin.com/in/nata-muniz/',
  github: 'https://github.com/natamuniz',
  email: 'natan.mtrindade@gmail.com', // vazio esconde o e-mail no site
  curriculo: '/curriculo.pdf', // arquivo em public/ — vazio esconde o botão
  // Endereço de um serviço de formulário (Formspree, Getform...). Vazio: o formulário abre o e-mail.
  formulario: '',

  foto: '', // ex.: '/foto.jpg' em public/ — vazio esconde o espaço da foto

  // Sobre: cole aqui o "Sobre" do seu LinkedIn (um parágrafo por item).
  sobreTitulo: [
    'Sou o Natã, desenvolvedor back-end com ',
    { destaque: 'PHP/Laravel' },
    ' e ',
    { destaque: 'Python' },
    '.',
  ],
  sobre: [
    'Atuo em desenvolvimento de sistemas, automação de processos, integração de APIs e banco de dados.',
    'Sou responsável técnico pelo desenvolvimento de um SIGAD em conformidade com o e-ARQ Brasil e as resoluções do CONARQ, construído com Laravel, PostgreSQL e Vue/Inertia. Em Python, desenvolvo automações e pipelines de processamento de documentos com integração a APIs de IA.',
    'No desenvolvimento com IA, trabalho com Spec-Driven Development (SDD) usando OpenSpec e agentes de codificação (Claude Code, Codex, Pi e outros), sempre com revisão humana.',
  ],
  fatos: [
    { icone: 'RJ', valor: 'Rio de Janeiro', rotulo: 'base' },
    { icone: '</>', valor: 'PHP · Python', rotulo: 'stack principal' },
    { icone: 'AI', valor: 'IA com revisão humana', rotulo: 'spec-driven development' },
  ],
} as const;

export const habilidades = [
  { icone: '{ }', titulo: 'Back-end e APIs', texto: 'Sistemas e APIs REST em Laravel, com autenticação, perfis de acesso, filas e integrações via JSON.' },
  { icone: '▦', titulo: 'Gestão documental', texto: 'SIGAD em conformidade com o e-ARQ Brasil e as resoluções do CONARQ: classificação, temporalidade e auditoria.' },
  { icone: '▤', titulo: 'Banco de dados', texto: 'Modelagem em PostgreSQL, consultas recursivas e regras de negócio garantidas no próprio banco.' },
  { icone: '>_', titulo: 'Automação e IA em Python', texto: 'Automações e pipelines de processamento de documentos, com OCR e integração a APIs de IA.' },
  { icone: '◧', titulo: 'Front-end com Vue', texto: 'Telas em Vue.js com Inertia sobre o Laravel, e sites estáticos rápidos e otimizados para busca.' },
  { icone: '◇', titulo: 'Desenvolvimento com IA', texto: 'Spec-Driven Development com OpenSpec e agentes como Claude Code e Codex, sempre com revisão humana.' },
  { icone: '✓', titulo: 'Testes e qualidade', texto: 'PHPUnit, PHPStan e CI: cada decisão técnica com um teste que a comprova.' },
  { icone: '⧉', titulo: 'Docker, Linux e Git', texto: 'Ambientes em Docker Compose, servidores Linux e deploy a cada push.' },
];

// Trajetória, do mais recente para o mais antigo. Aparece como um "git log".
// Para incluir experiências profissionais do LinkedIn, adicione itens aqui.
export const trajetoria = [
  { hash: 'e4a90d3', ano: 'atual', mensagem: 'feat: SIGAD @ Safe Conversão Digital', descricao: 'Responsável técnico pelo SIGAD em conformidade com o e-ARQ Brasil, com Laravel, PostgreSQL e Vue/Inertia, seguindo as resoluções do CONARQ.' },
  { hash: 'a7c21f0', ano: '2026', mensagem: 'feat: Arquiva, API de gestão documental', descricao: 'Laravel 13 e PostgreSQL 16, com temporalidade versionada, sigilo e auditoria imutável.' },
  { hash: 'b81e5c7', ano: '2026', mensagem: 'wip: ChegouAqui, SaaS de encomendas', descricao: 'Django, PostgreSQL e Celery: portaria registra o pacote e o morador recebe aviso no WhatsApp.' },
  { hash: '3e9b4d2', ano: '2026', mensagem: 'feat: site Forte do Forno no ar', descricao: 'Site estático com SEO local, uma página por serviço e deploy na Vercel.' },
  { hash: 'f02a8c1', ano: '2025', mensagem: 'feat: automações de OCR em Python', descricao: 'Scripts que leem e separam documentos sozinhos.' },
  { hash: '6d2f9a4', ano: '2024', mensagem: 'feat: projetos em JavaScript e React', descricao: 'Robotron, calculadora de IMC e o Primeflix, um catálogo de filmes em React.' },
  { hash: '0000001', ano: '2022', mensagem: 'init: primeiros passos no front-end', descricao: 'HTML, CSS e JavaScript, os primeiros projetos no GitHub.' },
];

// Formação acadêmica.
export const formacao = [
  { curso: 'Engenharia de Software', instituicao: 'Estácio', status: 'cursando' },
  { curso: 'Análise e Desenvolvimento de Sistemas', instituicao: 'IBMR', status: 'concluído' },
];
