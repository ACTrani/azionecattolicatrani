/** Tassonomia `settore` — condivisa da eventi, notizie e documenti. */
export type SettoreSlug = 'unitario' | 'adulti' | 'giovani' | 'acr' | 'msac' | 'mlac';

export interface Settore {
  slug: SettoreSlug;
  nome: string;
  nomeEsteso: string;
  eta: string;
  descrizione: string;
  /** Tinta del settore: nel tema WordPress diventerà una palette di theme.json */
  tinta: string;
  /** Come compare nel menu «Settori», alla maniera di acaversa.it */
  nomeMenu: string;
  /** Il gruppo di `sito.consiglio` che raccoglie i responsabili del settore */
  gruppoConsiglio?: string;
}

export const settori: Settore[] = [
  {
    slug: 'unitario',
    nome: 'Unitario',
    nomeEsteso: 'Vita associativa unitaria',
    eta: 'Tutta l’associazione',
    descrizione:
      'Gli appuntamenti che riuniscono tutta l’associazione diocesana: le assemblee, …fierA di esserCI, il Laboratorio diocesano della formazione, le celebrazioni dell’anno.',
    tinta: '#2f5d8a',
    nomeMenu: 'Unitario',
    gruppoConsiglio: 'Presidenza',
  },
  {
    slug: 'adulti',
    nome: 'Adulti',
    nomeEsteso: 'Settore Adulti',
    eta: 'dai 30 anni',
    descrizione:
      'Adulti e famiglie che vogliono essere credenti e credibili, «di parola», in parrocchia, in famiglia e nella città: gruppi, serate di spiritualità, Fede & Cultura, Giornata della famiglia.',
    tinta: '#f2b705',
    nomeMenu: 'Adulti',
    gruppoConsiglio: 'Settore Adulti',
  },
  {
    slug: 'giovani',
    nome: 'Giovani',
    nomeEsteso: 'Settore Giovani',
    eta: '15 – 30 anni',
    descrizione:
      'Giovanissimi (15–18 anni) e giovani (19–30) in cammino nei gruppi parrocchiali e negli appuntamenti diocesani: ritiri, laboratorio della formazione, preghiera e servizio.',
    tinta: '#f07a3c',
    nomeMenu: 'Giovani',
    gruppoConsiglio: 'Settore Giovani e MSAC',
  },
  {
    slug: 'acr',
    nome: 'ACR',
    nomeEsteso: 'Azione Cattolica dei Ragazzi',
    eta: 'Dai Piccolissimi ai 14 anni',
    descrizione:
      'I ragazzi dai Piccolissimi ai 14 anni, protagonisti del proprio cammino di fede, con un’attenzione speciale agli educatori e all’Equipe diocesana dei ragazzi (EDR).',
    tinta: '#2ba3de',
    nomeMenu: 'Ragazzi (ACR)',
    gruppoConsiglio: 'Azione Cattolica dei Ragazzi',
  },
  {
    slug: 'msac',
    nome: 'MSAC',
    nomeEsteso: 'Movimento Studenti di Azione Cattolica',
    eta: 'Studenti delle superiori',
    descrizione:
      'La proposta missionaria per i giovanissimi che vivono tra i banchi di scuola: rappresentanza, cittadinanza attiva, legalità. In diocesi da dieci anni.',
    tinta: '#7a4fb5',
    nomeMenu: 'Studenti (MSAC)',
    gruppoConsiglio: 'Settore Giovani e MSAC',
  },
  {
    slug: 'mlac',
    nome: 'MLAC',
    nomeEsteso: 'Movimento Lavoratori di Azione Cattolica',
    eta: 'Mondo del lavoro',
    descrizione:
      'Il lavoro letto alla luce del Vangelo e della Dottrina sociale: dignità, sicurezza, sostenibilità e partecipazione, insieme alla Pastorale sociale e del lavoro diocesana.',
    tinta: '#2e7d5b',
    nomeMenu: 'Lavoratori (MLAC)',
  },
];

export const settorePerSlug = (slug: string) => settori.find((s) => s.slug === slug);
