import { defineCollection } from 'astro:content';
import { glob } from 'astro/loaders';
import { z } from 'astro/zod';

// Cada projeto é uma pasta em src/content/projetos/<slug>/ com um index.md.
const projetos = defineCollection({
  loader: glob({ pattern: '**/index.md', base: './src/content/projetos' }),
  schema: ({ image }) =>
    z.object({
      titulo: z.string(),
      codigo: z.string(), // ex.: PRJ-003
      ano: z.number(),
      tipo: z.string(), // ex.: API, Site, Automação
      resumo: z.string(),
      papel: z.string().optional(),
      stack: z.array(z.string()).default([]),
      link: z.string().url().optional(),
      repositorio: z.string().url().optional(),
      selo: z.string().optional(), // texto da etiqueta no card: "Destaque", "No ar"...
      capa: image().optional(),
      capaAlt: z.string().optional(),
      // Sem capa? Um trecho de código vira a "imagem" do card.
      previa: z.string().optional(),
      galeria: z.array(z.object({ src: image(), alt: z.string() })).default([]),
      destaque: z.boolean().default(false),
      ordem: z.number().default(99),
    }),
});

export const collections = { projetos };
