/** Costruisce un URL rispettando la sottocartella di GitHub Pages. */
const base = import.meta.env.BASE_URL.replace(/\/$/, '');
export const url = (percorso: string) => `${base}/${percorso.replace(/^\//, '')}`.replace(/\/$/, '') || '/';
