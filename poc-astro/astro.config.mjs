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
      // Display: grottesco rotondo e pesante, come le lettere ritagliate dei cartelloni
      provider: fontProviders.google(),
      name: 'Rubik',
      cssVariable: '--font-display',
      weights: ['500 900'],
      styles: ['normal'],
      subsets: ['latin', 'latin-ext'],
      fallbacks: ['Arial Rounded MT Bold', 'Helvetica Neue', 'Arial', 'sans-serif'],
    },
    {
      // Testo: progettato per la massima leggibilità, anche per chi legge con fatica
      provider: fontProviders.google(),
      name: 'Atkinson Hyperlegible Next',
      cssVariable: '--font-body',
      weights: ['400 800'],
      styles: ['normal', 'italic'],
      subsets: ['latin', 'latin-ext'],
      fallbacks: ['Helvetica Neue', 'Arial', 'sans-serif'],
    },
  ],
});
