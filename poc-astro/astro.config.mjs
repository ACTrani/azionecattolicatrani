// @ts-check
import { defineConfig, fontProviders } from 'astro/config';

// Su GitHub Pages il sito vive in una sottocartella (il nome del repository).
// In locale invece sta alla radice. BASE_PATH viene valorizzato dalla GitHub Action.
const base = process.env.BASE_PATH || '/';
const site = process.env.SITE_URL || 'http://localhost:4321';

export default defineConfig({
  site,
  base,
  trailingSlash: 'ignore',
  build: { format: 'directory' },

  // I font vengono scaricati in fase di build e serviti dal nostro dominio:
  // nessuna chiamata a Google dal browser dei visitatori (un punto in meno da
  // dichiarare nel cookie banner).
  fonts: [
    {
      provider: fontProviders.google(),
      name: 'Fraunces',
      cssVariable: '--font-display',
      weights: ['400 700'],
      styles: ['normal'],
      subsets: ['latin', 'latin-ext'],
      fallbacks: ['Iowan Old Style', 'Palatino', 'Georgia', 'serif'],
    },
    {
      provider: fontProviders.google(),
      name: 'Archivo',
      cssVariable: '--font-body',
      weights: ['400 700'],
      styles: ['normal'],
      subsets: ['latin', 'latin-ext'],
      fallbacks: ['Helvetica Neue', 'Arial', 'sans-serif'],
    },
  ],
});
