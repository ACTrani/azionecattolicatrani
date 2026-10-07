import { url } from '../lib/url';
import { settori } from './settori';

/**
 * Menu principale. La struttura riprende quella di acaversa.it, scelta dalla
 * Presidenza come riferimento: Home · Notizie · Eventi · Settori · Assemblea ·
 * Informazioni. Nel tema WordPress diventa il blocco Navigazione.
 */
export interface VoceMenu {
  testo: string;
  href?: string;
  figli?: { testo: string; href: string; settore?: string }[];
}

/** I settori in ordine d'età, come le tessere della homepage. */
export const ordineSettori = ['acr', 'msac', 'giovani', 'adulti', 'mlac', 'unitario'] as const;
export const settoriInOrdine = ordineSettori.map((slug) => settori.find((s) => s.slug === slug)!);

export const menu: VoceMenu[] = [
  { testo: 'Home', href: url('/') },
  { testo: 'Notizie', href: url('/notizie') },
  { testo: 'Eventi', href: url('/eventi') },
  {
    testo: 'Settori',
    figli: settoriInOrdine.map((s) => ({ testo: s.nomeMenu, href: url(`/settori/${s.slug}`), settore: s.slug })),
  },
  {
    testo: 'Assemblea',
    figli: [
      { testo: 'Assemblea diocesana 2027', href: url('/assemblea') },
      { testo: 'Assemblee parrocchiali', href: url('/assemblea#parrocchiali') },
    ],
  },
  {
    testo: 'Informazioni',
    figli: [
      { testo: 'Programmazione 2026/2027', href: url('/programmazione') },
      { testo: 'Documenti e moduli', href: url('/documenti') },
      { testo: 'Chi siamo', href: url('/associazione') },
      { testo: 'Presidenza', href: url('/presidenza') },
      { testo: 'Consiglio diocesano', href: url('/presidenza#consiglio') },
      { testo: 'Contatti', href: url('/contatti') },
    ],
  },
];
