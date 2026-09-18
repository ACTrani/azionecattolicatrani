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
}

export const settori: Settore[] = [
  {
    slug: 'unitario',
    nome: 'Unitario',
    nomeEsteso: 'Vita associativa unitaria',
    eta: 'Tutta l’associazione',
    descrizione:
      'Gli appuntamenti che riuniscono tutta l’associazione diocesana: le assemblee, …fierA di esserCI, il Laboratorio diocesano della formazione, le celebrazioni dell’anno.',
    tinta: '#1f3f6b',
  },
  {
    slug: 'adulti',
    nome: 'Adulti',
    nomeEsteso: 'Settore Adulti',
    eta: 'dai 30 anni',
    descrizione:
      'Adulti e famiglie che vogliono essere credenti e credibili, «di parola», in parrocchia, in famiglia e nella città: gruppi, serate di spiritualità, Fede & Cultura, Giornata della famiglia.',
    tinta: '#2c6e63',
  },
  {
    slug: 'giovani',
    nome: 'Giovani',
    nomeEsteso: 'Settore Giovani',
    eta: '15 – 30 anni',
    descrizione:
      'Giovanissimi (15–18 anni) e giovani (19–30) in cammino nei gruppi parrocchiali e negli appuntamenti diocesani: ritiri, laboratorio della formazione, preghiera e servizio.',
    tinta: '#b5651d',
  },
  {
    slug: 'acr',
    nome: 'ACR',
    nomeEsteso: 'Azione Cattolica dei Ragazzi',
    eta: 'Dai Piccolissimi ai 14 anni',
    descrizione:
      'I ragazzi dai Piccolissimi ai 14 anni, protagonisti del proprio cammino di fede, con un’attenzione speciale agli educatori e all’Equipe diocesana dei ragazzi (EDR).',
    tinta: '#c0392b',
  },
  {
    slug: 'msac',
    nome: 'MSAC',
    nomeEsteso: 'Movimento Studenti di Azione Cattolica',
    eta: 'Studenti delle superiori',
    descrizione:
      'La proposta missionaria per i giovanissimi che vivono tra i banchi di scuola: rappresentanza, cittadinanza attiva, legalità. In diocesi da dieci anni.',
    tinta: '#5b4b8a',
  },
  {
    slug: 'mlac',
    nome: 'MLAC',
    nomeEsteso: 'Movimento Lavoratori di Azione Cattolica',
    eta: 'Mondo del lavoro',
    descrizione:
      'Il lavoro letto alla luce del Vangelo e della Dottrina sociale: dignità, sicurezza, sostenibilità e partecipazione, insieme alla Pastorale sociale e del lavoro diocesana.',
    tinta: '#6b7a3a',
  },
];

export const settorePerSlug = (slug: string) => settori.find((s) => s.slug === slug);
