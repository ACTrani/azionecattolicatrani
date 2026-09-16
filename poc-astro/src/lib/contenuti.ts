import { getCollection, type CollectionEntry } from 'astro:content';

/**
 * UNICO PUNTO DI ACCESSO AI CONTENUTI.
 *
 * Oggi i contenuti arrivano da file Markdown locali. Per far leggere al sito la
 * REST API di WordPress (traccia B del piano) si riscrive SOLO questo file:
 * le pagine e i componenti non cambiano di una riga.
 *
 *   const r = await fetch(`${WP}/wp-json/wp/v2/evento?_embed&per_page=100`);
 *   return (await r.json()).map(mappaEventoDaWP);
 */

export type Evento = CollectionEntry<'eventi'>;
export type Notizia = CollectionEntry<'notizie'>;
export type Documento = CollectionEntry<'documenti'>;

/** Mezzanotte di oggi: un evento resta "prossimo" per tutto il suo giorno. */
const oggi = () => {
  const d = new Date();
  d.setHours(0, 0, 0, 0);
  return d;
};

const fineEvento = (e: Evento) => e.data.dataFine ?? e.data.dataInizio;

export async function tuttiGliEventi(): Promise<Evento[]> {
  const eventi = await getCollection('eventi');
  return eventi.sort((a, b) => +a.data.dataInizio - +b.data.dataInizio);
}

export async function eventiProssimi(limite?: number): Promise<Evento[]> {
  const eventi = await tuttiGliEventi();
  const prossimi = eventi.filter((e) => fineEvento(e) >= oggi());
  return limite ? prossimi.slice(0, limite) : prossimi;
}

export async function eventiPassati(): Promise<Evento[]> {
  const eventi = await tuttiGliEventi();
  return eventi.filter((e) => fineEvento(e) < oggi()).reverse();
}

export async function tutteLeNotizie(limite?: number): Promise<Notizia[]> {
  const notizie = await getCollection('notizie');
  const ordinate = notizie.sort((a, b) => +b.data.data - +a.data.data);
  return limite ? ordinate.slice(0, limite) : ordinate;
}

export async function tuttiIDocumenti(): Promise<Documento[]> {
  const documenti = await getCollection('documenti');
  return documenti.sort((a, b) => +b.data.data - +a.data.data);
}

/** Anni associativi presenti nei contenuti, dal più recente. */
export function anniAssociativi(voci: Array<{ data: { annoAssociativo: string } }>): string[] {
  return [...new Set(voci.map((v) => v.data.annoAssociativo))].sort().reverse();
}
