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
      'Gli appuntamenti che riuniscono l’intera associazione diocesana: assemblee, campi unitari, esercizi spirituali, formazione dei responsabili.',
    tinta: '#1f3f6b',
  },
  {
    slug: 'adulti',
    nome: 'Adulti',
    nomeEsteso: 'Settore Adulti',
    eta: 'dai 30 anni',
    descrizione:
      'Adulti e famiglie che vivono la corresponsabilità nella parrocchia e l’impegno nella città: formazione permanente, coppie, terza età.',
    tinta: '#2c6e63',
  },
  {
    slug: 'giovani',
    nome: 'Giovani',
    nomeEsteso: 'Settore Giovani',
    eta: '15 – 30 anni',
    descrizione:
      'Giovanissimi e giovani in cammino: ritiri, scuola di formazione, servizio, campi estivi e discernimento vocazionale.',
    tinta: '#b5651d',
  },
  {
    slug: 'acr',
    nome: 'ACR',
    nomeEsteso: 'Azione Cattolica dei Ragazzi',
    eta: '6 – 14 anni',
    descrizione:
      'I ragazzi come protagonisti, non destinatari: Mese del Ciao, Mese della Pace, Festa degli Incontri, campi scuola.',
    tinta: '#c0392b',
  },
  {
    slug: 'msac',
    nome: 'MSAC',
    nomeEsteso: 'Movimento Studenti di Azione Cattolica',
    eta: 'Studenti delle superiori',
    descrizione:
      'Studenti che si prendono cura della scuola: rappresentanza, cittadinanza attiva, formazione politica.',
    tinta: '#5b4b8a',
  },
  {
    slug: 'mlac',
    nome: 'MLAC',
    nomeEsteso: 'Movimento Lavoratori di Azione Cattolica',
    eta: 'Mondo del lavoro',
    descrizione:
      'Il lavoro come luogo di vocazione e di giustizia: Progetto Policoro, dottrina sociale, precarietà e dignità.',
    tinta: '#6b7a3a',
  },
];

export const settorePerSlug = (slug: string) => settori.find((s) => s.slug === slug);
