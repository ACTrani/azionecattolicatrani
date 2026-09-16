const MESI_BREVI = ['gen', 'feb', 'mar', 'apr', 'mag', 'giu', 'lug', 'ago', 'set', 'ott', 'nov', 'dic'];

export const giorno = (d: Date) => String(d.getDate()).padStart(2, '0');
export const meseBreve = (d: Date) => MESI_BREVI[d.getMonth()];
export const anno = (d: Date) => d.getFullYear();

/** «4 ottobre 2026» */
export const dataEstesa = (d: Date) =>
  new Intl.DateTimeFormat('it-IT', { day: 'numeric', month: 'long', year: 'numeric' }).format(d);

/** «domenica 4 ottobre» */
export const dataConGiorno = (d: Date) =>
  new Intl.DateTimeFormat('it-IT', { weekday: 'long', day: 'numeric', month: 'long' }).format(d);

/** «26 – 28 febbraio 2027» oppure la data singola */
export function intervallo(inizio: Date, fine?: Date): string {
  if (!fine || +fine === +inizio) return dataEstesa(inizio);
  const stessoMese = inizio.getMonth() === fine.getMonth() && inizio.getFullYear() === fine.getFullYear();
  if (stessoMese) return `${inizio.getDate()} – ${dataEstesa(fine)}`;
  return `${dataEstesa(inizio)} – ${dataEstesa(fine)}`;
}

/** Per l'attributo datetime dei tag <time> */
export const iso = (d: Date) => d.toISOString().slice(0, 10);

/** Formato usato dai file .ics (UTC, senza separatori) */
export const icsData = (d: Date) => d.toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z';
