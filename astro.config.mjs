import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';

// Troque pelo endereço final do site quando tiver domínio.
export default defineConfig({
  site: 'https://portifolio-efa.pages.dev',
  integrations: [sitemap()],
});
