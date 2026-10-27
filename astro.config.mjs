import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';

// Endereço final do site (domínio próprio, apontado na Cloudflare Pages).
export default defineConfig({
  site: 'https://natamunizdev.com.br',
  integrations: [sitemap()],
});
